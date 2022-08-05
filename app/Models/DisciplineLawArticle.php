<?php

namespace App;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplineLawArticle extends Model
{
  protected $table = 'tb_discipline_article';
  public $primaryKey = 'id';
  public $timestamps = false;
}
