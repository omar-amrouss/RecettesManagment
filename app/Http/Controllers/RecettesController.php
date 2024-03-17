<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Like;
use App\Models\Comment;
use Auth;


use Validator,Redirect,Response,File;
use Intervention\Image\Facades\Image;

class RecettesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $recipes = \App\Models\Recipe::get();

      return view('recipes',array(
          'recipes' => $recipes
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipesAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //validation du formulaire
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'ingredients' => 'required',
            'url' => 'required|max:200',
            'tags' =>'nullable',
            'status' => 'required|max:45',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($files = $request->file('image')) { //Verifie si il y a bien une image
            $destinationPath = public_path('/images'); //chemin d'upload
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension(); //renomme le fichier par la date d'aujourd'hui
            $files->move($destinationPath, $profileImage); //deplace l'image vers le fichier de sauvegarde des images
         }

        $recette = new Recipe($request->all());
        $message = "La recette a bien été ajouter.";
        $recette['image'] = "images/".$profileImage; //Store le chemin vers l'image dans la bd
        $recette['author_id'] = Auth::user()->id; //set l'author_id avec l'id de l'user connecter
        $recette['date']=now();
        $recette->save();

        //renvoie la vue avec un message de feedback
        return redirect(route('recettes.index'))->with('successAdd',$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe, Request $request)
    {

      $idRecipe = $request->segment(3); //recupere l'id
      $recipe = Recipe::where('id',$idRecipe)->first();

      $author = $this->getUserById($recipe->author_id);

      return view('recipesShow')
               ->with('recipe', $recipe)
               ->with('author', $author);
    }

    //Recupere un utilisateur via son id
    public function getUserById($id){
        $user =  \App\Models\User::where('id',$id)->first();
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, Request $request)
    {
        $idRecipe = $request->segment(3);
        $recipe = Recipe::where('id',$idRecipe)->first();
        return view('recipesEdit',array(
            'recipe' => $recipe
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update($idRecipe, Request $request)
    {
        $recipe = Recipe::findOrFail($idRecipe);
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'ingredients' => 'required',
            'url' => 'required|max:200',
            'tags' =>'nullable',
            'status' => 'required|max:45'
        ]);

        $input = $request->all();
        $recipe->fill($input)->save(); //rempli les champs de données
        return redirect(route('recettes.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe, Request $request)
    {
            $idRecipe = $request->segment(3); //recupere l'id
            $recipe = Recipe::where('id',$idRecipe)->first(); //recupere la recette via l'id
            $likes = Like::where('recipe_id', $idRecipe)->get(); //recupere tout les likes d'une recette
            if ($likes) {
                foreach ($likes as $like) {
                    $like->delete(); //supprime chaque like pour une recette
                }
            }
            $comments = Comment::where('recipe_id', $idRecipe)->get(); //recupere les commentaires d'une recette
            if ($comments) {
                foreach ($comments as $comment) {
                    $comment->delete(); //supprime chaque commentaire pour une recette
                }
            }
            $message = "{$recipe->title} a bien été supprimer.";
            $recipe->delete();

            //Return vers la page d'index avec un message de feedback
            return redirect(route('recettes.index'))->with('success',$message);

    }
}
