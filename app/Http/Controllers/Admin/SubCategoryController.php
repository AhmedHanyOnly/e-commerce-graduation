<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    

    public function index($parent_id)
    {
        $subCategories = Category::where('parent_id', $parent_id)->paginate(10);

        // عرض الفئات الفرعية في العرض
        return view('admin.sub-categories', compact('subCategories'));
  
}

}