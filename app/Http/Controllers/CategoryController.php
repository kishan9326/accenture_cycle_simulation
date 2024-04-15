<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $limit;
    public function __construct()
    {
        $this->middleware('auth');
        $this->limit = 10;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->get();
        return view('category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'status' => 'required'
        ]);
        
        $data = array(
            'name' => $request->name,
            'status' => $request->status
        );
        Category::create($data);
        return redirect()->route('category-management.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('category.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id = null)
    {
        $data['categories'] = Category::all();
        return view('category.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return redirect()->route('category.index');
        }
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'status' => 'required',
        ]);
       
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }

    public function category_list() {
        $data['categories'] = Category::all();
        return view('category.edit')->with($data);
    }

    public function category_update(Request $request) {
        $request_data = $request->all();
        if(empty($request_data)) {
            return redirect()->route('category-management.category_list');
        }
        if(empty($request_data['cat'])) {
            return redirect()->route('category-management.category_list');
        }
        foreach($request_data['cat'] as $key => $data) {
            $category = Category::find($key);
            $category->name = $data['name'];
            $category->status = $data['status'];
            $category->updated_at = Carbon::now();
            $category->save();
        }
        return redirect()->route('category-management.index',['cat_id' => 1]);
    }
}
