@extends('layouts.success')

@section('title')
    register success 
@endsection

@section('content')
  <div class="page-content page-success">
    <div class="section-success" data-aos="zoom-in">
      <div class="container">
        <div class="row align-items-center row-login justify-content-center">
          <div class="col-lg-6 text-center">
            <img src="/images/success.svg" alt="" class="mb-4" />
            <h2>Welcome to Store</h2>
            <p>
              Kamu sudah berhasil terdaftar<br />
              Let’s grow up now.in!
            </p>
            <div>
              <a href="/dashboard.html" class="btn btn-success w-50 mt-4"
                >My dashboard</a
              >
              <a href="/dashboard.html" class="btn btn-signup w-50 mt-2"
                >Go To Shoop</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection