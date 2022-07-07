<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryStatusController extends Controller
{
    /**
     * Changing the status of a category.
     */
    public function update(Category $category)
    {
        $this->authorize('update', $category);

        if($category->status == Category::ACTIVE) {
            $attributes['status'] = Category::INACTIVE;
        } else {
            $attributes['status'] = Category::ACTIVE;
        }

        $category->update($attributes);

        return back()->with('success', __('Category status changed successfully!'));
    }
}
