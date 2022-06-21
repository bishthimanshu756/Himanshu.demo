<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

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
            'name' => ['required', 'max:50'],
        ]);

        $category= Category::where('name', $request->name)->onlyTrashed()->first();
        if($category) {
            $category->restore();
            return redirect()->route('categories.index')->with('success', 'Category restore successfully');
        }

        Category::create([
            'name' => $request->name,
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

    public function delete(Category $category) {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', __('Category deleted successfully'));
    }
}
