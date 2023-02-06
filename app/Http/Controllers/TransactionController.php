<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\kupon;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
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
        $k = kupon::all();
        return $k;
        // if(){eb
        transaction::create($request->all());
        $carts = cart::all();
        $trx = transaction::latest()->first()->id;
        foreach($carts as $c){
            TransactionDetail::create([
                'transaction_id' => $trx,
                'item_id' => $c->item_id,
                'qty' => $c->qty,
                'subtotal' => $c->item->price*$c->qty
            ]);
        }
        cart::truncate();
        
        return redirect(route('transaction.show', transaction::latest()->first()->id));
    }

    public function history()
    {
        return view('historytransaction');
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
