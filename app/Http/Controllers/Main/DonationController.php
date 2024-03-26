<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public $response;
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function makeDonation(Request $request)
    {

        DB::transaction(function () use ($request) {
            $createdDonation = Donation::create([
                'program_id' => $request->program_id,
                'order_id' => \Str::uuid(),
                'donatur_id' => auth()->user()->id,
                'amount' => $request->amount,
                'is_hide_name' => $request->is_hide_name == 'on' ? 1 : 0,
                'payment_status' => 1
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id' => $createdDonation->order_id,
                    'gross_amount' => $createdDonation->amount,
                ],
                'customer_details' => [
                    'first_name' => $createdDonation->donatur->name,
                    'email' => $createdDonation->donatur->email,
                ],
                'item_details' => [
                    [
                        'id' => $createdDonation->id,
                        'price' => $createdDonation->amount,
                        'quantity' => 1,
                        'name' => 'Donation to ' . $createdDonation->program->name,
                        'brand' => 'Donation',
                        'category' => 'Donation',
                        'merchant_name' => config('app.name'),
                    ],
                ],
            ];
            \Midtrans\Config::$overrideNotifUrl = config('app.url') . '/api/program/donasi/midtrans-snap-callback';
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $createdDonation->snap_token = $snapToken;
            $createdDonation->save();
            $this->response['snap_token'] = $snapToken;
            $this->response['order_id'] = $createdDonation->order_id;
            $this->response['donation_id'] = $createdDonation->id;
        });

        return response()->json([
            'status' => 'success',
            'snap_token' => $this->response['snap_token'],
            'order_id' => $this->response['order_id'],
            'donation_id' => $this->response['donation_id'],
        ]);

    }

    public function midtransSnapCallback(Request $request)
    {

        $payment_status = 3;

        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $payment_status = 2;
        }

        if ($request->transaction_status == 'authorize' || $request->transaction_status == 'pending') {
            $payment_status = 1;
        }

        Donation::where('order_id', $request->order_id)->update([
            'payment_status' => $payment_status,
            'payment_method' => $request->payment_type,
        ]);

        $paymentResult = [
            'order_id' => $request->order_id,
        ];

        event(new \App\Events\DonationPaymentEvent($paymentResult));

    }

    public function detail(Donation $donation)
    {
        $programActivities = $donation->program->programActivities()->latest()->paginate(8);
        return view('main.donation.detail', compact('donation', 'programActivities'));
    }

}
