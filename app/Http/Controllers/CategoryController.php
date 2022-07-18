<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories'=> Category::VisibleTo()->filter(request(['orderBy', 'search']))->paginate(),
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
        ]);

        $category = Category::where('name', $request->name)->withTrashed()->first();

        if ($category) {
            if(!$category->deleted_at) {

                return redirect()->route('categories.create')->with('error', 'Name has already taken');
            }

            $category->restore();
            return redirect()->route('categories.edit', $category)
                ->with('success', __('Category restored successfully') );

        }

        $category = Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        if($request->input('action') === 'save') {
            return redirect()
                ->route('categories.edit', $category)
                ->with('success', __('Category created successfully'));
        }

        return back()->with('success', __('Category created successfully'));
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
