<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    private $response;
    public function __construct()
    {
        $this->response = array(
            'header' => array(
                'code' => 404,
                'status' => 'error',
                'message' => 'Data not found'
            ),
            'body' => null
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select(array('id', 'name', 'status'))->where('status', 'active')->get()->toArray();
        if (empty($categories)) {
            return $this->response;
        }
        $this->response['header']['code'] = 200;
        $this->response['header']['status'] = 'success';
        $this->response['header']['message'] = 'Ok';
        $this->response['body']['categories'] = $categories;
        return response()->json($this->response, 200);
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
