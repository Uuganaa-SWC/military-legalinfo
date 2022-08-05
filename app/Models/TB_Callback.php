<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TB_Callback extends Model
{
    use HasFactory;
    protected $table = 'tb_my_callbacks';
    public $timestamps = false;
}
