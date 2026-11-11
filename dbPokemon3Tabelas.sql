CREATE TABLE tipos (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  CONSTRAINT pk_tipos PRIMARY KEY (id)
);

CREATE TABLE geracoes (
  id INTEGER NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  CONSTRAINT pk_geracoes PRIMARY KEY (id)
);

CREATE TABLE pokemons (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  descricao VARCHAR(200) NOT NULL,
  urlImg VARCHAR(1000) NOT NULL,
  id_tipo INTEGER NOT NULL,
  id_geracao INTEGER NOT NULL,
  CONSTRAINT pk_pokemons PRIMARY KEY (id)
);

ALTER TABLE pokemons ADD CONSTRAINT fk_pokemons_tipos 
FOREIGN KEY (id_tipo) REFERENCES tipos (id);

ALTER TABLE pokemons ADD CONSTRAINT fk_pokemons_geracoes 
FOREIGN KEY (id_geracao) REFERENCES geracoes (id);

/* INSERTS */
INSERT INTO tipos (nome) VALUES ('Fogo');
INSERT INTO tipos (nome) VALUES ('Planta');
INSERT INTO tipos (nome) VALUES ('Aquático');

INSERT INTO geracoes (nome) VALUES ('1º - Liga Indigo');
INSERT INTO geracoes (nome) VALUES ('2º - Liga Jotho');


INSERT INTO pokemons (nome, descricao, urlImg, id_tipo, id_geracao)
VALUES ('Charizard', 'Dragão de Fogo', 'https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/006.png', 1, 1);
