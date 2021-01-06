<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  protected $table = 'Categoria';
  protected $primaryKey = 'IdCategoria';  
  public $timestamps = false;
  protected $fillable = [
      'Denominacion',
  ];
  protected $guarded = [

  ];

}
