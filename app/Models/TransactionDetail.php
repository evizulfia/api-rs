<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
     protected $table = "transaction_detail";
    protected $primaryKey = 'id_transaction_detail';
    public $timestamps = false;
}
