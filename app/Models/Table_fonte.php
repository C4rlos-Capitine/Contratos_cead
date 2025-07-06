<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_fonte extends Model
{
    use HasFactory;
    protected $table = 'table_fonte';
    protected $primaryKey = 'id_fonte';
    protected $fillable = [
        'nome_fonte',
    ];
}
