<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     function index() {
         $recipes = \App\Models\Recipe::orderBy('id', 'desc')->take(3)->get();

         return view('welcome',array(
             'recipes' => $recipes
         ));
     }
}
