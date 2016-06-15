<?php

class OwnedController extends BaseController {

    public static function index() {
        self::check_logged_in();
        
        View::make('own/owned_pokemon_list.html', array('owned' => Owned::all()));
    }

    public static function show($id) {
        self::check_logged_in();
        
        View::make('own/owned_pokemon.html', array('owned' => Owned::find($id)));
    }

    public static function create($id) {
        self::check_logged_in();
        
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
        self::check_logged_in();
        
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
        self::check_logged_in();
        
        View::make('own/owned_pokemon_edit.html', array('attributes' => Owned::find($id)));
    }

    public static function update($id) {
        self::check_logged_in();
        
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
        self::check_logged_in();
        
        $owned = new Owned(array('id' => $id));
        $owned->destroy();
        Redirect::to('/owned', array('message' => 'Pokemon on poistettu onnistuneesti!'));
    }

}
