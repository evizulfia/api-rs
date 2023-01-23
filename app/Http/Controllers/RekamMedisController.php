<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $rekammedis = RekamMedis::all();
        return $rekammedis;
    }
    
    public function search(Request $request)
    {
        //
        $rekam_medis = RekamMedis::where('id_dokter', 'like', '%'.$request->search.'%')
                        ->orWhere('id_rekam_medis', 'like', '%'.$request->search.'%')
                        ->orWhere('diagnosa', 'like', '%'.$request->search.'%')
                        ->orWhere('tindakan', 'like', '%'.$request->search.'%')
                        ->orWhere('tanggal_periksa', 'like', '%'.$request->search.'%')
                        ->get();

        return $rekam_medis;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rekam_medis = $request->id_rekam_medis;

        $rekam_medis = RekamMedis::where('id_rekam_medis', $id_rekam_medis)->first();

        $dokter = Dokter::where('id_dokter', $request->id_dokter)->first();
        $pasien = Pasien::where('id_dokter', $request->id_dokter)->first();

        if(!$dokter){
            return array(
                'status' => '400',
                'message' => 'Error, id dokter tidak ditemukan'
            );
        }
        if(!$pasien){
            return array(
                'status' => '400',
                'message' => 'Error, id pasien tidak ditemukan'
            );
        }

        if($rekam_medis){
            $rekam_medis->id_dokter         = $request->id_dokter;
            $rekam_medis->id_rekam_medis         = $request->id_rekam_medis;
            $rekam_medis->tanggal_periksa   = date('Y-m-d',strtotime($request->tanggal_periksa));
            $rekam_medis->diagnosa          = $request->diagnosa;
            $rekam_medis->tindakan          = $request->tindakan;
            $rekam_medis->save();
    
            
            return array(
                'status' => '200',
                'message' => 'update rekam_medis sukses',
                'data' => $rekam_medis
            );

        }else{
            $rekam_medis = new RekamMedis();
            $rekam_medis->id_rekam_medis      = $request->id_rekam_medis;
            $rekam_medis->id_dokter         = $request->id_dokter;
            $rekam_medis->id_rekam_medis         = $request->id_rekam_medis;
            $rekam_medis->tanggal_periksa   = date('Y-m-d',strtotime($request->tanggal_periksa));
            $rekam_medis->diagnosa          = $request->diagnosa;
            $rekam_medis->tindakan          = $request->tindakan;
            $rekam_medis->save();
    
            
            return array(
                'status' => '200',
                'message' => 'insert rekam_medis sukses',
                'data' => $rekam_medis
            );

        }
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
        $rekam_medis =  RekamMedis::where('id_rekam_medis',$id)->first();
        if($rekam_medis->delete()){
            return array(
                'status' => '200',
                'message' => 'delete rekam_medis sukses'
            );
        }else{
            return array(
                'status' => '500',
                'message' => 'delete error'
            );
        }
    }
}
