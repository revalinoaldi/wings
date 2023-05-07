<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.index',[
            'config' => [
                'title' => 'Order Page'
            ],
            'transaksi' => Transaksi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $order)
    {
        return view('admin.order.show',[
            'config' => [
                'title' => 'Order Page'
            ],
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $order)
    {
        $valid = $request->validate([
            'status_transaksi' => 'required'
        ]);

        $valid['user_approve'] = auth()->user()->id;
        $valid['status_transaksi'] = (string)$valid['status_transaksi'];
        $is_success = Transaksi::where('id', $order->id)->update($valid);
        if ($is_success) {
            $this->_altTrigger($valid['status_transaksi'], $order);

            return redirect('/admin/order')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Update!</h4>
                Data Order Berhasil di Update ke Record!
            </div>');
        }else{
            return redirect("/admin/order/{$order->kode_transaksi}")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Update!</h4>
                Data Transaksi Gagal di Update ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    private function _altTrigger($status, $transaksi)
    {
        // Change status cancel to confirm -> restock qty product form cancel to confirm (-qty)
        if($status == "1" && $transaksi->status_transaksi == "2"){
            foreach ($transaksi->detail_transaksi as $detail) {
                $data = [
                    'stok' => $detail->produk->stok - $detail->qty
                ];
                Produk::where('kode_produk',$detail->produk->kode_produk)->update($data);
            }
        }
        // Change status waiting to cancel -> restock qty product form waiting to cancel (+qty)
        elseif ($status == "2" && $transaksi->status_transaksi == "0") {
            foreach ($transaksi->detail_transaksi as $detail) {
                $data = [
                    'stok' => $detail->produk->stok + $detail->qty
                ];
                Produk::where('kode_produk',$detail->produk->kode_produk)->update($data);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
