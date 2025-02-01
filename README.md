# Dockerized stack for Symfony project

#### Stack : php-apache2 mysql pma

## Requirements :
- Ubuntu 20.04 or higher
- docker and docker-compose (optionnal: docker desktop)
- an IDE (phpStorm, Vscode or else)
- Make on your local machine if you want to use the Makefile commands (optionnal)
- git (optionnal but better)

## Init the existing project
- check entrypoint.sh format (should be in LF)
- Maker : `make init-project`
  - OR copy .env.template to .env and set the variables (Ports, project name, etc) `cp .env.template .env`
  - in backend directory copy .env.dev to .env `cp ./backend/.env.dev ./backend/.env`
  - then build `docker-compose up --build`

## How to set a new project
### Prepare
- `git clone` this project
- rename the main folder to your project name
  - `mv symfony-stack your-project-name`
- copy the .env.template file to .env and set the variables (Ports, project name, etc)
- Set your php version/image in the Dockerfile
- `FROM php:8.3-apache`

### Build
- `docker-compose up --build` OR `make build` to build the containers

### Install Symfony
- once the containers are up and running install Symfony and specify your version :
  - with the maker : `make install-symfony version=7.2.x`
  - OR access your php-apache container 
    - `docker exec -it php-container-id-or-name bash` OR `make php`
    - `composer create-project symfony/skeleton:"7.1.*" .`
- If you are building a microservice or console app or API you're good to go.
- If you need the packages for a webApp :
  - with the maker : `make install-symfony-webapp`
  - `composer require webapp`

### Install PhpUnit
- with the maker : `make install-phpunit`
- OR access your php-apache container 
  - `docker exec -it php-container-id-or-name bash` OR `make php`
  - `composer require --dev symfony/test-pack`

### Install other utilities
### Recommended
- phpcsfixer
- doctrine
- doctrine fixtures

### Git - Sync to your GitHub repository
- `git init`
- Remove the origin:
- `git remote remove origin`
- Add your repository as origin:
- `git remote add origin your-repo-ssh-url`
- `git branch -M main` OR `git branch -M master`
- `git add .`
- `git commit -m "Initial commit"`
- `git push -u origin main` OR `git push -u origin master`

## Useful commands
### PhpUnit
- `make phpunit` to run the tests
- `make fixtures` to load the fixtures
- `make fix` to fix with php-cs-fixer

## Troubleshooting
### entrypoint.sh not found
- change the format of the file to LF unix

### Change the owner
- owner in your container should be www-data
- owner on your local machine should be your user
- if you need to change ownership :
  - access your php container
    - `docker exec -it php-container-id-or-name bash` OR `make php`
    - go to var
      - `cd /var/www`
    - change the owner of the www folder
      - `chown -R www-data:www-data html`

- If you can't create a file on your local machine :
  - You might need to change the owner of your backend directory on your local machine too
    - `sudo chown -R $USER:$USER backend`

## Good to go ?
- check `localhost:8080` to see your app running or `localhost:PHP_APACHE_HOST_PORT` you have set in the .env file
- check `localhost:8088` to see your phpmyadmin or `localhost:PMA_HOST_PORT` you have set in the .env file
- your database is running on port `3308` or `MYSQL_PORT` you have set in the .env file
- At this point your containers should be running fine. You're ready to go 🚀!

- If something is wrong check your docker logs

