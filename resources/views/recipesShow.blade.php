@extends('layouts/main')
@push('fontawesome')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')

<div id="app">

<div class="container-fluid">

    <div class="column">
        <h1 class="text-center">{{$recipe->tags}} : {{$recipe->title}} </h1>
        <h1 class="text-center"> Auteur : {{$author->name}} </h1>

        <div class="column text-center">
            <img class="img-thumbnail" style="max-width:50%" src="{{ asset("$recipe->image")}}" alt="{{$recipe->title}}">
        </div>

        <div class="card">
            <div class = "card-header"> 
                <h5 > Description :  
                    @if(Auth::check()) <!-- Si connecté => lien, sinon simple text -->
                        <a class="float-right" href="/admin/recettes/{{$recipe->id}}/like">{{$recipe->like}} like</a>
                    @else
                      <p class="float-right">{{$recipe->like}} like </p>
                    @endif
                </h5>
            </div>

            <div class="card-body">
                <ul>

                    <li>{{ $recipe->content }}</li>


                </ul>
            </div>
        </div>
        

        <div class="card">
            <div class = "card-header"> 
                <h5 > Ingrédients :  </h5>
            </div>

            <div class="card-body">
                <ul>

                    <li>{{ $recipe->ingredients }}</li>


                </ul>
            </div>
        </div>



        <div class="column">
            {{-- Recipe Comments --}}
            <div class="card mt-4">
                <h5 class="card-header">Commentaires :  <span class="comment-count float-right badge badge-info">{{ count($recipe->comments) }}</span></h5>
                <div class="card-body">
                    {{-- Add Comment --}}
                    <!-- Si pas connecté, pas d'ajout de commentaire possible -->
                    @if(Auth::check())
                    <div class="add-comment mb-3">
                        @csrf
                        <textarea class="form-control comment" placeholder="Saisissez un commentaire"></textarea>
                        <button data-recipe="{{ $recipe->id }}" class="btn btn-dark btn-sm mt-2 save-comment">Envoyer</button>
                    </div>
                    @endif
                    <hr />
                    {{-- List Start --}}
                    <div class="comments">
                    <!-- On affiche les commentaires existants -->
                        @if(count($recipe->comments)>0)
                        <!-- Si la recette appartient a l'utilisateur connecté, il peut supprimer les commentaires -->
                            @if(Auth::check() and Auth::user()->id == $recipe->author_id)
                            <!-- Boucle sur les commentaires de la recette -->
                                @foreach($recipe->comments as $comment)
                                <div class="shadow p-4 mb-4 bg-white "> 
                                    <h5> {{ $comment->author->name }}  <a class="float-right" href="/admin/recettes/{{$recipe->id}}/{{$comment->id}}">Supprimer</a> </h5>   
                                                                
                                <blockquote class="blockquote">
                                    <small class="mb-0">{{ $comment->content }}</small>
                                </blockquote>
                                <p> Le : {{ $comment->date }}</p>                                  
                                </div>

                                @endforeach
                            @else
                                 @foreach($recipe->comments as $comment)
                                 <!-- Boucle sur les commentaires de la recette -->
                                 <div class="shadow p-4 mb-4 bg-white "> 
                                <h5> {{ $comment->author->name }} </h5>
                                <blockquote class="blockquote">
                                    <small class="mb-0">{{ $comment->content }}</small>
                                </blockquote>
                                <p> Le : {{ $comment->date }}</p>

                                </div>

                                @endforeach
                            @endif
                        @else
                            <p class="no-comments">Cette recette ne dispose pas encore de commentaire.</p>
                        @endif
                    </div>
                </div>
            </div>
            {{-- ## End recipe Comments --}}
        </div>
    </div>
</div>

    <script type="text/javascript">
        // Save Comment
        $(".save-comment").on('click', function() {
            var _comment = $(".comment").val();
            var _post = $(this).data('post');
            var vm = $(this);
            // Run Ajax
            $.ajax({
                url: " /admin/recettes/{{$recipe->id}}", //routage vers fonction save_comment du controlleur
                type: "post",
                dataType: 'json',
                data: {
                    comment: _comment,
                    post: _post,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    vm.text('Envoi...').addClass('disabled');
                },
                success: function(res) { //si le commentaire est bien créé
                    var _html = '<blockquote class="blockquote animate__animated animate__bounce">\
            <small class="mb-0">' + _comment + '</small>\
            </blockquote><hr/>';
                    if (res.bool == true) {
                        $(".comments").prepend(_html);
                        $(".comment").val('');
                        $(".comment-count").text($('blockquote').length);
                        $(".no-comments").hide();
                    } else { //si l'utilisateur essaie d'envoyer un commentaire vide
                        alert("Veuillez saisir un commentaire avant d'envoyer.")
                    }
                    vm.text('Envoyer').removeClass('disabled');
                }
            });
        });
    </script>

    @endsection