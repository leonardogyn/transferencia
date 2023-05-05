## Projeto - Transferência

Seguir os passos abaixo para a instalação do sistema:


## Instalar os pacotes do composer

docker-compose -f docker-compose.yaml exec php-fpm composer install

## Limpar o cache do Laravel

docker-compose -f docker-compose.yaml exec php-fpm php artisan optimize

## Gerar as tabelas no banco de dados

docker-compose -f docker-compose.yaml exec php-fpm php artisan migrate --seed 

## Cobertura de teste de código

docker-compose -f docker-compose.yaml exec php-fpm php -d xdebug.mode=coverage vendor/phpunit/phpunit/phpunit --coverage-html ./storage/reports/

Obs:
 - Será criado um diretório "reports" dentro da pasta "storage"
 - Acessar o diretório  "reports" e abrir o index.html no navegador de sua escolha. 


## Sobre o Laravel

Laravel é um framework de aplicações web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. Ele facilita o desenvolvimento facilitando tarefas comuns usadas em muitos projetos da web


## Documentação

 - [Documentação](https://laravel.com/docs)
 - [Laracasts](https://laracasts.com)


## Licença

O framework Laravel é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
