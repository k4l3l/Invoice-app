# Invoice-app
This is a php Symfony based application for generating docx files through an HTML form using a template document.

# Project setup
1. Use command prompt: composer install
2. Check .env for database name. Change database connection/credentials to whatever needed
3. Create database through php bin/console doctrine:database:create
4. Add migrations php bin/console make:migration
5. Create needed tables in the db doctrine:migrations:migrate
6. Start the project :)
