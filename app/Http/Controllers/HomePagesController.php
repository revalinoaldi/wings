<?php

namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomePagesController extends Controller
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

    public function index()
    {
        return view('frontend.dashboard',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ],
            'produks' => Produk::latest()->whereHas('kategori', function($query)  {
                            $query->where('deleted_at', NULL);
                        })->filter(request(['search','category']))->paginate(8)->withQueryString()
        ]);
    }

    public function produk(Produk $produk)
    {
        return view('frontend.single',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ],
            'produk' => $produk
        ]);
    }

    public function checkout(Request $request, Produk $produk)
    {

        $valid = $request->validate([
            'qty' => ['required']
        ]);

        if ($request->qty > $produk->stok) {
            return redirect("/produk/{$produk->kode_produk}")->with('message','Qty Melebihi stok yang tersedia!');
        }

        return view('frontend.checkout',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ],
            'qty' => $request->qty,
            'produk' => $produk
        ]);
    }

    public function order(Request $request)
    {
        $rules = [
            'produk_id' => 'required',
            'qty' => 'required',
            'total' => 'required',
            'subtotal' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'checked-order' => 'required'
        ];

        if ($request->anotherSend) {
            $rules['no_telpLain'] = 'required';
            $rules['alamatLain'] = 'required';
        }

        $valid = $request->validate($rules);
        if ($request->anotherSend) {
            $valid['no_telp'] = $valid['no_telpLain'];
            $valid['alamat'] = $valid['alamatLain'];
        }
        // $valid['kode_transaksi'] = ;

        $is_transaksi = Transaksi::create([
            'kode_transaksi' => rand(0, 9999999999),
            'user_id' => auth()->user()->id,
            'no_telp' => $valid['no_telp'],
            'alamat' => $valid['alamat'],
            'tanggal_transaksi' => Carbon::now()->format('Y-m-d H:i:m'),
            'total_transaksi' => $valid['total'],
            'total_qty' => $valid['qty']
        ]);
        if ($is_transaksi) {
            $is_detail = Detail_Transaksi::create([
                'transaksi_id' => $is_transaksi->id,
                'produk_id' => $valid['produk_id'],
                'qty' => $valid['qty'],
                'subtotal' => $valid['subtotal'],
                'total' => $valid['total']
            ]);
            if ($is_detail) {
                return redirect('/')->with('alert','
                    <script>alert(`Successfull Checkout Order!`)</script>
                ');
            }else{
                return back()->withInput()->with('alert','
                    <script>alert(`Unsuccessfull Checkout! Please check your submited data`)</script>
                ');
            }
        }
    }

    // My Order

    public function myorder()
    {
        $transaksi = DB::table('transaksi')
                    ->join('detail_transaksi', 'transaksi.id', '=', 'detail_transaksi.transaksi_id')
                    ->leftJoin('transaksi_pembayaran', 'transaksi.id', '=', 'transaksi_pembayaran.transaksi_id')
                    ->join('users', 'transaksi.user_id', '=', 'users.id')
                    ->join('produk', 'detail_transaksi.produk_id', '=', 'produk.id')
                    ->join('kategori', 'produk.ketegori_id', '=', 'kategori.id')
                    ->select('*')->where('transaksi.user_id', auth()->user()->id);

        return view('frontend.myorder',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ],
            'orders' => $transaksi->paginate(8)
        ]);
    }

    public function paidorder(Transaksi $transaksi)
    {
        return view('frontend.paidorder',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ],
            'order' => $transaksi,
            'rekening' => [
                [
                    'rekening' => 'BCA',
                    'deskripsi' => '713455662 A/n Dummy Online Shop (BCA)'
                ],
                [
                    'rekening' => 'BRI',
                    'deskripsi' => '145212371123 A/n Dummy Online Shop (BRI)'
                ],
                [
                    'rekening' => 'Mandiri',
                    'deskripsi' => '99827166263612 A/n Dummy Online Shop (Mandiri)'
                ],
            ]
        ]);
    }

    public function paid(Request $request, Transaksi $transaksi)
    {

        $valid = $request->validate([
            'jumlah_pembayaran' => 'required',
            'rekening_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image|file|max:2048',
        ]);

        if ($request->jumlah_pembayaran != $transaksi->total_transaksi) {
            return redirect("/paid-order/{$transaksi->kode_transaksi}")->with('message','Jumlah yang di bayarkan tidak sesuai!');
        }

        $valid['tanggal_pembayaran'] = Carbon::now()->format('Y-m-d H:i:m');
        if ($request->file('bukti_pembayaran')) {
            $filenameWithExt = $request->file('bukti_pembayaran')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $valid['bukti_pembayaran'] = $request->file('bukti_pembayaran')->storeAs('public/bukti-bayar',
            $filenameSimpan);
        }

        if (!@$transaksi->transaksi_pembayaran) {
            $valid['transaksi_id'] = $transaksi->id;
            $is_transaksi = Transaksi_Pembayaran::create($valid);
            if ($is_transaksi) {
                return redirect('/my-order')->with('alert','
                    <script>alert(`Successfull Paid Order!`)</script>
                ');
            }else{
                return back()->withInput()->with('alert','
                    <script>alert(`Unsuccessfull Paid Order! Please check your submited data`)</script>
                ');
            }
        }else{
            $is_transaksi = Transaksi_Pembayaran::where('id', $transaksi->transaksi_pembayaran->id)->update($valid);
            if ($is_transaksi) {
                return redirect('/my-order')->with('alert','
                    <script>alert(`Successfull Update Paid Order!`)</script>
                ');
            }else{
                return back()->withInput()->with('alert','
                    <script>alert(`Unsuccessfull Update Paid Order! Please check your submited data`)</script>
                ');
            }
        }
    }
}
