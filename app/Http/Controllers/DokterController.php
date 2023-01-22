<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dokter = Dokter::all();

        return $dokter;
    }

    public function search(Request $request)
    {
        //
        $dokter = Dokter::where('nama_dokter', 'like', '%'.$request->search.'%')
                        ->orWhere('id_dokter', 'like', '%'.$request->search.'%')
                        ->orWhere('no_telepon', 'like', '%'.$request->search.'%')
                        ->orWhere('spesialisasi', 'like', '%'.$request->search.'%')
                        ->get();

        return $dokter;
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

        $id_dokter = $request->id_dokter;

        $dokter = Dokter::where('id_dokter', $id_dokter)->first();

        if($dokter){
            $dokter->nama_dokter    = $request->nama_dokter;
            $dokter->spesialisasi   = $request->spesialisasi;
            $dokter->no_telepon     = $request->no_telepon;
            $dokter->save();
    
            
            return array(
                'status' => '200',
                'message' => 'update dokter sukses',
                'data' => $dokter
            );

        }else{
            $dokter = new Dokter();
            $dokter->id_dokter      = $request->id_dokter;
            $dokter->nama_dokter    = $request->nama_dokter;
            $dokter->spesialisasi   = $request->spesialisasi;
            $dokter->no_telepon     = $request->no_telepon;
            $dokter->save();
    
            
            return array(
                'status' => '200',
                'message' => 'insert dokter sukses',
                'data' => $dokter
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
        
        
        $dokter = Dokter::where('id_dokter',$id)->first();

        $dokter->nama_dokter    = $request->nama_dokter;
        $dokter->spesialisasi   = $request->spesialisasi;
        $dokter->no_telepon     = $request->no_telepon;
        $dokter->save();

        return array(
            'status' => '200',
            'message' => 'update dokter sukses',
            'data' => $dokter
        );

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
        $dokter =  Dokter::where('id_dokter',$id)->first();
        if($dokter->delete()){
            return array(
                'status' => '200',
                'message' => 'delete dokter sukses'
            );
        }else{
            return array(
                'status' => '500',
                'message' => 'delete error'
            );
        }

    }
}
