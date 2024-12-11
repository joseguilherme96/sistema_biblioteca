## Sistema de Gerenciamento para Biblioteca

Este projeto foi desenvolvido para o trabalho de conclusão do curso em Tecnologia de Sistemas para Internet da Fatec São Roque.

## Principais Funcionalidades

- Autenticação
- Cadastros de usuários por niveis de acesso
- Verificação dos níveis de acesso dos usuários e liberação dos recursos do sistema para o usuário de acordo com seus previlégios
- Cadastro de livros
- Cadastro de entrada de livros no estoque
- Listagem de livros
- Verificação automática dos livros disponíveis no estoque para reserva
- Geração de reservas dos livros
- Lista de reservas
- Atendimento da reserva
- Relatório de movimentação de livros no estoque
- Impressão de relatório

## Principais tecnologias

- [![Logo framework Vue.js](storage/app/public/imagens/logo_vue_js.png "Logo, framework vue.js")](https://github.com/joseguilherme96/sistema_biblioteca/blob/d2802d20986b37d8a07687a681af0169c3fe8c1e/storage/app/public/imagens/logo_vue_js.png)

- [![Logo framework vuetify](storage/app/public/imagens/log_vuetify.png "Logo, framework vuetify")](https://github.com/joseguilherme96/sistema_biblioteca/blob/d2802d20986b37d8a07687a681af0169c3fe8c1e/storage/app/public/imagens/log_vuetify.png)

- [![Logo bootstrap](storage/app/public/imagens/bootstrap_logo.png "Logo, bootstrap")](https://github.com/joseguilherme96/sistema_biblioteca/blob/main/storage/app/public/imagens/bootstrap_logo.png)

- [![Logo framework laravel](storage/app/public/imagens/logo_laravel.png "Logo, framework laravel")](https://github.com/joseguilherme96/sistema_biblioteca/blob/main/storage/app/public/imagens/logo_laravel.png)

## Instalação

Para instalar o sistema na sua máquina você deve seguir os processos abaixo.

### Requisitos

- PHP >= 8.2
- Banco de dados MySQL >= 10.4.27-MariaDB.
- Composer >= 2.7.7
- Node.js >= V18.13.0
- NPM >= 8.19.3

### Git Clone

Clone o repositório.

```bash

    git clone https://github.com/joseguilherme96/sistema_biblioteca.git

    cd sistema_biblioteca

```


### Crie um banco de dados

Após o banco de dados estiver instalado. crie um banco de dados chamado sistema_biblioteca.

```bash

    CREATE DATABASE sistema_biblioteca

```

### Instale as depêndencias

```bash
    composer install
```

### Crie um arquivo .env

Copie o arquivo de exemplo para as configurar as variaveis de ambiente posteriormente.

```bash

    cp .env.example .env

```

### Gere a chave do sistema

```bash

    php artisan key:generate

```

### Criar link simbólico para imagens
O sistema já vem com alguns cadastros de livros por padrão, por isso é preciso executar o comando abaixo, pois na listagem de livros, eles também possuem uma imagem da capa para cada livro e ao digitar o comando abaixo fará com que o laravel crie um link simbólico para que as imagens possam ser acessadas facilmente pela url e também faz com que as imagens das capas dos livros apareçam juntamente com os livros cadastrados.

```bash

    php artisan storage:link

```

### Criação das tabelas no Mysql

Para criação das tabelas no banco de dados, utilize o recurso de migração do laravel que automaticamente todas as tabelas serão criadas no MySQL.

```bash

    php artisan migrate

```

### Instale as depêndencias do frontend

```bash

    npm install

```

## Execução do projeto

Para inciar o projeto.

### Servidor local para frontend

Execute o seguinte comando, isso fará com que o servidor local de frontend seja iniciado.

```bash

    npm run dev

```

### Servidor local para backend

Para execução do servidor local, execute o seguinte comando, isso fará com que o servidor de backend seja inciado.

```bash

    php artisan serve

```

## Aplicação

Após feito todo processo, a aplicação é para estar disponivel em [(http://127.0.0.1:8000)](http://127.0.0.1:8000).

Usuário e senha default para acesso: <br>

**Usuário :** admin@sistema.biblioteca.com.br<br>
**Senha :** *531nn22n44Ab
