CREATE TABLE Pokemon(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
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