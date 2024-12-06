<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentanteController extends Controller
{
    public function register_form(){
        return view('representante.reg_form');
    }
}
