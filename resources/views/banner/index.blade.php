@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body pb-5">
                    <h1 class="text-left mb-4"><strong>Data Management</strong></h1>
                    <form method="get" class="pt-2" action="">
                        <div class="d-flex justify-content-center bd-highlight ">
                            <a href="{{ route('data-management.index', 'env=central_park') }}" role="button"
                                class="nav-link p-3 text-center width_50 {{ request()->input('env') && request()->input('env') == 'central_park' ? 'btn_active' : '' }}">
                                <div class="font-1-5">CENTRAL PARK</div>
                            </a>
                            <a href="{{ route('data-management.index', 'env=gardens_by_the_bay') }}" role="button"
                                class="nav-link p-3 text-center width_50 {{ request()->input('env') && request()->input('env') == 'gardens_by_the_bay' ? 'btn_active' : '' }}">
                                <div class="font-1-5">GARDENS BY THE BAY</div>
                            </a>

                        </div>
                    </form>
                    @if (request()->input('env') != '')
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <form method="post" id="Billboard1" action="{{ route('data-management.store', ['env' => request()->input('env')]) }}" accept-charset="utf-8" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="banner_id" value="" />
                                    <div class="card mb-3" style="max-width: 18rem; margin: 0 auto 0">
                                        <div class="card-header bd-highlight text-white text-center">Billboard 1</div>
                                        <div class="card-body text-center pt-5">
                                            <img src="{{ asset('public/images/Billboard1.png') }}" class=" banner-img-size" alt="...">
                                            <div class="btn btn-primary btn-other file mt-4 div-upload nav-link text-center width_100 {{ request()->input('env') && !$bannerCheck[request()->input('env') . '_Billboard1'] ? 'active' : 'disabled' }}">
                                                Upload
                                                <input type="file" name="billboard1" id="file_sqr" class="div-upload-input " accept="image/*" />
                                            </div>
                                            <h5 class="small">Resolution 1024px x 300px. File Size < 2MB</h5>
                                            @error('billboard1')
                                                <div class="small text-danger mb-3">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-start mb-0">
                                                <label class="form-label" for="billboard1_description">Description</label>
                                            </p>
                                            <textarea class="form-control" name="billboard1_description" id="billboard1_description" rows="3">{{ old('billboard1_description') ? old('billboard1_description') : '' }}</textarea>
                                            @error('billboard1_description')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-start">
                                                <button type="submit" class="btn btn-primary btn-other mt-2" {{ request()->input('env') && !$bannerCheck[request()->input('env') . '_Billboard1'] ? 'active' : 'disabled' }}>Submit</button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="post" id="Billboard2" action="{{ route('data-management.store', ['env' => request()->input('env')]) }}" accept-charset="utf-8" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="banner_id" value="" />
                                    <div class="card mb-3" style="max-width: 18rem; margin: 0 auto 0">
                                        <div class="card-header bd-highlight text-white text-center">Billboard 2</div>
                                        <div class="card-body text-center pt-5">
                                            <img src="{{ asset('public/images/Billboard2.png') }}" class="banner-img-size" alt="...">
                                            <div class="btn btn-primary btn-other file mt-4 div-upload nav-link text-center width_100 {{ request()->input('env') && !$bannerCheck[request()->input('env') . '_Billboard2'] ? 'active' : 'disabled' }}">
                                                Upload
                                                <input type="file" name="billboard2" id="file_rect" class="div-upload-input  btn-link" accept="image/*" />
                                            </div>
                                            <h5 class="small">Resolution 1024px x 256px. File Size < 2MB</h5>
                                            @error('billboard2')
                                                <div class="small text-danger mb-3">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-start mb-0">
                                                <label class="form-label" for="billboard2_description">Description</label>
                                            </p>
                                            <textarea class="form-control" name="billboard2_description" id="billboard2_description" rows="3">{{ old('billboard2_description') ? old('billboard2_description') : '' }}</textarea>
                                            @error('billboard2_description')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-start">
                                                <button type="submit" class="btn btn-primary btn-other mt-2" {{ request()->input('env') && !$bannerCheck[request()->input('env') . '_Billboard2'] ? 'active' : 'disabled' }}>Submit</button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="post" id="Billboard3" action="{{ route('data-management.store', ['env' => request()->input('env')]) }}" accept-charset="utf-8" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="banner_id" value="" />
                                    <div class="card mb-3" style="max-width: 18rem; margin: 0 auto 0">
                                        <div class="card-header bd-highlight text-white text-center">Billboard 3</div>
                                        <div class="card-body text-center pt-5">
                                            <img src="{{ asset('public/images/Billboard3.png') }}" class=" banner-img-size" alt="...">
                                            <div class="btn btn-primary btn-other file mt-4 div-upload nav-link text-center width_100 {{ request()->input('env') && !$bannerCheck[request()->input('env') . '_Billboard3'] ? 'active' : 'disabled' }}">
                                                Upload
                                                <input type="file" name="billboard3" id="file_d_rect" class="div-upload-input  btn-link" accept="image/*" />
                                            </div>
                                            <h5 class="small">Resolution 225px x 156px. File Size < 2MB</h5>
                                            @error('billboard3')
                                                <div class="small text-danger mb-3 text-center">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-start mb-0">
                                                <label class="form-label" for="billboard3_description">Description</label>
                                            </p>
                                            <textarea class="form-control" name="billboard3_description" id="billboard3_description" rows="3">{{ old('billboard3_description') ? old('billboard3_description') : '' }}</textarea>
                                            @error('billboard3_description')
                                                <div class="small text-danger text-center">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="text-start">
                                                <button type="submit" class="btn btn-primary btn-other mt-2" {{ request()->input('env') && !$bannerCheck[request()->input('env') . '_Billboard3'] ? 'active' : 'disabled' }}>Submit</button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (session()->has('error'))
                            <p class="mt-2 text-warning text-center">
                                {{ session()->get('error') }}
                            </p>
                        @endif
                        <table class="table table-striped table-hover mt-3">
                            <thead class="thead-color">
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Environment</th>
                                    <th>Type</th>
                                    <th>Banner</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($banners->count() > 0)
                                    @foreach ($banners as $key => $banner)
                                        <tr>
                                            <td>{{ $banners->firstItem() + $key }}</td>
                                            <td>{{ $banner->text ? $banner->text: 'N/A' }}</td>
                                            <td>{{ $banner->env }}</td>
                                            <td>{{ $banner->type }}</td>
                                            <td>
                                                <div class="{{ $banner->file ? 'zoomm' : '' }}">
                                                    <img src="{{ asset('public/storage/banner/' . $banner->file) }}" class="img" alt="..." width="50" height= "21">
                                                </div>
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('data-management.destroy', $banner->id) }}" class="form-inline">
                                                    @csrf
                                                    <input type="hidden" name="env" value="{{ request()->input('env') }}" >
                                                    @method('delete')
                                                    <div class="d-flex justify-content-end">
                                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                            <button type="button" class="btn btn-sm btn-primary edit-banner" data-banner="{{ json_encode($banner) }}">
                                                                <i class="feather feather-edit align-middle" data-feather="edit"></i>
                                                            </button>
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="feather feather-trash align-middle" data-feather="trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">No Banner Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                       
                        @if ($banners->count() > 0)
                            <div class="d-flex justify-content-end">
                                {{ $banners->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
