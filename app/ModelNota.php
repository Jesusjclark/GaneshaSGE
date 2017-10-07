<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelNota extends Model
{

   protected $table = "mnotas";
   protected $primaryKey = "id_nota";
   protected $fillable = [
        'id_eva_not', 'ci_est', 'nota'];
}
