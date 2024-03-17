
@extends('layouts/main')

@section('content')
<h1>Recettes</h1>

<a href="/"></a>

<!-- feedback pour la supression d'une recette  -->
@if(\Session::has('success'))
<div class="alert alert-danger">
  <h4>{{ \Session::get('success') }}</h4>
</div>
<hr>
@endif

<!-- feedback pour l'ajout d'une recette  -->
@if(\Session::has('successAdd'))
<div class="alert alert-success">
  <h4>{{ \Session::get('successAdd') }}</h4>
</div>
<hr>
@endif




<body>
  <div class="container-lg">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-8"><h2>Liste des <b>Recettes</b></h2></div>
            <!-- Verifie si un user est connecter  -->
            @if(Auth::check())
            <div class="col-sm-4">
              <a type="button" href="{{ route('recettes.create') }}"  class="btn btn-info add-new" ><i class="fa fa-plus"></i> Ajouter une recette</a>
            </div>
            @endif

          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Titre</th>
              <th>Auteur</th>
              <th>Difficulté</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <!-- On parcours pour chaque recette -->
            @foreach ( $recipes as $recipe )
            <tr>
              <td> {{ $recipe->title }} </a> </td>
              <td>{{$recipe->author->name}}</td>
              <td> {{$recipe->status }} </td>
              <td>

                <!-- Bouton des vues détaillées d'une recette  -->
                <a class="show" href="{{ route('recettes.show',$recipe->id) }}" title="Show"><i class="material-icons">remove_red_eye</i></a>


                <!-- Verifie si on est connecter puis si on est administrateur ou si on est simplement le propriétaire de la recette pour avoir les droits sur la recette-->
                @if(Auth::check())
                  @if(Auth::user()->isAdmin() || Auth::user()->id === $recipe->author->id)
                <!-- Bouton de modification d'une recette  -->
                <a class="edit" href="recettes/{{$recipe->id}}/edit " title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                <!-- Bouton de suppresion d'une recette  -->
                <form action="{{ route('recettes.destroy',$recipe->id) }}" method="POST">
                  {{ method_field('DELETE') }}
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">

                  <button type="submit" >
                    <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i> </a>
                  </button>
                </form>
                  @endif
                @endif
              </td>
            </tr>
            @endforeach


          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
@endsection
