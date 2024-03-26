<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Number;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $model = Program::query()->select(['id', 'name', 'description', 'image', 'target_fund'])->latest();

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                        <a href=" ' . route('programs.show', $row->id) . '" class="btn btn-success btn-sm detail-btn-' . $row->id . '">Detail</a>
                        <a href=" ' . route('programs.edit', $row->id) . ' " class="edit btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteProgram(' . "'" . $row->id . "'" . ')">Hapus</button>
                        <a href=" ' . route('program_activities.index', ['programId' => $row->id]) . ' " class="btn btn-warning btn-sm">Kegiatan</a>
                        
                    ';
                    $actionDropdown = '
                                    <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Menu
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="' . route('programs.show', $row->id) . '" class="dropdown-item" type="button">Detail Program</a></li>
                                                <li><a href="' . route('programs.edit', $row->id) . '" class="dropdown-item" type="button">Edit Program</a></li>
                                                <li><button onclick="deleteProgram(' . "'" . $row->id . "'" . ')" class="dropdown-item" type="button">Hapus Program</button></li>
                                                <li><a href="" class="dropdown-item" type="button">Berita Penyaluran</a></li>
                                            </ul>
                                        </div>
                                    ';
                    return $action;
                })
                ->editColumn('collected_fund', function ($row) {
                    return Number::currency($row->collected_fund, 'IDR', 'id_ID');
                })
                ->editColumn('current_fund', function ($row) {
                    return Number::currency($row->current_fund, 'IDR', 'id_ID');
                })
                ->editColumn('target_fund', function ($row) {
                    return Number::currency($row->target_fund, 'IDR', 'id_ID');
                })
                // ->addColumn('progress', function ($row) {

                //     $progress = '<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="' . $row->funding_progress_percentage . '" aria-valuemin="0" aria-valuemax="100">
                //         <div class="progress-bar" style="width: ' . $row->funding_progress_percentage . '%; background-color: rgb(13,' . 210 - ($row->funding_progress_percentage) . ',253);">' . $row->funding_progress_percentage . '%</div>
                //     </div>';
                //     return $progress;
                // })
                ->rawColumns([
                    'action',
                    // 'progress'
                ])
                ->make(true);
        }

        return view('program.index');
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
        return redirect()->route('programs.index')->with('success', 'Program berhasil ditambahkan');
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

        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui');

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
