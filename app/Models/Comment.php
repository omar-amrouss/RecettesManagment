<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public $timestamps = false;

    public $fillable = ['author_id', 'recipe_id', 'content'];

    use HasFactory;

        /**
   * Get the user that authored the recipe.
   */
  public function author()
  {
      return $this->belongsTo(User::class,'author_id');
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

}
