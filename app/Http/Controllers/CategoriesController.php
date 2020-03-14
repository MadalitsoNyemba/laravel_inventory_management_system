<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categories as categories;
use App\products as products;

class CategoriesController extends Controller
{
    public function __construct(products $products,categories $categories)
    {
        $this->products = $products; 
        $this->categories = $categories; 
    }
    public function index()
    {
        $data = [];
        $data['categories'] = categories::withCount('products')->get();
        return view('categories.index',$data);   
    }

    public function add_category(categories $categories,request $request)
    {

        // This is inserting main category data
        $category = [];
        $category["name"] =  $request->name;
        $categories->insert($category);
        return redirect()->back();


    }
    public function edit_category(categories $categories,request $request)
    {

        // This is inserting main category data
        $category = categories::find($request->category_id);
        $category->name =  $request->name;
        $category->save();
        return redirect()->back();


    }
}
