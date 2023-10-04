<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosNobreak extends Model
{
    use HasFactory;
    protected $table = 'log_event';
    protected $table_equipamentos = 'equipamentos';
    
    // outros atributos e métodos aqui...
}
