<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigo_disciplina';
    public $incrementing = false; // <- Adicione isto!
    protected $keyType = 'string'; 
}
