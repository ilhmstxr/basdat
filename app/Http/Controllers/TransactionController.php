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
        // return $item;
        return view('transaction', compact('item', 'cart'));
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
        $kpn = kupon::find(1)->get();
        
        $trans = transaction::create($request->all());
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


        $ht = $trans->total;
        $kont = [];
        foreach($kpn as $k){
            $kont = $k->harga_ketentuan;
        }
        
        $uk = auth()->user();
        $user_kupon = user_kupon::where('user_id',$uk)->get();
        
        return $user_kupon;
        return $uk;
        if ($ht >= $kont){
            
            return redirect(route('transaction.show', transaction::latest()->first()->id));
        }else{
            
            return redirect(route('transaction.show', transaction::latest()->first()->id));
        }



        cart::truncate();

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
        $trx = Transaction::find($id);
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
