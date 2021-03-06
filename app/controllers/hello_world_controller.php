<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        Redirect::to('/login');
    }

    public static function sandbox() {
        Kint::dump(OwnMove::GetMoves(4));
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
