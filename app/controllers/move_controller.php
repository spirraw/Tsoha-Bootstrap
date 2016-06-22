<?php

class MoveController extends BaseController {

    public static function index() {
        View::make('move/move_list.html', array('moves' => Move::all()));
    }

    public static function show($id) {
        View::make('move/move.html', array('move' => Move::find($id)));
    }

    public static function create() {
        self::check_logged_in();

        View::make('move/move_add.html');
    }

    public static function store() {
        self::check_logged_in();

        $attributes = array(
            'name' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'name')))),
            'mtype' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'mtype')))),
            'mcat' => filter_input(INPUT_POST, 'mcat'),
            'pp' => filter_input(INPUT_POST, 'pp'),
            'power' => filter_input(INPUT_POST, 'power'),
            'accuracy' => filter_input(INPUT_POST, 'accuracy'),
            'description' => filter_input(INPUT_POST, 'description')
        );

        $move = new Move($attributes);
        $errors = $move->errors(false);

        if (count($errors) > 0) {
            View::make('move/move_add.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $move->save();
            Redirect::to('/move', array('message' => 'Siirto on lisätty tietokantaan!'));
        }
    }

    public static function edit($id) {
        self::check_logged_in();

        View::make('move/move_edit.html', array('attributes' => Move::find($id)));
    }

    public static function update($id) {
        self::check_logged_in();

        $attributes = array(
            'id' => $id,
            'name' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'name')))),
            'mtype' => ucwords(strtolower(preg_replace("/[^A-Za-z ]/", '', filter_input(INPUT_POST, 'mtype')))),
            'mcat' => filter_input(INPUT_POST, 'mcat'),
            'pp' => filter_input(INPUT_POST, 'pp'),
            'power' => filter_input(INPUT_POST, 'power'),
            'accuracy' => filter_input(INPUT_POST, 'accuracy'),
            'description' => filter_input(INPUT_POST, 'description')
        );

        $move = new Move($attributes);
        $errors = $move->errors(true);

        if (count($errors) > 0) {
            View::make('move/move_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $move->update();
            Redirect::to('/move', array('message' => 'Siirtoa on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();

        $move = new Move(array('id' => $id));
        OwnMove::RemoveMove($id);
        $move->destroy();
        Redirect::to('/move', array('message' => 'Siirto on poistettu onnistuneesti!'));
    }

}
