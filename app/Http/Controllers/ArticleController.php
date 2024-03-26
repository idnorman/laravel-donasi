<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Article::query()->latest();

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    $action = '
                        <a href="javascript:void(0)" class="btn btn-success btn-sm">Lihat</a>
                        <a href=" ' . route('articles.edit', $row->slug) . ' " class="edit btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteArticle(' . "'" . $row->slug . "'" . ')">Hapus</button>
                    ';
                    return $action;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="object-fit-cover" src="' . $row->image . '" width="112px" height="63" />';
                    return $img;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'content' => 'required|string',
        ], [
            'title.required' => 'Judul tidak boleh kosong.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'image.required' => 'Gambar thumbnail tidak boleh kosong.',
            'image.image' => 'Pastikan jenis file yang diunggah adalah gambar.',
            'image.mimes' => 'Hanya gambar dengan format JPEG, PNG, JPG, dan GIF yang diperbolehkan.',
            'image.max' => 'Ukuran file gambar maksimal adalah 2 MB.', // Adjust size as needed
            'content.required' => 'Konten tidak boleh kosong.',
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $fileNameToStore = time() . str()->random(7) . '_' . $filename;
            $request->file('image')->storeAs('public/images/article', $fileNameToStore);
            $validatedData['image'] = 'storage/images/article/' . $fileNameToStore;
        }

        Article::create($validatedData);
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'content' => 'required|string',
        ], [
            'title.required' => 'Judul tidak boleh kosong.',
            'description.required' => 'Deskripsi tidak boleh kosong.',
            'image.image' => 'Pastikan jenis file yang diunggah adalah gambar.',
            'image.mimes' => 'Hanya gambar dengan format JPEG, PNG, JPG, dan GIF yang diperbolehkan.',
            'image.max' => 'Ukuran file gambar maksimal adalah 2 MB.', // Adjust size as needed
            'content.required' => 'Konten tidak boleh kosong.',
        ]);

        // Update the fields
        $article->title = $validatedData['title'];
        $article->description = $validatedData['description'];
        $article->content = $validatedData['content'];

        // Update the image only if a new image is uploaded
        if ($request->hasFile('image')) {
            $imageToDelete = $article->image;
            $filename = $request->file('image')->getClientOriginalName();
            $fileNameToStore = time() . str()->random(7) . '_' . $filename;
            $request->file('image')->storeAs('public/images/article', $fileNameToStore);
            $article->image = 'storage/images/article/' . $fileNameToStore;

            if ($imageToDelete) {
                $imageToDelete = 'public' . substr($imageToDelete, 7);
                Storage::delete($imageToDelete);
            }
        }


        $article->save();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article) {
            $article->delete();
            return back()->with('success', 'Artikel berhasil dihapus');
        } else {
            return back()->with('error', 'Artikel gagal dihapus');
        }

    }
}
