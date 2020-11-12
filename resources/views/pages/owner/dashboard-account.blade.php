@extends('layouts.dashboard')

@section('title','Store Dashboard')

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">My Account</h2>
        <p class="dashboard-subtitle">MUpdate your current profile</p>
        </div>
        <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
            <form action="{{ route('dashboard-redirect','dashboard-account') }}" method="POST" enctype="multipart/form-data" id="locations">
                @csrf
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="name">Your Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            value="{{ $user->name }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="email">Your Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            id="email"
                            value="{{ $user->email }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="addressOne">Address 1</label>
                        <input
                            type="text"
                            class="form-control"
                            name="address_one"
                            id="AddressOne"
                            value="{{ $user->address_one }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="addressTwo">Address 2</label>
                        <input
                            type="text"
                            class="form-control"
                            name="address_two"
                            id="AddressTwo"
                            value="{{ $user->address_two }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Province">Province</label>
                            <select name="provincies_id" id="Province" class="form-control" v-if="provinces" v-model="provinces_id">
                               <option  v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                            </select>
                            <select v-else class="form-control" name="" id=""></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select name="regencies_id" id="regencies" class="form-control" v-if="regencies" v-model="regencies_id">
                              <option  v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                            </select>
                            <select v-else class="form-control" name="" id=""></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="postcode">Post Code</label>
                        <input
                            type="text"
                            class="form-control"
                            name="zip_code"
                            id="postcode"
                            value="{{ $user->zip_code }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="country">Country</label>
                        <input
                            type="text"
                            class="form-control"
                            name="country"
                            id="country"
                            value="Indonesia"
                            {{ $user->country }}
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input
                            type="text"
                            class="form-control"
                            name="phone_number"
                            id="mobile"
                            value="{{ $user->phone_number }}"

                        />
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
  <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    var locations = new Vue({
      el: "#locations",
      mounted() {
        AOS.init();
        this.getProvincesData();
      },
      data: {
        provinces:null,
        regencies:null,
        provinces_id:null,
        regencies_id:null,
      },
      methods: {
        getProvincesData(){
          var self = this;
          axios.get('{{ route('api-provinces') }}')
          .then(function(response){
            self.provinces=response.data;
          })
        },
        getRegenciesData(){
          var self = this;
          axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
          .then(function(response){
            self.regencies=response.data;
          })    
        }
      },
      watch:{
        provinces_id:function(val,oldVal){
          this.regencies_id=null;
          this.getRegenciesData();
        },
      }
    });
  </script>
@endpush
