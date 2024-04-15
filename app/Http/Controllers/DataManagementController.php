<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataManagementController extends Controller
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
        if (request()->has('env') && request()->input('env')) {
            $env_val = (request()->input('env') == 'central_park') ? 'Central Park' : 'Garden By The Bay';
            $banners['banners'] = Banner::where('env', $env_val)->paginate($this->limit);
        } else {
            $banners['banners'] = Banner::paginate($this->limit);
        }
        $bannerCheck['central_park_Billboard1'] = 0;
        $bannerCheck['central_park_Billboard2'] = 0;
        $bannerCheck['central_park_Billboard3'] = 0;
        $bannerCheck['gardens_by_the_bay_Billboard1'] = 0;
        $bannerCheck['gardens_by_the_bay_Billboard2'] = 0;
        $bannerCheck['gardens_by_the_bay_Billboard3'] = 0;
        foreach ($banners['banners'] as $key => $banner) {
            $env_val = ($banner['env'] == 'Central Park') ? 'central_park' : 'gardens_by_the_bay';
            $bannerCheck[$env_val . "_" . $banner['type']] = 1;
        }
        $banners['bannerCheck'] = $bannerCheck;
        return view('banner.index')->with($banners);
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

        $data['env'] = '';
        $data['file'] = '';
        $env_val = ($request->env == 'central_park') ? 'Central Park' : 'Garden By The Bay';
        if($request->banner_id) {
            $update = Banner::find($request->banner_id);
            $text = '';
            if($request->billboard1_description) {
                $text = $request->billboard1_description;
            }
            if($request->billboard2_description) {
                $text = $request->billboard2_description;
            }
            if($request->billboard3_description) {
                $text = $request->billboard3_description;
            }
            
            $file_name = '';
            if ($request->has('billboard1') && $request->billboard1 !== null) {
                $request->validate([
                    'billboard1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $file_name = $this->store_file($request->billboard1);
            }
            if ($request->has('billboard2') && $request->billboard2 !== null) {
                $request->validate([
                    'billboard2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $file_name = $this->store_file($request->billboard2);
            }
            if ($request->has('billboard3') && $request->billboard3 !== null) {
                $request->validate([
                    'billboard3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $file_name = $this->store_file($request->billboard3);
            }
            $update->text = $text;
            if($file_name) {
                $update->file = $file_name;
            }
            $update->save();
            return redirect()->route('data-management.index', ['env' => $request->env]);
        }
        $error = null;
        if ($request->has('billboard1') && $request->billboard1 !== null) {
            $request->validate([
                'billboard1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $sizes = $this->getFileDimension($request->file('billboard1'));
            if($sizes['width'] !== 1024 && $sizes['height'] !== 300) {
                $error = 'Resolution of the image uploaded does not match with the recommended resolution of 1024x300';
            }
            $file_name = $this->store_file($request->billboard1);
            $data['text'] = $request->billboard1_description;
            $data['env'] = $env_val;
            $data['type'] = 'Billboard1';
            $data['file'] = $file_name;
            Banner::create($data);
        }
        if ($request->has('billboard2') && $request->billboard2 !== null) {
            $request->validate([
                'billboard2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $sizes = $this->getFileDimension($request->file('billboard2'));
            if($sizes['width'] !== 1024 && $sizes['height'] !== 256) {
                $error = 'Resolution of the image uploaded does not match with the recommended resolution of 1024x256';
            }
            $file_name = $this->store_file($request->billboard2);
            $data['text'] = $request->billboard2_description;
            $data['env'] = $env_val;
            $data['type'] = 'Billboard2';
            $data['file'] = $file_name;
            Banner::create($data);
        }
        if ($request->has('billboard3') && $request->billboard3 !== null) {
            $request->validate([
                'billboard3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $sizes = $this->getFileDimension($request->file('billboard3'));
            if($sizes['width'] !== 225 && $sizes['height'] !== 156) {
                $error = 'Resolution of the image uploaded does not match with the recommended resolution of 225x156';
            }
            $file_name = $this->store_file($request->billboard3);
            $data['text'] = $request->billboard3_description;
            $data['env'] = $env_val;
            $data['type'] = 'Billboard3';
            $data['file'] = $file_name;
            Banner::create($data);
        }

        return redirect()->route('data-management.index', ['env' => $request->env])->with('error', $error);
    }

    /**
     * Get file dimension
     * @param  \Illuminate\Http\UploadedFile $file
     * @return array
     */
    public function getFileDimension(UploadedFile $file): array
    {
        $size = getimagesize($file->getRealPath());

        return [
            'width'     => $size[0] ?? 0,
            'height'    => $size[1] ?? 0,
        ];
    }

    /**
     * @param $file
     * @return $user_file
     * File will save into public/banner 
     */

    private function store_file($file)
    {
        $user_file = uniqid() . '.' . File::extension($file->getClientOriginalName());
        Storage::putFileAs('public/banner/', $file, $user_file);
        return $user_file;
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $env = $request->env;
        $banner = Banner::find($id);
        if (strlen($banner->file) > 0 && file_exists('public/storage/banner/' . $banner->file))
            unlink('public/storage/banner/' . $banner->file);
        $banner->delete();
        return redirect()->route('data-management.index', ['env' => $env]);
    }
}
