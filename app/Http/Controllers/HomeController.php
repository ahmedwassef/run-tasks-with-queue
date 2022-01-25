<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public  function  index(Request $request){
        dd(3);
        return Inertia::render('Auth/Login', [
            'canResetPassword' =>'false',
            'status' => session('status'),
        ]);
    }

}
