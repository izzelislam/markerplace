<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user=Auth::user();
        $categories=Category::all();
        return view('pages.owner.dashboard-setting',compact('user','categories'));
    }

    public function account()
    {
        $user=Auth::user();
        return view('pages.owner.dashboard-account',compact('user'));
    }

    public function update(Request $request,$redirect)
    {
        $data=$request->all();
        $item = Auth::user();

        $item->update($data);

        return redirect(route($redirect));
    }
}
