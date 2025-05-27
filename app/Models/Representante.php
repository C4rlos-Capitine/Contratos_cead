<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;
    protected $table = 'representantes';
    protected $primaryKey = 'id_representante';
    protected $fillable = [
        'nome_representante',
        'apelido_representante',
        'genero_representante',
        'id_nivel_contrantante',
    ];
    public $timestamps = true;
}
