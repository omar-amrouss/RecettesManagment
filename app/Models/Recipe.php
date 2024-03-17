<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipes';
    public $timestamps = false;

    public $fillable = ['title', 'content', 'ingredients', 'url', 'tags', 'status','image'];


    use HasFactory;

    /**
   * Get the user that authored the recipe.
   */
    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

        /**
     * Get the comments for the blog recipe.
     */
    public function comments() {
        return $this->hasMany(Comment::class);
      }

              /**
     * Get the likes for the blog recipe.
     */
      public function likes()
      {
          return $this->hasMany(Like::class);
      }

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Recipe::factory()
                ->count(1)
                ->create();
    }


    // $recipe = \App\Models\Recipe::find(1); //trouver la recette avec l’id 1
    // echo $recipe->author->name; //affiche le nom de l’auteur
    // $recipes = \App\Models\User::find(1)->recipes; //get recipes from user id 1
    // foreach ($recipes as $recipe) {
    //    //loop on recipes
    // }

}
