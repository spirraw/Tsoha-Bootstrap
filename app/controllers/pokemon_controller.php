<?php

class PokemonController extends BaseController {

    public static function index() {
        View::make('general/pokemon_list.html', array('pokemons' => Pokemon::all()));
    }

    public static function show($id) {
        View::make('general/pokemon.html', array('pokemon' => Pokemon::find($id)));
    }

    public static function create() {
        View::make('general/pokemon_add.html');
    }

    public static function store() {
        $attributes = array(
            'name' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'name')))),
            'evolution_of_id' => strlen(filter_input(INPUT_POST, 'evolution_of_id')) > 0 ? filter_input(INPUT_POST, 'evolution_of_id') : null,
            'ptype' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'ptype')))),
            'bhp' => filter_input(INPUT_POST, 'bhp'),
            'battack' => filter_input(INPUT_POST, 'battack'),
            'bdefense' => filter_input(INPUT_POST, 'bdefense'),
            'bspattack' => filter_input(INPUT_POST, 'bspattack'),
            'bspdefense' => filter_input(INPUT_POST, 'bspdefense'),
            'bspeed' => filter_input(INPUT_POST, 'bspeed'),
            'description' => filter_input(INPUT_POST, 'bdescription')
        );

        $pokemon = new Pokemon($attributes);
        $errors = $pokemon->errors();

        if (count($errors) > 0) {
            View::make('general/pokemon_add.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $pokemon->save();
            Redirect::to('/pokemon', array('message' => 'Pokemon on lisätty tietokantaan!'));
        }
    }

    public static function edit($id) {
        View::make('general/pokemon_edit.html', array('attributes' => Pokemon::find($id)));
    }

    public static function update($id) {
        $attributes = array(
            'id' => $id,
            'name' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'name')))),
            'evolution_of_id' => strlen(filter_input(INPUT_POST, 'evolution_of_id')) > 0 ? filter_input(INPUT_POST, 'evolution_of_id') : null,
            'ptype' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'ptype')))),
            'bhp' => filter_input(INPUT_POST, 'bhp'),
            'battack' => filter_input(INPUT_POST, 'battack'),
            'bdefense' => filter_input(INPUT_POST, 'bdefense'),
            'bspattack' => filter_input(INPUT_POST, 'bspattack'),
            'bspdefense' => filter_input(INPUT_POST, 'bspdefense'),
            'bspeed' => filter_input(INPUT_POST, 'bspeed'),
            'description' => filter_input(INPUT_POST, 'bdescription')
        );

        $pokemon = new Pokemon($attributes);
        $errors = $pokemon->errors();

        if (count($errors) > 0) {
            View::make('general/pokemon_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $pokemon->update();
            Redirect::to('/pokemon', array('message' => 'Pokemonia on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        Pokemon(array('id' => $id))->destroy();
        Redirect::to('/pokemon', array('message' => 'Pokemon on poistettu onnistuneesti!'));
    }
}    