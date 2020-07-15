<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    //
    protected $table = 'contas';
    protected $fillable = [
		'cliente_id', 'saldo'
    ];
}
