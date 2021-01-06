<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
  protected $table = 'TipoCliente';
  protected $primaryKey = 'IdTipoCliente';  
  public $timestamps = false;
  protected $fillable = [
      'Denominacion',
  ];
  protected $guarded = [

  ];

}
