<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::all();
        return $transaction;
    }
    
    public function search(Request $request)
    {
        //
        $transaction = Transaction::where('id_transaction', 'like', '%'.$request->search.'%')
                        ->orWhere('id_pasien', 'like', '%'.$request->search.'%')
                        ->orWhere('nama_pasien', 'like', '%'.$request->search.'%')
                        ->orWhere('invoice', 'like', '%'.$request->search.'%')
                        ->orWhere('harga', 'like', '%'.$request->search.'%')
                        ->orWhere('diskon', 'like', '%'.$request->search.'%')
                        ->orWhere('total', 'like', '%'.$request->search.'%')
                        ->orWhere('status', 'like', '%'.$request->search.'%')
                        ->orWhere('tanggal_transaksi', 'like', '%'.$request->search.'%')
                        ->get();

        return $transaction;
    }

    public function search_byid(Request $request)
    {
        //
        $transaction = Transaction::where('id_transaction', '=', $request->search)
                        ->get();

        return $transaction;
    }

    public function search_bynama(Request $request)
    {
        //
        $transaction = Transaction::where('nama_pasien', 'like', '%'.$request->search.'%')
                        ->get();

        return $transaction;
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
        $pasien = Pasien::where('id_pasien', $request->id_pasien)->first();

        if(!$pasien){
            return array(
                'status' => '400',
                'message' => 'Error, id pasien tidak ditemukan'
            );
        }

        DB::beginTransaction();
       
            $transaction = new Transaction();
            $transaction->id_transaction   = $request->id_transaction;
            $transaction->id_pasien   = $request->id_pasien;

            $obat = Obat::where('id_obat', $request->id_obat)->first();
            if($obat){
                $transaction->id_obat   = $request->id_obat;
            }

            $transaction->nama_pasien   = $pasien->nama_pasien;
            $transaction->tanggal_transaksi       = date('Y-m-d',strtotime($request->tanggal_transaksi));
            $transaction->harga       = $request->harga;
            $transaction->diskon      = $request->diskon;
            $transaction->total       = $request->total;
            $transaction->status       = $request->status;
            $transaction->save();
            
            $transaction->invoice              = 'INV.'.date('dmY').'.'.$transaction->id_transaction;
            $transaction->save();


            DB::commit();
                return array(
                    'status' => '200',
                    'message' => 'insert transaction sukses',
                    'data' => $transaction
                );

            try {
                //code...

                 DB::beginTransaction();

                if($request->item){
                    foreach(json_decode($request->item) as $row){
                        $item = new TransactionDetail();

                        $item->id_transaction = $transaction->id_transaction;
                        $item->id_obat  = $row->id_obat;
                        $item->qty      = $row->qty;

                        $obat = Obat::where('id_obat', $row->id_obat)->first();
                        if(!$obat){
                            return array(
                                'status' => '400',
                                'message' => 'Error, id obat tidak ditemukan'
                            );
                        }else{
                            $item->harga = $obat->harga;
                            $item->nama_obat = $obat->nama_obat;
                            $item->total    = $obat->harga*$row->qty;
                        }

                        $item->save();
                    }
                }

                DB::commit();
                return array(
                    'status' => '200',
                    'message' => 'insert transaction sukses',
                    'data' => $transaction
                );
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollback();
                return array(
                    'status' => '500',
                    'message' => 'insert transaction failed'
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
    }
}
