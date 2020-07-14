<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    //
    protected $table = 'clientes';
    protected $fillable = [
		'cliente_id', 'saldo'
    ];
}
