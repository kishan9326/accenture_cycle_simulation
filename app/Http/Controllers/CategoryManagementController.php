<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;

use Illuminate\Http\Request;

class CategoryManagementController extends Controller
{
    private $limit;
    public function __construct()
    {
        $this->middleware('auth');
        $this->limit = 20;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('cat_id') && request()->input('cat_id')) {
            $data['questions'] = Question::where('cat_id', request()->input('cat_id'))->paginate($this->limit);
        } else {
            $data['questions'] = Question::paginate($this->limit);
        }
        $data['categories'] = Category::all();
        return view('category.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
