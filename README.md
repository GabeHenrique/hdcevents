## Projeto de Estudos com PHP e Laravel

Este projeto foi criado com o intuito de estudar a linguagem PHP e o framework Laravel. O sistema consiste em um gerenciador de eventos, onde é possível cadastrar, editar, excluir e visualizar eventos.

## Tecnologias Utilizadas

- **Eloquent ORM**: Um ORM (Object Relational Mapping) que permite a interação com o banco de dados de forma mais simples e intuitiva.
- **Blade**: Um mecanismo de template do Laravel que facilita a criação de templates.
- **SQLite**: Um banco de dados relacional utilizado para armazenar os dados do sistema.
- **Bootstrap**: Um framework front-end utilizado para estilizar o sistema.

## Funcionalidades do Sistema

- Cadastro de eventos
- Edição de eventos
- Exclusão de eventos
- Visualização de eventos
- Visualização de detalhes de um evento
- Confirmação de presença em um evento

## Como Rodar o Projeto

Para rodar o projeto, é necessário ter o PHP instalado na máquina, além do Composer.

Siga os passos abaixo para configurar e rodar o projeto:

```bash
#Instale as dependências do projeto:
composer install
# Crie o arquivo .env a partir do .env.example: 
cp .env.example .env 
# Gere a chave da aplicação:
php artisan key:generate
# Crie o banco de dados e execute as migrações:
php artisan migrate
# Inicie o servidor:
php artisan serve
# Instale as dependências do front-end:
npm install
# Suba o servidor do front-end:
npm run dev
```


Acesse o sistema em `http://localhost:8000`.
