# Legops Docker Project
### by: Andres vega - afelipe.vega@gmail.com
### cel : 3012017499

- Instalación => 
  - docker-compose build && docker-compose up -d
  - docker exec -it legops_back /bin/bash
  - dentro del contenedor:
    - composer install
    - npm install
    - cp .env.example .env
    - php artisan key:generate
    - php artisan migrate
    - php artisan queue:work --queue=listeners 