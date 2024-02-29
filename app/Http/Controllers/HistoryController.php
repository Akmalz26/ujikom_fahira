<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\penjualan;
use App\Models\User;
use App\Models\DetailPenjualan;
use Auth;
use Alert;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$penjualans = penjualan::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();
        $users = User::all();

    	return view('history.index', compact('penjualans','users'));
    }

    public function detail($id)
    {
    	$penjualan = penjualan::where('id', $id)->first();
    	$detail_penjualans = DetailPenjualan::where('penjualan_id', $penjualan->id)->get();
        $users = User::all();


     	return view('history.detail', compact('penjualan','detail_penjualans','users'));
    }
}
