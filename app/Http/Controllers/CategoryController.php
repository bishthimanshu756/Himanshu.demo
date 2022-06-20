<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index', [
            'categories'=> Category::VisibleTo()
        ]);
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'slug' => ['required'],
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
        ]);
        
        return redirect()->route('categories.index')->with('success', __('Category created successfully'));
    }

    public function edit(Category $category) {

        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Category $category, Request $request) {
        $attributes= $request->validate([
            'name' => ['required', 'max:50'],
        ]);

        $category->update($attributes);

        return redirect()->route('categories.index')
            ->with('success', __('Category updated successfully'));
    }

    //* Delete a user //
    public function delete(Category $category) {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', __('Category deleted successfully'));
    }
}
