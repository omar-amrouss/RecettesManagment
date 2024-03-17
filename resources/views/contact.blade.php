
@extends('layouts/main')

      @section('content')
      <h1>Contact</h1>
    <!-- feedback succes -->
      @if(\Session::has('success'))
            <div class="alert alert-success">
              <h4>{{ \Session::get('success') }}</h4>
            </div>
            <hr>
      @endif

        <!-- Formulaire de contact -->
      <form action="/contact" method="post">
          @csrf
          <div>
              <label for="name">Nom :</label>
              <input type="text" id="name" name="name" class="@error('title') is-invalid @enderror">
              @if ($errors->first('name'))
                 <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
          </div>
          <div>
              <label for="email">e-mail :</label>
              <input type="email" id="email" name="email">
              @if ($errors->first('email'))
                 <div class="alert alert-danger">{{ $errors->first('email') }}</div>
              @endif
          </div>
          <div>
              <label for="message">Message :</label>
              <textarea class="h-100 d-inline-block" id="message" name="message"></textarea>
              @if ($errors->first('message'))
                  <div class="alert alert-danger">{{ $errors->first('message') }}</div>
              @endif
          </div>
          <div>
              <input class="btn btn-primary mt-3" type="submit" name="envoyer" value="Envoyer">
          </div>
      </form>

      @endsection
