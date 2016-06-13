<?php

class OwnedController extends BaseController {

    public static function index() {
        View::make('own/owned_pokemon_list.html', array('owned' => Owned::all()));
    }

    public static function show($id) {
        View::make('own/owned_pokemon.html', array('owned' => Owned::find($id)));
    }

    public static function create($id) {
        $pokemon = Pokemon::find($id);
        $attributes = array(
        'pokemon_id' => $id,
        'name' => $pokemon->name,
        'ptype' => $pokemon->ptype,
        'ohp' => $pokemon->bhp,
        'oattack' => $pokemon->battack,
        'odefense' => $pokemon->bdefense,
        'ospattack' => $pokemon->bspattack,
        'ospdefense' => $pokemon->bspdefense,
        'ospeed' => $pokemon->bspeed,
        );
        
        View::make('own/owned_add.html', array('attributes' => $attributes));
    }

    public static function store($id) {
        $pokemon = Pokemon::find($id);
        $attributes = array(
            'pokemon_id' => $id,
            'player_id' => BaseController::get_user_logged_in()->id,
            'name' => $pokemon->name,
            'nickname' => strlen(filter_input(INPUT_POST, 'nickname')) > 0 ? filter_input(INPUT_POST, 'nickname') : null,
            'added' => date('Y-m-d'),
            'ptype' => $pokemon->ptype,
            'ohp' => filter_input(INPUT_POST, 'ohp'),
            'oattack' => filter_input(INPUT_POST, 'oattack'),
            'odefense' => filter_input(INPUT_POST, 'odefense'),
            'ospattack' => filter_input(INPUT_POST, 'ospattack'),
            'ospdefense' => filter_input(INPUT_POST, 'ospdefense'),
            'ospeed' => filter_input(INPUT_POST, 'ospeed'),
            'description' => $pokemon->description
        );

        $owned = new Owned($attributes);
        $errors = $owned->errors();

        if (count($errors) > 0) {
            View::make('own/owned_add.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $owned->save();
            Redirect::to('/owned', array('message' => 'Pokemon on lisätty kokoelmaasi!'));
        }
    }

    public static function edit($id) {
        View::make('own/owned_pokemon_edit.html', array('attributes' => Owned::find($id)));
    }

    public static function update($id) {
        $pokemon = Owned::find($id);
        
        $attributes = array(
            'id' => $id,
            'pokemon_id' => $pokemon->pokemon_id,
            'player_id' => $pokemon->player_id,
            'name' => $pokemon->name,
            'nickname' => strlen(filter_input(INPUT_POST, 'nickname')) > 0 ? filter_input(INPUT_POST, 'nickname') : null,
            'added' => $pokemon->added,
            'ptype' => $pokemon->ptype,
            'ohp' => filter_input(INPUT_POST, 'ohp'),
            'oattack' => filter_input(INPUT_POST, 'oattack'),
            'odefense' => filter_input(INPUT_POST, 'odefense'),
            'ospattack' => filter_input(INPUT_POST, 'ospattack'),
            'ospdefense' => filter_input(INPUT_POST, 'ospdefense'),
            'ospeed' => filter_input(INPUT_POST, 'ospeed'),
            'description' => $pokemon->description
        );

        $owned = new Owned($attributes);
        $errors = $owned->errors();

        if (count($errors) > 0) {
            View::make('own/owned_pokemon_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $owned->update();
            Redirect::to('/owned', array('message' => 'Pokemonia on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        $owned = new Owned(array('id' => $id));
        $owned->destroy();
        Redirect::to('/owned', array('message' => 'Pokemon on poistettu onnistuneesti!'));
    }

}
