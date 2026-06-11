# 🎮 ProLeague

## Plataforma de Campeonatos de Jogos

O **ProLeague** é uma plataforma web desenvolvida para gerenciamento de campeonatos de jogos eletrônicos. O sistema permite que usuários criem contas, formem times, participem de campeonatos e acompanhem partidas e rankings.

O projeto foi desenvolvido com foco em organização, responsividade e um visual gamer moderno.

---

# 🚀 Tecnologias Utilizadas

* **PHP**
* **HTML5**
* **CSS3**
* **JavaScript**
* **PostgreSQL**

---

# 🎯 Objetivo do Projeto

O objetivo do ProLeague é oferecer uma plataforma simples para:

* Cadastro e login de usuários;
* Criação e gerenciamento de times;
* Inscrição em campeonatos;
* Controle de partidas;
* Área administrativa para gerenciamento do sistema;
* Aplicação prática de CRUD e banco de dados relacional.

---

# ⚙️ Funcionalidades

### 👤 Usuários

* Cadastro de conta;
* Login e logout;
* Diferenciação entre usuário comum e administrador.

### 👥 Times

* Criação de times;
* Edição das informações do time;
* Associação de jogadores ao time.

### 🏆 Campeonatos

* Listagem dos campeonatos disponíveis;
* Inscrição em eventos;
* Controle de status dos campeonatos.

### ⚔️ Partidas

* Cadastro de confrontos;
* Registro dos placares;
* Associação das partidas aos campeonatos.

### 🔧 Área Administrativa

* Gerenciamento dos campeonatos;
* Controle das partidas;
* Administração do sistema.

---

# 📂 Estrutura do Projeto

```text
proleague/
│
├── index.php                 
├── home.php
├── login.php
├── cadastro.php
├── logout.php
│
├── campeonatos/
│   ├── campeonatos.php
│   ├── inscrever_campeonato.php
│   ├── editar_campeonato.php
│   └── excluir_campeonato.php
│
├── partidas/
│   ├── partidas.php
│   ├── editar_partida.php
│   └── excluir_partida.php
│
├── times/
│   ├── times.php
│   ├── editar_time.php
│   └── excluir_time.php
│
├── admin/
│   ├── admin_inscritos.php
│   └── gestao_usuarios.php
│
├── usuario/
│   └── minhas_inscricoes.php
│
├── includes/
│   ├── conexao.php
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   └── funcoes.php
│
├── css/
│   ├── style.css
│   ├── home.css
│   ├── campeonatos.css
│   └── admin.css
│
├── js/
│   ├── script.js
│   └── theme.js
│
├── img/
│   ├── logo.png
│   ├── banners/
│   └── icones/
│
├── database/
│   ├── criar_database.pgsql
│   └── proleague_backup.sql
│
├── docs/
│   ├── README.md
│   └── Plataforma de campeonatos de jogos.txt
```

---

# 🗄️ Banco de Dados

O sistema utiliza **PostgreSQL** para armazenar todas as informações da plataforma.

## Tabela `usuarios`

Responsável por armazenar os dados dos usuários cadastrados.

| Campo | Descrição                                  |
| ----- | ------------------------------------------ |
| id    | Identificador do usuário                   |
| nome  | Nome do usuário                            |
| email | Email utilizado para login                 |
| senha | Senha criptografada                        |
| tipo  | Define se é administrador ou usuário comum |

---

## Tabela `times`

Armazena os times criados pelos usuários.

| Campo      | Descrição                     |
| ---------- | ----------------------------- |
| id         | Identificador do time         |
| nome       | Nome do time                  |
| jogo       | Jogo principal do time        |
| descricao  | Informações sobre o time      |
| usuario_id | Usuário responsável pelo time |

---

## Tabela `campeonatos`

Guarda os campeonatos cadastrados na plataforma.

| Campo           | Descrição                    |
| --------------- | ---------------------------- |
| id              | Identificador do campeonato  |
| nome            | Nome do campeonato           |
| jogo            | Jogo relacionado             |
| data_campeonato | Data do evento               |
| status          | Situação atual do campeonato |

---

## Tabela `partidas`

Responsável pelo controle dos confrontos entre os times.

| Campo         | Descrição                   |
| ------------- | --------------------------- |
| id            | Identificador da partida    |
| campeonato_id | Campeonato ao qual pertence |
| time1_id      | Primeiro time               |
| time2_id      | Segundo time                |
| placar1       | Pontuação do time 1         |
| placar2       | Pontuação do time 2         |

---

## Tabela `inscricoes`

Relaciona usuários aos campeonatos em que estão inscritos.

| Campo         | Descrição                  |
| ------------- | -------------------------- |
| id            | Identificador da inscrição |
| usuario_id    | Usuário inscrito           |
| campeonato_id | Campeonato escolhido       |

---

## Tabela `campeonato_times`

Tabela intermediária que relaciona os times aos campeonatos.

Ela permite que vários times participem de um mesmo campeonato.

---

## Tabela `time_membros`

Armazena os jogadores pertencentes a cada time.

Essa tabela cria a relação entre usuários e equipes.

---

# 🎨 Interface

O sistema possui:

* Tema escuro;
* Estilo gamer com cores neon;
* Layout responsivo;
* Compatibilidade com computadores e dispositivos móveis.

---

# 📚 Conceitos Aplicados

* CRUD completo;
* Sessões em PHP;
* Login e autenticação;
* Relacionamentos entre tabelas;
* Chaves primárias e estrangeiras;
* PostgreSQL;
* Organização de projeto web.

---

# 🔮 Melhorias Futuras

* Upload de logo dos times;
* Sistema de chaveamento automático;
* Ranking avançado;
* Estatísticas dos jogadores;
* Painel administrativo mais completo.

---

# 👨‍💻 Desenvolvedor

Projeto desenvolvido para fins acadêmicos e prática de desenvolvimento web utilizando PHP e PostgreSQL.

**ProLeague - Plataforma de Campeonatos Gamer**

🔑 Acesso Administrativo

Para facilitar os testes do sistema, foi criado um usuário administrador padrão.

Email:

ney@gmail.com

Senha:

67

Este usuário possui acesso às funcionalidades administrativas do ProLeague, como gerenciamento de usuários, campeonatos e partidas.

Link figma: https://www.figma.com/make/DGSvGy9JlUjtW6k23lvWuj/Prototipar-p%C3%A1ginas-existentes?t=fvSXoypbsCYBfPVW-20&fullscreen=1&preview-route=%2Fcampeonatos
