<?php

class Owned extends BaseModel {

    public $id, $pokemon_id, $player_id, $name, $nickname, $added, $ptype, $ohp, $oattack, $odefense, $ospattack, $ospdefense, $ospeed, $lvl, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM OwnedPokemon WHERE player_id = :player_id');
        $query->execute(array('player_id' => BaseController::get_user_logged_in()->id));

        $owned = array();

        foreach ($query->fetchAll() as $row) {
            $owned[] = new Owned(array(
                'id' => $row['id'],
                'pokemon_id' => $row['pokemon_id'],
                'player_id' => $row['player_id'],
                'name' => $row['name'],
                'nickname' => $row['nickname'],
                'added' => $row['added'],
                'ptype' => $row['ptype'],
                'ohp' => $row['ohp'],
                'oattack' => $row['oattack'],
                'odefense' => $row['odefense'],
                'ospattack' => $row['ospattack'],
                'ospdefense' => $row['ospdefense'],
                'ospeed' => $row['ospeed'],
                'lvl' => $row['lvl'],
                'description' => $row['description']
            ));
        }

        return $owned;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM OwnedPokemon WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            return new Owned(array(
                'id' => $row['id'],
                'pokemon_id' => $row['pokemon_id'],
                'player_id' => $row['player_id'],
                'name' => $row['name'],
                'nickname' => $row['nickname'],
                'added' => $row['added'],
                'ptype' => $row['ptype'],
                'ohp' => $row['ohp'],
                'oattack' => $row['oattack'],
                'odefense' => $row['odefense'],
                'ospattack' => $row['ospattack'],
                'ospdefense' => $row['ospdefense'],
                'ospeed' => $row['ospeed'],
                'lvl' => $row['lvl'],
                'description' => $row['description']
            ));
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO OwnedPokemon (pokemon_id, player_id, name, nickname, added, ptype, ohp, oattack, odefense, ospattack, ospdefense, ospeed, lvl, description) VALUES (:pokemon_id, :player_id, :name, :nickname, :added, :ptype, :ohp, :oattack, :odefense, :ospattack, :ospdefense, :ospeed, :lvl, :description) RETURNING id');

        $query->execute(array('pokemon_id' => $this->pokemon_id, 'player_id' => $this->player_id, 'name' => $this->name, 'nickname' => $this->nickname, 'added' => $this->added, 'ptype' => $this->ptype, 'ohp' => $this->ohp, 'oattack' => $this->oattack, 'odefense' => $this->odefense, 'ospattack' => $this->ospattack, 'ospdefense' => $this->ospdefense, 'ospeed' => $this->ospeed, 'lvl' => $this->lvl, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
        
        return $this->id;
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE OwnedPokemon SET (pokemon_id, player_id, name, nickname, added, ptype, ohp, oattack, odefense, ospattack, ospdefense, ospeed, lvl, description) = (:pokemon_id, :player_id, :name, :nickname, :added, :ptype, :ohp, :oattack, :odefense, :ospattack, :ospdefense, :ospeed, :lvl, :description) WHERE id = :id RETURNING id');
        
        $query->execute(array('pokemon_id' => $this->pokemon_id, 'player_id' => $this->player_id, 'name' => $this->name, 'nickname' => $this->nickname, 'added' => $this->added, 'ptype' => $this->ptype, 'ohp' => $this->ohp, 'oattack' => $this->oattack, 'odefense' => $this->odefense, 'ospattack' => $this->ospattack, 'ospdefense' => $this->ospdefense, 'ospeed' => $this->ospeed, 'lvl' => $this->lvl, 'description' => $this->description, 'id' => $this->id));
    
        return $query->fetch();
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM OwnedPokemon WHERE id = :id');       
        $query->execute(array('id' => $this->id));
    }
    
    public function errors() {
        $errors = array();
        $errors = array_merge($errors, parent::valCheck('HP', $this->ohp));
        $errors = array_merge($errors, parent::valCheck('Attack', $this->oattack));
        $errors = array_merge($errors, parent::valCheck('Defense', $this->odefense));
        $errors = array_merge($errors, parent::valCheck('Special Attack', $this->ospattack));
        $errors = array_merge($errors, parent::valCheck('Special Defense', $this->ospdefense));
        $errors = array_merge($errors, parent::valCheck('Speed', $this->ospeed));
        $errors = array_merge($errors, parent::valCheck('Level', $this->lvl));
        return $errors;
    }
    
}
