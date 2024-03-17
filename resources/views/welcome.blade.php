
@extends('layouts/main')

      @section('content')
      <h1>Home</h1>
      <ul>
      <!-- Affichage des trois dernières recettes -->
      @foreach ( $recipes as $recipe )
        <li> <a href="/admin/recettes/{{ $recipe->id }} ">{{ $recipe->title }}</a> </li>

      @endforeach
      </ul>



      @endsection
