<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sarebbe piu corretto metterlo in config
        $categories = [
            ['label' => 'HTML', 'color' => 'danger'],
            ['label' => 'css', 'color' => 'primary'],
            ['label' => 'js', 'color' => 'info'],
            ['label' => 'laravel', 'color' => 'light']
        ];

        foreach($categories as $category) {
            // creo una nuova ISTANZA
            $newCategory = new Category();
            // a ogni ISTANZA creata prendo la proprietà di riferimento e gli abbino il valore

            //newCategory è una class, alla quale sto accedendo alla sua proprietà ( ->label ). Ad essa abbino un valore che è parte del ciclo foreach (array MULTIDIMENSIONALE)
            $newCategory->label = $category['label'];
            $newCategory->color = $category['color'];
            $newCategory->save();
        }
    }
}
