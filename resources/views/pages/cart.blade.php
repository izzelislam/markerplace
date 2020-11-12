@extends('layouts.app')

@section('title')
    Store Category Page
@endsection

@section('content')
  <div class="page-content page-cart">
    <section
      class="store-breadcrumbs"
      data-aos="fade-down"
      data-aos-delay="100"
    >
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/index.html">Home</a>
                </li>
                <li class="breadcrumb-item active">Cart</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <section class="store-cart">
      <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-12 table-responsive">
            <table class="table table-borderless table-cart">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name & Seller</th>
                  <th>Price</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tbody class="pt-4">
                @php
                    $total_price=0;
                @endphp
                @foreach ($carts as $cart)
                    <tr>
                      <td style="width: 25%">
                       @if ($cart->product->galleries)
                        <img
                          src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                          alt=""
                          class="card-image w-100 pr-5"
                        />
                       @endif
                      </td>
                      <td style="width: 35%">
                        <div class="product-title">{{ $cart->product->name }}</div>
                        <div class="product-subtitle">by {{ $cart->product->user->store_name }}</div>
                      </td>
                      <td style="width: 35%">
                        <div class="product-title">{{ number_format($cart->product->price) }}</div>
                        <div class="product-subtitle">IDR</div>
                      </td>
                      <td style="width: 20%">
                        <form method="POST" action="{{ route('cart-delete', ['id'=>$cart->id]) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" href="" class="btn btn-remove-cart">Remove</button>
                        </form>
                      </td>
                    </tr>
                    @php
                        $total_price += $cart->product->price; 
                    @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-12">
            <hr />
          </div>
          <div class="col-12">
            <h2 class="mb-4">Shipping Details</h2>
          </div>
        </div>

        <form action="{{ route('checkout') }}" method="POST"  id="locations">
          @csrf
          <input type="hidden" name="total_price" value="{{ $total_price }}">
          <div class="row mb-2" data-aos-delay="200" data-aos="fade-up">
            <div class="col-md-6">
              <div class="form-group">
                <label for="addressOne">Address 1</label>
                <input
                  type="text"
                  class="form-control"
                  name="address_one"
                  id="AddressOne"
                  value="Setra Duta Cemara"
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
                  value="Setra Duta Cemara"
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
                  value="090999"
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
                  value="Setra Duta Cemara"
                />
              </div>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <h2 class="mb-2">Payment Information</h2>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-4 col-md-2">
              <div class="product-title">$2.10</div>
              <div class="product-subtitle">Country Tax</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="product-title">$22.10</div>
              <div class="product-subtitle">Product Insurance</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title">$220.10</div>
              <div class="product-subtitle">PShip to Jakarta</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title text-success">Rp.{{ number_format($total_price) ?? 0 }}</div>
              <div class="product-subtitle">Total</div>
            </div>
            <div class="col-8 col-md-3">
              <button
                type="submit"
                class="btn btn-success mt-4 px-4 btn-block"
                >Checkout Now
              </button>
            </div>
          </div>
        </form>

      </div>
    </section>
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