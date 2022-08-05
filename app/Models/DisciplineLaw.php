<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplineLaw extends Model
{
  protected $table = 'tb_discipline_law';
  public $primaryKey = 'id';
  public $timestamps = false;
}
