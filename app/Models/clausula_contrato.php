<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clausula_contrato extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'clausula_contrato';

    // Chave primária da tabela
    protected $primaryKey = 'id_clausula';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'ordem_clausula',
        'titulo_clausula',
        'subtitulo_clausula',
        'descricao_clausula',
    ];
}