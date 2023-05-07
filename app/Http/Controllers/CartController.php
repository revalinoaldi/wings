<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $forHeader = [];

    public function __construct()
    {
        if (@auth()->user()->roles->slug == "administrator") {
            return redirect()->route('dashboard-admin');
        }

        $this->forHeader['menuSide'] = Kategori::all();
        $this->forHeader['menuCenter'] = Kategori::limit(6)->get();
    }

    public function getCartList()
    {
        $items = \Cart::session(auth()->user()->id)->getContent();

        return response()->json([
            'title' => 'success',
            'message' => 'Success get to cart',
            'data' => $items
        ]);
    }

    public function addToCart(Request $request)
    {
        $produk = Produk::find($request->kode_produk);
        // $cart = \Cart::session(auth()->user()->id)->getContent($request->kode_produk);
        // if (@$cart) {
        //     \Cart::session(auth()->user()->id)->update($request->kode_produk,[
        //         'price' => $request->harga,
        //         'quantity' => $request->qty,
        //     ]);
        // }else{
            \Cart::session(auth()->user()->id)->add(array(
                'id' => $request->kode_produk,
                'name' => $request->nama_produk,
                'price' => $request->harga,
                'quantity' => $request->qty,
                'attributes' => $request->toArray(),
                'associatedModel' => $produk
            ));
        // }


        return response()->json([
            'title' => 'success',
            'message' => 'Success add to cart'
        ]);
    }

    public function updateToCart(Request $request)
    {
        \Cart::session(auth()->user()->id)->update($request->kode_produk,[
            'quantity' => $request->qty,
        ]);

        return response()->json([
            'title' => 'success',
            'message' => 'Success update cart list'
        ]);
    }

    public function deleteCartList(Request $request)
    {
        $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId)->remove($request->kode_produk);

        return response()->json([
            'title' => 'success',
            'message' => 'Success delete cart list'
        ]);
    }

    public function index()
    {
        // $userId = auth()->user()->id;
        // \Cart::session($userId)->clear();
        return view('frontend.cart',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ],
            'carts' => \Cart::session(auth()->user()->id)->getContent()
        ]);
    }
}
