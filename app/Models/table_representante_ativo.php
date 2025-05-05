<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table_representante_ativo extends Model
{
    use HasFactory;
    protected $table = 'table_representante_ativo';
    protected $primaryKey = 'id_representante_ativo';
}
