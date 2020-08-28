
## Sobre

- Aplicação para requisição ao site Quest Multimarcas (https://www.questmultimarcas.com.br/estoque), capturando com REGEX os dados dos veículos resultantes da busca pelo termo digitado.

## Requisitos
- PHP 7.2 ou +
- MSYQL 5.7+
- Composer

## Orientações
- 1) Renomeie o arquivo ".env.example" para ".env" e configure os campos APP_URL com a URL completa do projeto, DB_DATABASE com o nome do banco de dados criado, DB_USERNAME e DB_PASSWORD com login e senha do banco de dados.
- 2) Em seguida utilize "composer install" para que seja instalado todas as dependências do Projeto.
- 3) Após instalar as dependências utilize "npm install" para que seja instalado todas as dependências do Webpack. Em seguida utilize "npm run dev" para executar o Webpack.
- 4) Para finalizar, utilize o "php artisan migrate --seed" para que executar todos os Migrations (criação de todas as tabelas) e popular as mesmas.