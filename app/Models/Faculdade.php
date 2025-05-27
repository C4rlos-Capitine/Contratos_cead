<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculdade extends Model
{
    use HasFactory;

    protected $table = 'faculdades';

    protected $fillable = [
        'nome_faculdade',
        'sigla_faculdade',
    ];

    protected $primaryKey = 'id_faculdade'; // Corrected property name

    public $timestamps = false; // Corrected syntax for disabling timestamps
}