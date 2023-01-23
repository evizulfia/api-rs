<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obat = Obat::all();

        return $obat;
    }

    public function search(Request $request)
    {
        //
        $obat = Obat::where('nama_obat', 'like', '%'.$request->search.'%')
                        ->orWhere('id_obat', 'like', '%'.$request->search.'%')
                        ->get();

        return $obat;
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
        $id_obat = $request->id_obat;

        $obat = Obat::where('id_obat', $id_obat)->first();

        if($obat){
            $obat->nama_obat    = $request->nama_obat;
            $obat->harga        = $request->harga;
            $obat->satuan       = $request->satuan;
            $obat->save();
    
            
            return array(
                'status' => '200',
                'message' => 'update obat sukses',
                'data' => $obat
            );

        }else{
            $obat = new Obat();
            $obat->id_obat      = $request->id_obat;
            $obat->nama_obat    = $request->nama_obat;
            $obat->harga        = $request->harga;
            $obat->satuan       = $request->satuan;
            $obat->save();
    
            
            return array(
                'status' => '200',
                'message' => 'insert obat sukses',
                'data' => $obat
            );

        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obat =  Obat::where('id_obat',$id)->first();
        if($obat->delete()){
            return array(
                'status' => '200',
                'message' => 'delete obat sukses'
            );
        }else{
            return array(
                'status' => '500',
                'message' => 'delete error'
            );
        }
    }
}
