-- cria o database
CREATE DATABASE ProLeague;

-- Tabela de usuários (já com a coluna tipo inclusa)
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255),
    tipo VARCHAR(20) DEFAULT 'usuario'
);

-- Tabela de times
CREATE TABLE times (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    jogo VARCHAR(50),
    descricao TEXT,
    usuario_id INT,
    -- Se o dono do time for deletado, o time também é deletado
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE  
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
    FOREIGN KEY (campeonato_id) REFERENCES campeonatos(id) ON DELETE CASCADE,
    -- Se o time for deletado automaticamente, remove ele dos campeonatos
    FOREIGN KEY (time_id) REFERENCES times(id) ON DELETE CASCADE               
);

-- Tabela de partidas
CREATE TABLE partidas (
    id SERIAL PRIMARY KEY,
    campeonato_id INT,
    time1_id INT,
    time2_id INT,
    placar1 INT,
    placar2 INT,
    FOREIGN KEY (campeonato_id) REFERENCES campeonatos(id) ON DELETE CASCADE,
    -- Se o time for apagado, remove o histórico de partidas dele
    FOREIGN KEY (time1_id) REFERENCES times(id) ON DELETE CASCADE,             
    FOREIGN KEY (time2_id) REFERENCES times(id) ON DELETE CASCADE              
);

-- Tabela de membros dos times
CREATE TABLE time_membros (
    id SERIAL PRIMARY KEY,
    time_id INT,
    usuario_id INT,
    FOREIGN KEY (time_id) REFERENCES times(id) ON DELETE CASCADE,
    -- Se o usuário sair do sistema, ele sai do time automaticamente
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE   
);

-- Tabela de inscrições diretas de usuários em campeonatos
CREATE TABLE inscricoes (
    id SERIAL PRIMARY KEY,
    usuario_id INT NOT NULL,
    campeonato_id INT NOT NULL,
    -- Aqui corrige o erro que deu no seu PHP!
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (campeonato_id) REFERENCES campeonatos(id) ON DELETE CASCADE
);

-- Cria o campo do Tipo do usuario (admin ou usuario)
ALTER TABLE usuarios ADD COLUMN tipo VARCHAR(20) DEFAULT 'usuario';

SELECT * from usuarios

--Para ter acesso como ADMIN:
--Crie um usuario de preferencia chamado Teste
--Coloque um email valido exemplo teste@gmail.com
--E uma senha qualquer
--Apos rode esse comando para verificar se o usuario foi criado
--SELECT * from usuarios
--Veja o ID do perfil criado e rode esse comando
UPDATE usuarios SET tipo = 'admin' WHERE id = ?; --denomida o id do teste@gmail.com como admin 

--Adicioneie essa para excluir um usuario junto com seu time, campeonato inscrito, etc ...
-- 1. Corrige a tabela 'inscricoes' (o erro que deu no seu PHP)
ALTER TABLE inscricoes DROP CONSTRAINT IF EXISTS inscricoes_usuario_id_fkey;
ALTER TABLE inscricoes ADD CONSTRAINT inscricoes_usuario_id_fkey 
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;

-- 2. Corrige a tabela 'time_membros'
ALTER TABLE time_membros DROP CONSTRAINT IF EXISTS time_membros_usuario_id_fkey;
ALTER TABLE time_membros ADD CONSTRAINT time_membros_usuario_id_fkey 
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;

-- 3. Corrige a tabela 'times'
ALTER TABLE times DROP CONSTRAINT IF EXISTS times_usuario_id_fkey;
ALTER TABLE times ADD CONSTRAINT times_usuario_id_fkey 
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;

-- 4. Corrige as tabelas vinculadas aos times (para o efeito dominó funcionar)
ALTER TABLE campeonato_times DROP CONSTRAINT IF EXISTS campeonato_times_time_id_fkey;
ALTER TABLE campeonato_times ADD CONSTRAINT campeonato_times_time_id_fkey 
    FOREIGN KEY (time_id) REFERENCES times(id) ON DELETE CASCADE;

ALTER TABLE partidas DROP CONSTRAINT IF EXISTS partidas_time1_id_fkey;
ALTER TABLE partidas ADD CONSTRAINT partidas_time1_id_fkey 
    FOREIGN KEY (time1_id) REFERENCES times(id) ON DELETE CASCADE;

ALTER TABLE partidas DROP CONSTRAINT IF EXISTS partidas_time2_id_fkey;
ALTER TABLE partidas ADD CONSTRAINT partidas_time2_id_fkey 
    FOREIGN KEY (time2_id) REFERENCES times(id) ON DELETE CASCADE;