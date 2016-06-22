<?php

class OwnMove extends BaseModel {

    static function GetMoves($id) {
        $query = DB::connection()->prepare('SELECT * FROM OwnMove WHERE pokemon_id = :pokemon_id');
        $query->execute(array('pokemon_id' => $id));

        $moves = array();

        foreach ($query->fetchAll() as $row) {
            $moves[] = Move::find($row['move_id']);
        }

        return $moves;
    }

    static function Add($pokemon_id, $move_id) {
        $query = DB::connection()->prepare('INSERT INTO OwnMove (pokemon_id, move_id) VALUES (:pokemon_id, :move_id) RETURNING id');
        $query->execute(array('pokemon_id' => $pokemon_id, 'move_id' => $move_id));
    }

    static function RemovePokemon($pokemon_id) {
        $query = DB::connection()->prepare('DELETE FROM OwnMove WHERE pokemon_id = :pokemon_id');
        $query->execute(array('pokemon_id' => $pokemon_id));
    }

    static function RemoveMove($move_id) {
        $query = DB::connection()->prepare('DELETE FROM OwnMove WHERE move_id = :move_id');
        $query->execute(array('move_id' => $move_id));
    }

}
