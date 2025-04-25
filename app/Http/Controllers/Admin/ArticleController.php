<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $artikels = Article::latest()->get(); 
        return view('admin.dashboard', compact('artikels'));
    }


    public function create(){
        return view('admin.create');

    }


    public function store(Request $request){
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|unique:articles,slug',
        'content' => 'required|string',
        'excerpt' => 'nullable|string|max:150',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'category' => 'required|string|max:50',
        'author' => 'required|string|max:100',
        'status' => 'required|in:Published,Draft,Archived',
        'published_at' => 'nullable|date',
    ]);

    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $validated['thumbnail'] = $thumbnailPath; 
    }

    $validated['excerpt'] = $validated['excerpt'] ?? '';
    Article::create($validated);
    return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil disimpan!');
    }




    public function edit($id){
        $artikel = Article::findOrFail($id);
        return view('admin.edit', compact('artikel'));
    }




    public function update(Request $request, $id){
        $artikel = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category' => 'required|string',
            'author' => 'nullable|string',
            'status' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $artikel->update($validated); 

        return redirect()->route('edit', $artikel->id)->with('success', 'Artikel berhasil diperbarui.');
    }



    public function read($id){
        $artikel = Article::findOrFail($id);
        return view('admin.read', compact('artikel'));
    }




    public function destroy($id){
        $artikel = Article::findOrFail($id);

    if ($artikel->thumbnail && Storage::exists('public/' . $artikel->thumbnail)) {
        Storage::delete('public/' . $artikel->thumbnail);
    }

    $artikel->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil dihapus.');
    }
}