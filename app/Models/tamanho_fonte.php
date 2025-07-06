<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tamanho_fonte extends Model
{
    use HasFactory;
    protected $table = 'tamanho_fonte';
    protected $primaryKey = 'id_tamanho_fonte';
    protected $fillable = ['tamanho_fonte'];
}
