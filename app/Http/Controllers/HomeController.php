<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artigo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $artigos = Artigo::paginate(10);



        return view('home', ['artigos' => $artigos]);
    }
}
