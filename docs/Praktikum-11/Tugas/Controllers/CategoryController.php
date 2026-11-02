<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('master-data.category.index');
    }

    public function create()
    {
        return view('master-data.category.create');
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Form kategori berhasil dikirim.');
    }

    public function show(string $category)
    {
        return response('Detail kategori');
    }

    public function edit(string $category)
    {
        return response('Edit kategori');
    }

    public function update(Request $request, string $category)
    {
        return back();
    }

    public function destroy(string $category)
    {
        return back();
    }
}
