<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function A (){
        return view('connexion');
    }


    public function B (){
        return view('inscription');
    }

        public function C (){
        return view('administrateur');
    }

    public function D (){
        return view('agent');
    }

    public function E (){
        return view('depot');
    }

    public function F (){
        return view('client');
    }
    public function G (){
        return view('ajout-contact');
    }

    public function H (){
        return view('contact');
    }

    //
}
