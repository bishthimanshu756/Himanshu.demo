<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index', [
            'categories'=> Category::VisibleTo()->paginate(),
        ]);
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) 
    {        
        $request->validate([
            'name' => ['required', 'max:50'],
        ]);

        $category= Category::where('name', $request->name)->onlyTrashed()->first();

        if ($category) {
            $category->restore();
            return redirect()->route('categories.index')
                ->with('success', 'Category restore successfully');
        }

        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);
        
        switch($request->action) {
            case 'create':
                return redirect()->route('categories.index')
                    ->with('success', __('Category created successfully'));
                break;
            case 'create_another':
                return back()
                    ->with('success', __('Category created successfully'));
                break;
        }
    }

    public function edit(Category $category) 
    {
        $this->authorize('edit', $category);

        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Category $category, Request $request) 
    {
        $this->authorize('update', $category);

        $attributes= $request->validate([
            'name' => ['required', 'max:50'],
        ]);

        $category->update($attributes);

        return redirect()->route('categories.index')
            ->with('success', __('Category updated successfully'));
    }

    public function delete(Category $category) 
    {
        $this->authorize('delete', $category);
        
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', __('Category deleted successfully'));
    }
}
