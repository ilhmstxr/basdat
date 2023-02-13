<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\kupon;
use App\Models\TransactionDetail;
use App\Models\user_kupon;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = item::doesnthave('cart')->where('stock', '>', 0)->get();
        $cart = item::has('cart')->get()->sortByDesc('cart.created_at');
        $user = auth()->user()->id;
        $kupon = user_kupon::find($user);
        $k = kupon::find(1);
        // return $kupon;
        return view('transaction', compact('item', 'cart','kupon','k'));
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
        cart::create($request->all());
        return redirect()->back()->with('status', 'item berhasil ditambahkan ke keranjang');
    }

    public function checkout(Request $request)
    {

        $trans = transaction::create($request->all());
        $ht = $trans->total;
        $carts = cart::all();
        $trx = transaction::latest()->first()->id;
        $t = [];
        foreach ($carts as $c) {
            $t = TransactionDetail::create([
                'transaction_id' => $trx,
                'item_id' => $c->item_id,
                'qty' => $c->qty,
                'subtotal' => $c->item->price * $c->qty
            ]);
        }
        
        $kpn = kupon::find(1);
        $hk = $kpn->harga_ketentuan;
        $uk = auth()->user()->id;
        // $jmluk = user_kupon::all();
        // return $user_kupon;
        // if($jmluk == ){
        //     user_kupon::create([
        //         'user_id' => $uk ,
        //         'kupon_id' => 1 ,
        //         'quantity_kupon' => 1,
        //     ]);
        // }
        
        $user_kupon = user_kupon::where('id', $uk)->get();
        $jumlahkupon = $user_kupon[0]['quantity_kupon'];
        // return $kpn;

        // elseif($user_kupon['kupon_id' == null]){

        // }

        if ($ht >= $hk) {
            $user_kupon = $request->quantity_kupon;
            user_kupon::where('id', $uk)->update([
                'quantity_kupon' =>  $jumlahkupon += 1
            ]);

            
            cart::truncate();
            return redirect(route('transaction.show', transaction::latest()->first()->id))->with('status', 'selamat !, anda mendapatkan kupon');
        }else{
            
            cart::truncate();
            return redirect(route('transaction.show', transaction::latest()->first()->id));
        }
    }

    public function kupon()
    {
        // return true;
        return redirect()->back()->with('status', 'kupon berhasil ditambahkan');
    }

    public function history()
    {
        $t = Transaction::all();
        // return $t;
        return view('historytransaction', compact('t'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        // return redirect()->back();
        $r = auth()->user()->id;
        // return $r;
        // $trx = Transaction::where('userkupon_id',$r)->with('user ')->get();
        $trx = transaction::find($id);  
        // return $trx;
        return view('detailtransaction', compact('trx'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $i = cart::findorfail($id);
        $i->update($request->all());
        return redirect('transaction')->with('status', 'qty update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $i = cart::findorfail($id);
        $i->delete();
        return redirect()->back()->with('status', 'item berhasil dihapus dari keranjang');
    }
}


?>
