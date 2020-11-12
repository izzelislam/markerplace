@extends('layouts.dashboard')

@section('title','Store Dashboard Products')

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">Shirup Marzan</h2>
        <p class="dashboard-subtitle">Product Details</p>
        </div>
        <div class="dashboard-content">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard-product-update', ['id'=>$product->id]) }}">
                @csrf
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="nama_toko">Product Name</label>
                        <input name="name" value="{{ $product->name }}" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="nama_toko">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $product->price }}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="kategori">Kategori</label>
                             <select class="form-control" name="categories_id">
                                 <option value="{{ $product->categories_id }}">{{ $product->category->name }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="nama_toko">Describtions</label>
                        <textarea id="editor1" name="description">{!! $product->description !!}</textarea>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12 text-right">
                        <button
                        class="btn btn-success px-5 btn-block"
                        type="submit"
                        >
                        Save Now
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">

                    @foreach ($product->galleries as $gallery)
                        <div class="col-12 col-md-4">
                            <div class="gallery-container">
                                <img
                                src="{{ Storage::url($gallery->photos ?? '') }}"
                                class="w-100"
                                alt=""
                                />
                                <a href="{{ route('dashboard-product-gallery-delete',$gallery->id) }}" class="delete-gallery">
                                    <img src="/images/icon-delete.svg" alt="" />
                                </a>
                            </div>
                        </div>    
                    @endforeach
                    
                    
                    <div class="col-12">
                        <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="products_id">
                            <input
                                type="file"
                                name="photos"
                                style="display: none"
                                id="file"
                                onchange="form.submit()"
                            />
                            <button
                                type="button"
                                class="btn btn-secondary btn-block mt-2"
                                onclick="thisFileUpload()"
                            >
                                Add Photo
                            </button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script>
      function thisFileUpload() {
        document.getElementById("file").click();
      }
    </script>
    <script>
      CKEDITOR.replace("editor1");
    </script>
@endpush