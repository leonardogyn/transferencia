## Projeto - Transferência

Seguir os passos abaixo para a instalação do sistema:

## Iniciar os containers do docker

docker-compose up -d

## Instalar os pacotes do composer

docker-compose exec php-fpm composer install

## Limpar o cache do Laravel

docker-compose exec php-fpm php artisan optimize

## Link do public com o storage

 docker-compose exec php-fpm php artisan storage:link

## Gerar as tabelas no banco de dados

docker-compose exec php-fpm php artisan migrate



## Efetuar os testes no sistema

docker-compose exec php-fpm php artisan test



## Documentação - Swagger API

 * Observação: É preciso Gerar a doc do swagger: http://localhost/api/generation.php

 - [Swagger API](http://localhost/api/)
 


## Cobertura de teste de código

docker-compose exec php-fpm php -d xdebug.mode=coverage vendor/phpunit/phpunit/phpunit --coverage-html ./storage/app/public/reports/

Obs: Será criado um diretório "reports" dentro da pasta "storage/app/public"

 - [Cobertura de teste de código](http://localhost/storage/reports/dashboard.html)



## Sobre o Laravel

Laravel é um framework de aplicações web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. Ele facilita o desenvolvimento facilitando tarefas comuns usadas em muitos projetos da web


## Documentação

 - [Documentação](https://laravel.com/docs)
 - [Laracasts](https://laracasts.com)



## Licença

O framework Laravel é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
