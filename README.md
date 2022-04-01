# Kibernum Technical Test - Docker Project
### by: Andres vega - afelipe.vega@gmail.com
### cel : 3012017499

- Instalación => 
  - docker-compose build && docker-compose up -d
  - docker exec -it kibernum_back /bin/bash
  - inside of container:
    - composer install
    - cp .env.example .env
    - php artisan key:generate