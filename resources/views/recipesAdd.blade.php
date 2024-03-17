@extends('layouts/main')

@section('content')

<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Ajouter une recette</h2>
    </div>
  </div>
</div>
<!-- Affichage des possibles erreurs -->
@if ($errors->any())
<div class="alert alert-danger">
  <strong>Whoops!</strong> Il y a quelques erreurs dans vos entrées.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<!-- Formulaire d'ajout -->
<form action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data" accept-charset="utf-8" class="uploader">
  @csrf

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Titre:</strong>
        <input type="text" name="title" class="form-control" placeholder="Titre">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Explications:</strong>
        <textarea class="form-control" style="height:50px" name="content"
        placeholder="Explications"></textarea>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Ingredients:</strong>
        <input type="text" name="ingredients" class="form-control" placeholder="Ingredients">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>URL:</strong>
        <input type="text" name="url" class="form-control" placeholder="URL">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Tags:</strong>
        <input type="text" name="tags" class="form-control" placeholder="Tags">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Difficulté:</strong>
        <input type="text" name="status" class="form-control" placeholder="Difficulté">
      </div>
    </div>

    <!-- Upload image -->
    <form id="file-upload-form">
      @csrf
      <input id="file-upload" type="file" name="image" accept="image/*" onchange="readURL(this);">
      <label for="file-upload" id="file-drag">
        <img id="file-image" src="#" alt="Preview" class="hidden">
        <div id="start" >
          <i class="fa fa-download" aria-hidden="true"></i>
          <div>Choisissez un fichier ou déplacer le içi</div>
          <div id="notimage" class="hidden">Choisissez une image</div>
          <span id="file-upload-btn" class="btn btn-primary">Choisissez un fichier</span>
          <br>
          <span class="text-danger">{{ $errors->first('fileUpload') }}</span>
        </div>
      </label>
    </form>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</div>
<script>
// Script pour l'ajout des images
function readURL(input, id) {
  id = id || '#file-image';
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(id).attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
    $('#file-image').removeClass('hidden');
    $('#start').hide();
  }
}
</script>

@endsection
