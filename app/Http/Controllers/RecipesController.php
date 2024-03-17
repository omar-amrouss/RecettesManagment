<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Like;
use Auth;


class RecipesController extends Controller
{
  function index(Request $request) {


      if($titleRecipe = $request->segment(2) != null){
        $recipe = \App\Models\Recipe::where('title',$titleRecipe)->first(); //recupere une recette en fonction de son titre
        $recipe = $this.show($recipe);

    }else{
      return view('recipes');
    }
  }

  public function show($recipe) {
   $author = $this->getUserById($recipe->author_id);
   return view('recipesShow')
            ->with('recipe', $recipe)
            ->with('author', $author);
  }

  // Save Comment
  function save_comment(Request $request){
      if ($request->comment) {
        $data=new \App\Models\Comment;
        $data->recipe_id=$request->segment(3);
        $data->author_id = Auth::user()->id  ;
        $data->content=$request->comment;
        $data->date= date("Y-m-d H:i:s");
        $data->save();
        return response()->json([
            'bool'=>true
        ]);   
       }
       return response()->json([
           'bool'=>false
       ]);

  }

  // Delete Comment
  function delete_comment(Request $request){
    $id_com = $request->segment(4);
    $commentaire = \App\Models\Comment::where('id', $id_com)->first();
    if ($commentaire) {
        $commentaire->delete();
    }
    return back();
   }




  public function like(Request $request)
  {
    $recipe = \App\Models\Recipe::where('id',$request->segment(3))->first(); //recupere une recette en fonction de son id
    $value = $recipe->like;
    $likeExistant = \App\Models\Like::where('author_id', Auth::user()->id)
        ->where('recipe_id', $recipe->id)->first();
    //verif si utilisateur a deja like la recette
    if ($likeExistant) {
        $likeExistant->delete();
        $recipe->like = $value-1;                  
                           
    } else {
        $like = new \App\Models\Like;
        $like->recipe_id = $recipe->id;
        $like->author_id = Auth::user()->id;
        $like->save();
    
        $value = $recipe->like;
        $recipe->like = $value+1;
    }
    $recipe->save();
      return back();
  }    



  // Recupere l'objet utilisateur via son id
  public function getUserById($id){
      $user =  \App\Models\User::where('id',$id)->first();
      return $user;
  }

}
