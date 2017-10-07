<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelPnf extends Model
{
    
    protected $fillable = [
        'cod_pnf', 'nom_pnf',	];
        //Estos son la variables que se envian a la Base de Datos, estos mismos tambien son los datos que recibe
        // la migracion
    
}
