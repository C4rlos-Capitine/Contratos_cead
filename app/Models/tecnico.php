<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tecnico extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tecnico';
    public $incrementing = true;
    protected $keyType = 'int';

}
