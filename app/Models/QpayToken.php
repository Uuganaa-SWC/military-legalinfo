<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QpayToken extends Model
{
    use HasFactory;
    protected $table = 'tb_qpay_token';
    public $timestamps = false;
}
