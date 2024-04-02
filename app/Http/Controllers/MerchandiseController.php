<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Number;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $model = Merchandise::query()->latest();

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                        <a href=" ' . route('merchandises.show', $row->id) . '" class="btn btn-success btn-sm detail-btn-' . $row->id . '">Detail</a>
                        <a href=" ' . route('merchandises.edit', $row->id) . ' " class="edit btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteMerchandise(' . "'" . $row->id . "'" . ')">Hapus</button>
                        ';
                    return $action;
                })
                ->editColumn('price', function ($row) {
                    return 'Rp ' . number_format($row->price, 0, ',', '.');
                })
                ->rawColumns([
                    'action',
                    // 'progress'
                ])
                ->make(true);
        }

        return view('merchandise.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'target_fund' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'description' => 'required|string',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'image.required' => 'Gambar thumbnail tidak boleh kosong.',
            'image.image' => 'Pastikan jenis file yang diunggah adalah gambar.',
            'image.mimes' => 'Hanya gambar dengan format JPEG, PNG, JPG, dan GIF yang diperbolehkan.',
            'image.max' => 'Ukuran file gambar maksimal adalah 2 MB.', // Adjust size as needed
            'target_fund.required' => 'Target Pendanaan tidak boleh kosong.',
            'target_fund.numeric' => 'Pastikan Target Pendanaan berupa angka.',
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $fileNameToStore = time() . str()->random(7) . '_' . $filename;
            $request->file('image')->storeAs('public/images/program', $fileNameToStore);
            $validatedData['image'] = 'storage/images/program/' . $fileNameToStore;
        }

        Program::create($validatedData);
        return redirect()->route('merchandises.index')->with('success', 'Program berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $donations = $program->donations()->latest()->paginate(5, ['*'], 'donations');
        $programActivities = $program->programActivities()->latest()->paginate(5, ['*'], 'program_activities');

        return view('program.show', compact('program', 'donations', 'programActivities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'target_fund' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
        ], [
            'name.required' => 'Nama Program tidak boleh kosong.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'image.image' => 'Pastikan jenis file yang diunggah adalah gambar.',
            'image.mimes' => 'Hanya gambar dengan format JPEG, PNG, JPG, dan GIF yang diperbolehkan.',
            'image.max' => 'Ukuran file gambar maksimal adalah 2 MB.', // Adjust size as needed
            'target_fund.required' => 'Target Pendanaan tidak boleh kosong.',
            'target_fund.numeric' => 'Pastikan Target Pendanaan berupa angka.',
        ]);

        // Update the fields
        $program->name = $validatedData['name'];
        $program->description = $validatedData['description'];
        $program->target_fund = $validatedData['target_fund'];

        // Update the image only if a new image is uploaded
        if ($request->hasFile('image')) {
            $imageToDelete = $program->image;
            $filename = $request->file('image')->getClientOriginalName();
            $fileNameToStore = time() . str()->random(7) . '_' . $filename;
            $request->file('image')->storeAs('public/images/program', $fileNameToStore);
            $program->image = 'storage/images/program/' . $fileNameToStore;

            if ($imageToDelete) {
                $imageToDelete = 'public' . substr($imageToDelete, 7);
                Storage::delete($imageToDelete);
            }
        }


        $program->save();

        return redirect()->route('merchandises.index')->with('success', 'Program berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        if ($program) {
            $program->delete();
            return back()->with('success', 'Program berhasil dihapus');
        } else {
            return back()->with('error', 'Program gagal dihapus');
        }
    }
}
