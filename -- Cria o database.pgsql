-- cria o database
CREATE database ProLeague;


-- Tabela de usuários
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE, --Não permiti usuarios com o mesmo email
    senha VARCHAR(255)
);

-- Tabela de times
CREATE TABLE times (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    jogo VARCHAR(50),
    descricao TEXT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)  -- vínculo com o dono do time
);

-- Tabela de campeonatos
CREATE TABLE campeonatos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    jogo VARCHAR(50),
    data_campeonato DATE,
    status VARCHAR(50)
);

-- Tabela intermediária: times inscritos em campeonatos
CREATE TABLE campeonato_times (
    id SERIAL PRIMARY KEY,
    campeonato_id INT,
    time_id INT,
    FOREIGN KEY (campeonato_id) REFERENCES campeonatos(id),  -- vínculo com campeonato
    FOREIGN KEY (time_id) REFERENCES times(id)               -- vínculo com time
);

-- Tabela de partidas
CREATE TABLE partidas (
    id SERIAL PRIMARY KEY,
    campeonato_id INT,
    time1_id INT,
    time2_id INT,
    placar1 INT,
    placar2 INT,
    FOREIGN KEY (campeonato_id) REFERENCES campeonatos(id),  -- vínculo com campeonato
    FOREIGN KEY (time1_id) REFERENCES times(id),             -- vínculo com time 1
    FOREIGN KEY (time2_id) REFERENCES times(id)              -- vínculo com time 2
);

-- Tabela de membros dos times (opcional)
CREATE TABLE time_membros (
    id SERIAL PRIMARY KEY,
    time_id INT,
    usuario_id INT,
    FOREIGN KEY (time_id) REFERENCES times(id),        -- vínculo com time
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)   -- vínculo com usuário
);

CREATE TABLE inscricoes (
    id SERIAL PRIMARY KEY,
    usuario_id INT NOT NULL,
    campeonato_id INT NOT NULL,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (campeonato_id) REFERENCES campeonatos(id)
);