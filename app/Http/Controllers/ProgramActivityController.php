<?php

namespace App\Http\Controllers;

use App\Models\ProgramActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class ProgramActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($programId, Request $request)
    {

        if ($request->ajax()) {
            $model = ProgramActivity::query()->where('program_id', $programId)->latest();

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                        <a href=" ' . route('program_activities.show', ['programId' => $row->program_id, 'programActivity' => $row->id]) . '" class="btn btn-success btn-sm detail-btn-' . $row->id . '">Detail</a>
                        <a href=" ' . route('program_activities.edit', ['programId' => $row->program_id, 'programActivity' => $row->id]) . ' " class="edit btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteProgramActivity(' . "'" . $row->id . "'" . ')">Hapus</button>
                    ';
                    $actionDropdown = '
                                    <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Menu
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="' . route('program_activities.show', ['programId' => $row->program_id, 'programActivity' => $row->id]) . '" class="dropdown-item" type="button">Detail Program</a></li>
                                                <li><a href="' . route('program_activities.edit', ['programId' => $row->program_id, 'programActivity' => $row->id]) . '" class="dropdown-item" type="button">Edit Program</a></li>
                                                <li><button onclick="deleteProgramActivity(' . "'" . $row->id . "'" . ')" class="dropdown-item" type="button">Hapus Program</button></li>
                                                <li><a href="" class="dropdown-item" type="button">Berita Penyaluran</a></li>
                                            </ul>
                                        </div>
                                    ';
                    return $action;
                })
                ->editColumn('amount', function ($row) {
                    return Number::currency($row->amount, 'IDR', 'id_ID');
                })
                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }
        return view('program_activity.index', compact('programId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($programId)
    {
        $currentFund = \App\Models\Program::find($programId)->current_fund;
        return view('program_activity.create', compact('programId', 'currentFund'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $programId)
    {
        $currentFund = \App\Models\Program::find($programId)->current_fund;

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'nullable|numeric|max:' . $currentFund,
            'description' => 'required|string',
        ], [
            'title.required' => 'Nama tidak boleh kosong.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'amount.numeric' => 'Pastikan Target Pendanaan berupa angka.',
            'amount.max' => 'Dana yang digunakan melebihi batas dana yang tersedia (' . Number::currency($currentFund, 'IDR', 'id_ID') . ').',
        ]);
        $validatedData['program_id'] = $programId;

        ProgramActivity::create($validatedData);
        return redirect()->route('program_activities.index', ['programId' => $programId])->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($programId, ProgramActivity $programActivity)
    {
        return view('program_activity.show', compact('programId', 'programActivity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($programId, ProgramActivity $programActivity)
    {
        $currentFund = \App\Models\Program::find($programId)->current_fund;
        return view('program_activity.edit', compact('programId', 'programActivity', 'currentFund'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($programId, Request $request, ProgramActivity $programActivity)
    {
        $currentFund = \App\Models\Program::find($programId)->current_fund;

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'nullable|numeric|max:' . $currentFund + $programActivity->amount,
            'description' => 'required|string',
        ], [
            'title.required' => 'Nama tidak boleh kosong.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'amount.numeric' => 'Pastikan Target Pendanaan berupa angka.',
            'amount.max' => 'Dana yang digunakan melebihi batas dana yang tersedia (' . Number::currency($currentFund + $programActivity->amount, 'IDR', 'id_ID') . ').',
        ]);

        $programActivity->update($validatedData);
        return redirect()->route('program_activities.index', ['programId' => $programId])->with('success', 'Kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($programId, ProgramActivity $programActivity)
    {
        if ($programActivity) {
            $programActivity->delete();
            return back()->with('success', 'Kegiatan berhasil dihapus');
        } else {
            return back()->with('error', 'Kegiatan gagal dihapus');
        }
    }
}
