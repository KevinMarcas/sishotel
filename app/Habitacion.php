<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
  protected $table = 'Habitacion';
  protected $primaryKey = 'Num_Hab';  
  public $timestamps = false;
  protected $fillable = [
      'Descripcion',
      'Estado',
      'Precio',
      'IdTipoHabitacion',
      'IdNivel'
  ];
  protected $guarded = [

  ];

}
