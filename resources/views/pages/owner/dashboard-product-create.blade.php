@extends('layouts.dashboard')

@section('title','Store Dashboard Products')

@section('content')
     <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
        >
        <div class="container-fluid">
            <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Product</h2>
            <p class="dashboard-subtitle">Create your own product</p>
            </div>
            <div class="dashboard-content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                <form action="{{ route('dashboard-product-store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="nama_toko">Product Name</label>
                            <input type="text" class="form-control" name="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="nama_toko">Price</label>
                            <input type="number" class="form-control" name="price"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="categories_id">
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
                            <textarea id="editor1" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="nama_toko">Thumbnail</label>
                            <input name="photo" type="file" class="form-control" />
                            <p class="text-muted">
                                Kamu bisa memilih lebih dari satu file.
                            </p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col text-right">
                            <button
                            class="btn btn-success px-5"
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