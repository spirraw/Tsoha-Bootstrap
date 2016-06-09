CREATE TABLE Pokemon(
  id SERIAL PRIMARY KEY,
  evolution_of_id INTEGER REFERENCES Pokemon(id),
  name varchar(20) NOT NULL,
  ptype varchar(10) NOT NULL,
  bhp INTEGER NOT NULL,
  battack INTEGER NOT NULL,
  bdefense INTEGER NOT NULL,
  bspattack INTEGER NOT NULL,
  bspdefense INTEGER NOT NULL,
  bspeed INTEGER NOT NULL,
  description varchar(300) NOT NULL,
  UNIQUE (name)
);

CREATE TABLE Player(
  id SERIAL PRIMARY KEY,
  name varchar(20) NOT NULL,
  password varchar(50) NOT NULL,
  UNIQUE (name)
);

CREATE TABLE OwnedPokemon(
  pokemon_id INTEGER REFERENCES Pokemon(id),
  player_id INTEGER REFERENCES Player(id),
  name varchar(20) NOT NULL,
  nickname varchar(20)
);