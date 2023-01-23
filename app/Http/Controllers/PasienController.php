<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pasien = Pasien::all();
        return $pasien;

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
        $id_pasien = $request->id_pasien;

        $pasien = Pasien::where('id_pasien', $id_pasien)->first();

        if($pasien){
            $pasien->nama_pasien    = $request->nama_pasien;
            $pasien->alamat              = $request->alamat;
            $pasien->tanggal_lahir       = $request->tanggal_lahir;
            $pasien->jenis_kelamin       = $request->jenis_kelamin;
            $pasien->no_telepon          = $request->no_telepon;
            $pasien->save();
    
            
            return array(
                'status' => '200',
                'message' => 'update pasien sukses',
                'data' => $pasien
            );

        }else{
            $pasien = new Pasien();
            $pasien->id_pasien      = $request->id_pasien;
            $pasien->nama_pasien    = $request->nama_pasien;
            $pasien->alamat              = $request->alamat;
            $pasien->tanggal_lahir       = $request->tanggal_lahir;
            $pasien->jenis_kelamin       = $request->jenis_kelamin;
            $pasien->no_telepon          = $request->no_telepon;
            $pasien->save();
    
            
            return array(
                'status' => '200',
                'message' => 'insert pasien sukses',
                'data' => $pasien
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
        //
        $pasien =  Pasien::where('id_pasien',$id)->first();
        if($pasien->delete()){
            return array(
                'status' => '200',
                'message' => 'delete pasien sukses'
            );
        }else{
            return array(
                'status' => '500',
                'message' => 'delete error'
            );
        }
    }
}
