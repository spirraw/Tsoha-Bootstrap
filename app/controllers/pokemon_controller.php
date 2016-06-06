<?php

class PokemonController extends BaseController {

    public static function index() {

        $pokemon = Pokemon::all();

        View::make('general/pokemon_list.html', array('pokemons' => $pokemon));
    }

    public static function show($id) {

        $pokemon = Pokemon::find($id);

        View::make('general/pokemon.html', array('pokemon' => $pokemon));
    }

    public static function create() {

        View::make('general/pokemon_add.html');
    }

    public static function store() {

        $params = $_POST;
        
        $name = ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', $params['name'])));

        $attributes = array(
            'name' => $name
        );

        $pokemon = new Pokemon($attributes);
        $errors = $pokemon->errors();
        
        if (count($errors) == 0) {
            $pokemon->save();
            Redirect::to('/pokemon', array('message' => 'Pokemon on lisätty tietokantaan!'));
        } else {
            View::make('general/pokemon_add.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
