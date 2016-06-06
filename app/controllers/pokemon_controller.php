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
        
        $pokemon = new Pokemon(array(
            'name' => $params['name']
        ));

        $pokemon->save();

        Redirect::to('/pokemon', array('message' => 'Pokemon on lisätty tietokantaan!'));
    }

}
