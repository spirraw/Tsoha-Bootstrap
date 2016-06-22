<?php

class Move extends BaseModel {

    public $id, $name, $mtype, $mcat, $pp, $power, $accuracy, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array('nameCheck');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Move');
        $query->execute();

        $move = array();

        foreach ($query->fetchAll() as $row) {
            $move[] = new Move(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'mtype' => $row['mtype'],
                'mcat' => $row['mcat'],
                'pp' => $row['pp'],
                'power' => $row['power'],
                'accuracy' => $row['accuracy'],
                'description' => $row['description']
            ));
        }

        return $move;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Move WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            return new Move(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'mtype' => $row['mtype'],
                'mcat' => $row['mcat'],
                'pp' => $row['pp'],
                'power' => $row['power'],
                'accuracy' => $row['accuracy'],
                'description' => $row['description']
            ));
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Move (name, mtype, mcat, pp, power, accuracy, description) VALUES (:name, :mtype, :mcat, :pp, :power, :accuracy, :description) RETURNING id');

        $query->execute(array('name' => $this->name, 'mtype' => $this->mtype, 'mcat' => $this->mcat, 'pp' => $this->pp, 'power' => $this->power, 'accuracy' => $this->accuracy, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Move SET (name, mtype, mcat, pp, power, accuracy, description) = (:name, :mtype, :mcat, :pp, :power, :accuracy, :description) WHERE id = :id');

        $query->execute(array('name' => $this->name, 'mtype' => $this->mtype, 'mcat' => $this->mcat, 'pp' => $this->pp, 'power' => $this->power, 'accuracy' => $this->accuracy, 'description' => $this->description, 'id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Move WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function errors($update) {
        $errors = parent::errors();
        if (!$update) {
            $errors = array_merge($errors, parent::duplicateNameCheck('Move', $this->name));
        }
        if ($this->accuracy > 100) {
            $errors[] = 'Accuracyn täytyy olla välillä 1-100!';
        } else if ($this->accuracy < 1) {
            $errors[] = 'Accuracyn täytyy olla välillä 1-100!';
        }
        $errors = array_merge($errors, parent::stringCheck('Tyyppi', $this->mtype));
        $errors = array_merge($errors, parent::valCheck('PP', $this->pp));
        $errors = array_merge($errors, parent::valCheck('Power', $this->power));
        $errors = array_merge($errors, parent::valCheck('Accuracy', $this->accuracy));
        $errors = array_merge($errors, parent::stringCheck('Kuvaus', $this->description));
        return $errors;
    }

}
