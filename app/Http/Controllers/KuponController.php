<?php

namespace App\Http\Controllers;

use App\Models\kupon;
use App\Models\user_kupon;
use App\Models\User;
use Illuminate\Http\Request;

class KuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kupon = kupon::all();
        // return $kupon;
        return view('kupon.index',compact('kupon'));
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
        $this->validate($request,[
            'stok' => 'required|numeric', 
           'harga_ketentuan' => 'required|numeric', 
           'diskon' => 'required|numeric',
         ]);

         kupon::create([
            'stok' => $request-> stok, 
           'harga_ketentuan' => $request-> harga_ketentuan, 
           'diskon' => $request-> diskon,
         ]);

        return redirect()->back()->with('status', 'Kupon berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function show(kupon $kupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kupon = kupon::find($id);
        return view('kupon.edit',compact('kupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
           'stok' => 'required|numeric', 
           'harga_ketentuan' => 'required|numeric', 
           'diskon' => 'required|numeric', 
        ]);

        $i = kupon::findorfail($id);
        $i->update($request->all());
        return redirect('kupon.index')->with('status', 'Kupon berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */

    public function userkupon()
    {
        $userK = user_kupon::all();
        $userK3 = kupon::all();
        $userM = User::all();
        $a = auth()->user();
        // $u = user::all()->join('users', 'users.id', '=', 'user_kupons.user_id');
        // $u = user::find($id);
        // return $u;
return redirect('profile', compact('a'));
        // return $userM;
        // return $userK;
        return view ('user.index', compact('userK', 'userM', 'userK3'));
    }

    public function destroy($id)
    {
        kupon::destroy($id);
        // return $id;
        return redirect()->back()->with('status', 'Kupon berhasil dihapus');
        // good luck bozo
    }
}
