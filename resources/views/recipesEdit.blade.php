@extends('layouts/main')

@section('content')

<a href="{{ route('recettes.index') }}">Retour aux recettes.</a>
<br>
<h1>Modification de {{ $recipe->title }}</h1>
<p class="lead">Modifiez les champs que vous souhaitez et sauvegardez les modifications.</p>
<!-- formulaire de modification -->
{!! Form::model($recipe, [
    'method' => 'PATCH',
    'route' => ['recettes.update', $recipe->id]
]) !!}

<div class="form-group">
    {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Explications:', ['class' => 'control-label']) !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ingredients', 'Ingrédients:', ['class' => 'control-label']) !!}
    {!! Form::text('ingredients', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('url', 'URL:', ['class' => 'control-label']) !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags:', ['class' => 'control-label']) !!}
    {!! Form::text('tags', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Difficulté:', ['class' => 'control-label']) !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Sauvegarder les modifications', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@endsection
