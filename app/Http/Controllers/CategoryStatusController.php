<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryStatusController extends Controller
{
    public function update(Category $category) {
        
        if($category->status == Category::ACTIVE) {
            $attributes['status'] = Category::INACTIVE;
        } else {
            $attributes['status'] = Category::ACTIVE;
        }
       
        $category->update($attributes);

        return back()->with('success', 'Category status changed successfully!!');   
    }
}
