<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\Model\ProductGallery;
use Illuminate\Support\Str;

class DashboardProductsController extends Controller
{
    public function index()
    {
        $products=Product::with(['galleries','category'])->where('user_id',Auth::user()->id)->get();
        return view('pages.owner.dashboard-product',compact('products'));
    }

    public function detail(Request $request , $id)
    {
        $product=Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.owner.dashboard-product-detail',compact('product','categories'));
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product','public');
        
        ProductGallery::create($data);

        return redirect(route('dashboard-product-detail',$request->products_id));
    }

    public function delete(Request $request,$id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect(route('dashboard-product-detail',$item->products_id));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.owner.dashboard-product-create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        
        $data['slug'] = Str::slug($request->name);
        $product =Product::create($data);
        
        $gallery=[
            'products_id' => $product->id,
            'photos' =>$request->file('photo')->store('assets/product','public'),
        ];
        
        ProductGallery::create($gallery);

        return redirect(route('dashboard-product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $item=Product::findOrFail($id);
        $data['slug'] = Str::slug($request->name);

        $item->update($data);   
        return redirect(route('dashboard-product'));
    }

}

