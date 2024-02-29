<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
class HomeController extends Controller
{
    public function index()
    {
        //get all produks from Models
        $produks = Produk::latest()->get();

        //return view with data
        return view('home', compact('produks'));
    }

    public function shop()
    {
        //get all produks from Models
        $produks = Produk::latest()->get();

        //return view with data
        return view('frontend.shop', compact('produks'));
    }

    public function detail_produk($id)
    {
        $produk = Produk::where('id', $id)->first();
        
        return view('frontend.detail-produk',  compact('produk'));
    }
}
