CREATE TABLE Pokemon(
  id SERIAL PRIMARY KEY,
  evolution_of_id INTEGER REFERENCES Pokemon(id),
  name varchar(20) NOT NULL,
  ptype varchar(20) NOT NULL,
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
  id SERIAL PRIMARY KEY,
  pokemon_id INTEGER REFERENCES Pokemon(id),
  player_id INTEGER REFERENCES Player(id),
  name varchar(20) NOT NULL,
  nickname varchar(20),
  added date NOT NULL,
  ptype varchar(20) NOT NULL,
  ohp INTEGER NOT NULL,
  oattack INTEGER NOT NULL,
  odefense INTEGER NOT NULL,
  ospattack INTEGER NOT NULL,
  ospdefense INTEGER NOT NULL,
  ospeed INTEGER NOT NULL,
  lvl INTEGER NOT NULL,
  description varchar(300) NOT NULL
);

CREATE TABLE Move(
  id SERIAL PRIMARY KEY,
  name varchar(20) NOT NULL,
  mtype varchar(20) NOT NULL,
  mcat varchar(20) NOT NULL,
  pp INTEGER NOT NULL,
  power INTEGER NOT NULL,
  accuracy INTEGER NOT NULL,
  description varchar(300) NOT NULL,
  UNIQUE (name)
);

CREATE TABLE OwnMove(
  id SERIAL PRIMARY KEY,
  pokemon_id INTEGER REFERENCES OwnedPokemon(id),
  move_id INTEGER REFERENCES Move(id)
);
