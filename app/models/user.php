<?php

class User extends BaseModel {

    public $id, $name;

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return new User(array('id' => $row['id'], 'name' => $row['name']));
        } else {
            return null;
        }
    }

    public static function authenticate($uname, $pw) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $uname, 'password' => $pw));
        $row = $query->fetch();
        if ($row) {
            return new User(array('id' => $row['id'], 'name' => $row['name']));
        } else {
            return null;
        }
    }

}
