<?php

class UtilController extends BaseController {

    public static function index() {
        Redirect::to('/login');
    }

    public static function login() {
        View::make('util/login.html');
    }

    public static function handle_login() {
        $params = filter_input_array(INPUT_POST);
        $user = User::authenticate($params['username'], $params['password']);
        if (!$user) {
            View::make('util/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/owned', array('message' => 'Tervetuloa ' . $user->name . '!'));
        }
    }

    public static function logout() {
        self::check_logged_in();
        
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

}
