<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
  protected $table = 'TipoHabitacion';
  protected $primaryKey = 'IdTipoHabitacion';  
  public $timestamps = false;
  protected $fillable = [
      'Denominacion',
      'Descripcion',
  ];
  protected $guarded = [

  ];

}
