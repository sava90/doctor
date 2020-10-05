Doctor
======================

Installation:

1. Clone repository

2. Run composer install

3. Configure your web server

4. Change config param DATABASE_URL ".env" file in root project directory (DataBase MySQL) 

5. Run commands:
    
        bin/console doctrine:database:create
        bin/console make:migration
        bin/console doctrine:migrations:migrate
        bin/console doctrine:fixtures:load
        yarn install
        yarn encore dev

6. Done