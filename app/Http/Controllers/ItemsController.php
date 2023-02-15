<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ItemsController extends Controller
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
        $item = item::all();
        $category = category::all();
        // return $item;
        return view('items.index',compact('category','item'));
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
            'category_id' => 'required', 
            'name' => 'required', 
            'img' => 'mimes:jpg,png', 
            'deskripsi' => 'required', 
            'stock' => 'required|numeric', 
            'price' => 'required|numeric', 
         ]);

         

         //ambil informasi file yang di upload 
        $file = $request->file('img');
        //rename 
        $nama_file = time()."_".$file->getClientOriginalName();
        //proses upload 
        $tujuan_upload= './template/img';
        $file->move($tujuan_upload,$nama_file); 
        // return $item;

        item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'img' => $nama_file,
            'deskripsi' => $request->deskripsi,
            'price' => $request->price,
            'stock' => $request->stock,
         ]);

        return redirect()->back()->with('status', 'item berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = item::find($id);
        $category = category::all();
        // return $item;
        return view('items.edit',compact('item','category'));
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
        
        $this->validate($request,[
           'category_id' => 'required', 
           'name' => 'required', 
           'img' => 'required',
           'deskripsi' => 'required',
           'stock' => 'required|numeric', 
           'price' => 'required|numeric', 
        ]);

        $i = item::findorfail($id);
        $i->update($request->all());
        return redirect('items')->with('status', 'item berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        item::destroy($id);
        return redirect()->back()->with('status', 'item berhasil dihapus');
    }
}
