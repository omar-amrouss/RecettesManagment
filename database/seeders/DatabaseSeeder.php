<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\Like;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
    // Cree un administrateur par défaut
    User::create([
      'name' => 'admin',
      'email' => 'admin@admin.com',
      'email_verified_at' => now(),
      'password' => bcrypt('adminadmin'),
      'remember_token' => Str::random(10),
      'is_admin'=>1,
    ]);

        // Cree 5 faux users
        User::factory(5)->create();


    // Creation des recettes, likes et commentaires associés

    Recipe::create([
      'author_id' => 2,
      'title' => 'Poulet Basquaise',
      'content' => 'Le poulet basquaise ou poulet à la basquaise est une spécialité culinaire de cuisine traditionnelle emblématique de la cuisine basque, étendue avec le temps à la cuisine française.',
      'ingredients' => 'poulets mijotés, sauce confite de poivrons rouge et vert, tomates, oignons, ail, vin blanc, bouquet garni, piment, huile.',
      'url' => 'https://fr.wikipedia.org/wiki/Poulet_basquaise',
      'tags' => 'Plat de résistance',
      'date' => now(),
      'status' => 'Facile',
      'image'=>'images/20210412145456.jpg',
      'like' => 2
    ]);

    Recipe::create([
      'author_id' => 3,
      'title' => 'Lasagnes à la bolognaise',
      'content' => 'L\'astuce Veggie Cool de GoodPlanet : la bolognaise est parfaite pour découvrir les légumineuses. Enrobées de sauce tomate, les lentilles se transforment en une sauce fondante et végétarienne !',
      'ingredients' => 'Parmesan, muscade râpée, basilic, thym, vin rouge, eau, purée de tomate, carotte, célerie, ail, lasagnes, oignons jaunes, boeuf haché, feuilles de laurier, fromage râpé',
      'url' => 'https://fr.wikipedia.org/wiki/Lasagnes',
      'tags' => 'Plat de résistance',
      'date' => now(),
      'status' => 'Moyen',
      'image'=>'images\shutterstock_142426168-800x600.jpg',
      'like' => 1
    ]);


    Recipe::create([
      'author_id' => 4,
      'title' => 'Tiramisu',
      'content' => 'Il existe de nombreuses recettes de tiramisu. Celle-ci est la recette originale (ou en tous les cas, l\'une des recettes pouvant prétendre l\'être!). NB: il y a bien de l\'alcool dans le tiramisu mais il s\'agit de Marsala sec (ni aux oeufs, ni à l\'amande) mélangé au café très fort. ',
      'ingredients' => 'Biscuits à la cuillère, sucre vanillé, sucre roux, oeufs, mascarpone, café noir, cacao amer',
      'url' => 'https://fr.wikipedia.org/wiki/Tiramisu',
      'tags' => 'Dessert',
      'date' => now(),
      'status' => 'Très facile',
      'image'=>'images\mon-tiramisu.jpg',
      'like' => 1
    ]);


    Recipe::create([
      'author_id' => 5,
      'title' => 'Salade César',
      'content' => 'Servir en accompagnement d\'une quiche ou d\'une tourte. Excellent repas du soir. Vous pouvez utiliser des croûtons déjà prêts. La sauce peut être préparée 6 heures à l\'avance et réservée au frais.',
      'ingredients' => 'Huile, parmesan, laitue efeuillé, pain écoûtées, ail pelée, citron, tabasco, moutarde, câpres, oeuf',
      'url' => 'https://fr.wikipedia.org/wiki/Salade_C%C3%A9sar',
      'tags' => 'Entrée',
      'date' => now(),
      'status' => 'Très facile',
      'image'=>'images\i135580-salade-cesar-allegee.jpeg',
      'like' => 0
    ]);

    Recipe::create([
      'author_id' => 5,
      'title' => 'Mojito cubain',
      'content' => 'La réussite du mojito dépend en grande partie du rhum que vous utilisez, donc ne prenez pas un rhum trop fort qui masquerait le goût des autres ingrédients. Les rhums cités en ingrédients se marient parfaitement avec ce cocktail.',
      'ingredients' => 'Rhum cubain, sucre de canne en poudre, citron vert, menthe bien fournie, eau gazeuse, glaçons',
      'url' => 'https://fr.wikipedia.org/wiki/Mojito',
      'tags' => 'Boisson',
      'date' => now(),
      'status' => 'Facile',
      'image'=>'images\mojito.jpg',
      'like' => 1
    ]);

    Comment::create([
      'author_id' => 5,
      'recipe_id' => 1,
      'content' => 'Très bonne recette, facile à réaliser',
      'date' =>now(),
    ]);

    Comment::create([
      'author_id' => 4,
      'recipe_id' => 2,
      'content' => 'Parfait pour les repas avec beaucoup de convives !',
      'date' =>now(),
    ]);

    Comment::create([
      'author_id' => 3,
      'recipe_id' => 5,
      'content' => 'Rafraichissant et rapide a faire, top !',
      'date' =>now(),
    ]);

    Comment::create([
      'author_id' => 2,
      'recipe_id' => 3,
      'content' => 'Je ne suis pas très affriolant des Tiramisu mais cette image si auréoler devrait intéresser mes congénéres.',
      'date' =>now(),
    ]);

    Like::create([
      'author_id' => 3,
      'recipe_id' => 5,
    ]);

    Like::create([
      'author_id' => 3,
      'recipe_id' => 3,
    ]);

    Like::create([
      'author_id' => 3,
      'recipe_id' => 1,
    ]);

    Like::create([
      'author_id' => 4,
      'recipe_id' => 2,
    ]);

    Like::create([
      'author_id' => 5,
      'recipe_id' => 1,
    ]);
  }
}
