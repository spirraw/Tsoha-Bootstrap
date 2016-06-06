<?php

class Pokemon extends BaseModel {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
        
        $this->validators = array('nameCheck', 'duplicatePokemonNameCheck');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pokemon');
        $query->execute();

        $pokemon = array();

        foreach ($query->fetchAll() as $row) {
            $pokemon[] = new Pokemon(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }

        return $pokemon;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Pokemon WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            return new Pokemon(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Pokemon (name) VALUES (:name) RETURNING id');

        $query->execute(array('name' => $this->name));

        $row = $query->fetch();

        $this->id = $row['id'];
    }
    
}
