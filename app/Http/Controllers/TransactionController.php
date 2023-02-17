<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\kupon;
use App\Models\TransactionDetail;
use App\Models\User;
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
        $uk = $kupon->quantity_kupon;

        // return $k;
        // return $kupon;
        // return $kupon;
        return view('transaction', compact('item', 'cart', 'kupon', 'k', 'uk'));
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
        // dd($request->all());
        $trans = transaction::create([
            // 'user_id' => $request->user_id,
            'total' => $request->total,
            'pay_total' => $request->pay_total,
            'userkupon_id' => $request->userkupon_id,
        ]);

        
        $u = auth()->user()->id;
        $user_kupon = user_kupon::find($u);
        // return $user_kupon; 
        $user_kupon->update([
            'quantity_kupon' => $request->disc
        ]);
        
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

        $user_kupon = user_kupon::where('id', $uk)->get();
        $jumlahkupon = $user_kupon[0]['quantity_kupon'];

        // $userk = user_kupon::find($uk);
        $userk = user_kupon::where('user_id', $uk)->get();
        foreach ($userk as $k) {
            $thiss = $k->quantity_kupon;
        }

        // if ($thiss == null) {
        //     return 
        // } else 


        if ($ht >= $hk) {
            $user_kupon = $request->quantity_kupon;
            user_kupon::where('id', $uk)->update([
                'quantity_kupon' =>  $jumlahkupon += 1
            ]);
            cart::truncate();
            return redirect(route('transaction.show', transaction::latest()->first()->id))->with('status', 'selamat !, anda mendapatkan kupon');
        } else {

            cart::truncate();
            return redirect(route('transaction.show', transaction::latest()->first()->id));
        }

        // $trax = Transaction::where('id', '6')->with('userkupon')->get();
        // return $trax;

    }

    public function kupon()
    {
        // return true;
        return redirect()->back()->with('status', 'kupon berhasil ditambahkan');
    }

    public function history()
    {
        $r = auth()->user()->id;
        
        if (auth()->user()->role == 'admin') {
            // return true;
            $t = Transaction::all();
        }else{
            // return 'false';
            $t = Transaction::where('userkupon_id',$r)->with('userkupon')->get();
        }
        // return $t;  
        // $served = Transaction::where('transaction.id', '1')->join('user_kupons','user_kupons.id', '=', 'transaction.userkupon_id')->get();
        // foreach($served as $s){
        //     $a =$s->user->name;
        // }
        $a = 'a';
        // return $t;
        return view('historytransaction', compact('t','a'));
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
        $served = user_kupon::where('id',$r)->with('user')->get();
        foreach($served as $s){
            $a =$s->user->name;
        }
        // return $r;
        // $trx = Transaction::where('userkupon_id',$r)->with('user ')->get();
        $trx = transaction::find($id);
        // return $trx;
        return view('detailtransaction', compact('trx','a'));
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
