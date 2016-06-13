<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        Redirect::to('/login');
    }

    public static function sandbox() {
        $pokemon = Owned::find(2);
        
        $attributes = array(
            'pokemon_id' => $pokemon->pokemon_id,
            'player_id' => $pokemon->player_id,
            'name' => $pokemon->name,
            'nickname' => strlen(filter_input(INPUT_POST, 'nickname')) > 0 ? filter_input(INPUT_POST, 'nickname') : null,
            'added' => $pokemon->added,
            'ptype' => $pokemon->ptype,
            'ohp' => filter_input(INPUT_POST, 'ohp'),
            'oattack' => 69,
            'odefense' => filter_input(INPUT_POST, 'odefense'),
            'ospattack' => filter_input(INPUT_POST, 'ospattack'),
            'ospdefense' => filter_input(INPUT_POST, 'ospdefense'),
            'ospeed' => filter_input(INPUT_POST, 'ospeed'),
            'description' => $pokemon->description
        );

        $owned = new Owned($attributes);
        $owned->update();
        Kint::dump($owned->id);
    }

    public static function login() {
        View::make('util/login.html');
    }

    public static function pokemon_list() {
        View::make('general/pokemon_list.html');
    }

    public static function owned_list() {
        View::make('own/owned_pokemon_list.html');
    }

    public static function owned_pokemon() {
        View::make('own/owned_pokemon.html');
    }

    public static function owned_edit() {
        View::make('own/owned_pokemon_edit.html');
    }

}
