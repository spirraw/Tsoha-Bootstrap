<?php

class Pokemon extends BaseModel {

    public $id, $name, $evolution_of_id, $ptype, $bhp, $battack, $bdefense, $bspattack, $bspdefense, $bspeed, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
        
        $this->validators = array('nameCheck');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pokemon');
        $query->execute();

        $pokemon = array();

        foreach ($query->fetchAll() as $row) {
            $pokemon[] = new Pokemon(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'evolution_of_id' => $row['evolution_of_id'],
                'ptype' => $row['ptype'],
                'bhp' => $row['bhp'],
                'battack' => $row['battack'],
                'bdefense' => $row['bdefense'],
                'bspattack' => $row['bspattack'],
                'bspdefense' => $row['bspdefense'],
                'bspeed' => $row['bspeed'],
                'description' => $row['description']
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
                'name' => $row['name'],
                'evolution_of_id' => $row['evolution_of_id'],
                'ptype' => $row['ptype'],
                'bhp' => $row['bhp'],
                'battack' => $row['battack'],
                'bdefense' => $row['bdefense'],
                'bspattack' => $row['bspattack'],
                'bspdefense' => $row['bspdefense'],
                'bspeed' => $row['bspeed'],
                'description' => $row['description']
            ));
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Pokemon (name, evolution_of_id, ptype, bhp, battack, bdefense, bspattack, bspdefense, bspeed, description) VALUES (:name, :evolution_of_id, :ptype, :bhp, :battack, :bdefense, :bspattack, :bspdefense, :bspeed, :description) RETURNING id');

        $query->execute(array('name' => $this->name, 'evolution_of_id' => $this->evolution_of_id, 'ptype' => $this->ptype, 'bhp' => $this->bhp, 'battack' => $this->battack, 'bdefense' => $this->bdefense, 'bspattack' => $this->bspattack, 'bspdefense' => $this->bspdefense, 'bspeed' => $this->bspeed, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Pokemon SET (name, evolution_of_id, ptype, bhp, battack, bdefense, bspattack, bspdefense, bspeed, description) = (:name, :evolution_of_id, :ptype, :bhp, :battack, :bdefense, :bspattack, :bspdefense, :bspeed, :description) WHERE id = :id');
        
        $query->execute(array('name' => $this->name, 'evolution_of_id' => $this->evolution_of_id, 'ptype' => $this->ptype, 'bhp' => $this->bhp, 'battack' => $this->battack, 'bdefense' => $this->bdefense, 'bspattack' => $this->bspattack, 'bspdefense' => $this->bspdefense, 'bspeed' => $this->bspeed, 'description' => $this->description, 'id' => $this->id));
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Pokemon WHERE id = :id');       
        $query->execute(array('id' => $this->id));
    }
    
    public function errors($update) {
        $errors = parent::errors();
        if(!$update) {
            $errors = array_merge($errors, parent::duplicateNameCheck('Pokemon', $this->name));
        }
        if($this->evolution_of_id != null && $this->find($this->evolution_of_id) == null) {
            $errors[] = 'Pokemonia id:llä ' . $this->evolution_of_id . ' ei ole!';
        }
        $errors = array_merge($errors, parent::stringCheck('Tyyppi', $this->ptype));
        $errors = array_merge($errors, parent::valCheck('HP', $this->bhp));
        $errors = array_merge($errors, parent::valCheck('Attack', $this->battack));
        $errors = array_merge($errors, parent::valCheck('Defense', $this->bdefense));
        $errors = array_merge($errors, parent::valCheck('Special Attack', $this->bspattack));
        $errors = array_merge($errors, parent::valCheck('Special Defense', $this->bspdefense));
        $errors = array_merge($errors, parent::valCheck('Speed', $this->bspeed));
        $errors = array_merge($errors, parent::stringCheck('Kuvaus', $this->description));
        return $errors;
    }
    
}
