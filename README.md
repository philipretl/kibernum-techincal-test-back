# Kibernum Technical Test - Docker Project
### by: Andres vega - afelipe.vega@gmail.com
### cel : 3012017499
### @philipretl

## Backend

- Requirements => 
  - Docker.
  

- Installation =>
  - docker-compose build && docker-compose up -d
  - docker exec -it kibernum_back /bin/bash
  - inside of container =>
    - composer install
    - cp .env.example .env
    - php artisan key:generate
  

- Running Test => 
  - docker exec -it kibernum_back /bin/bash
  - inside of container =>
    - All Test Suite => 
      - php artisan test
    - Integration Test => 
      - php artisan test --filter 'Tests\\Feature\\Integration'
    - Internal Feature Test => 
      - php artisan test --filter 'Tests\\Feature\\Internal'
      

- Access to Project =>
  - go to http://localhost:8082