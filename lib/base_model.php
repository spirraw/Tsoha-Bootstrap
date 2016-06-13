<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }

    private function nameCheck() {
        return $this->stringCheck('Nimi', $this->name);
    }

    private function duplicatePokemonNameCheck() {
        return $this->duplicateNameCheck('Pokemon');
    }
    
    protected function duplicateNameCheck($table) {
        $errors = array();
        $query = DB::connection()->prepare('SELECT * FROM ' . $table . ' WHERE name = :name');
        $query->bindValue(':name', $this->name);
        $query->execute();

        $rows = $query->fetchAll();
        
        if(count($rows) > 0) {
            $errors[] = $this->name . ' on jo olemassa!';
        }

        return $errors;
    }

    protected function stringCheck($check, $string) {
        $errors = array();

        if (empty($string)) {
            $errors[] =  $check . ' ei saa olla tyhjä!';
        }

        return $errors;
    }

    protected function valCheck($check, $val) {
        $errors = array();
        
        if(empty($val)) {
            $errors[] = $check . ' ei saa olla tyhjä!';
        }
        
        if(!is_numeric($val)) {
            $errors[] = $check . ':n ' . $val . ' ei ole luku!';
        }
        
        return $errors;
    }
}
