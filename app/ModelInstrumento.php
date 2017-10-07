<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelInstrumento extends Model
{
      protected $table = "minstrumentos";
    protected $primaryKey = "id_inst";
   protected $fillable = [
        'id_inst', 'tip_inst', 'descp_inst' 	];
}
