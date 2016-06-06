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

}
