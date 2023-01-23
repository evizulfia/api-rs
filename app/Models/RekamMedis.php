<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;
    protected $table = "rekam_medis";
    protected $primaryKey = 'id_rekam_medis';
    public $timestamps = false;

    protected $appends = ['nama_dokter', 'nama_pasien'];

    public function getNamaDokterAttribute()
    {
        $dokter = Dokter::find($this->id_dokter)->first();
        return $dokter->nama_dokter ?? "";
    }

    public function getNamaPasienAttribute()
    {
        $pasien = Pasien::find($this->id_pasien)->first();
        return $pasien->nama_pasien ?? "";
    }
}
