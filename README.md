# Eventer

An open source, event management system built using Symfony and Twig.

![alt text](media/homepage.png "Homepage")

Eventer allows users to create, update, delete, and display all of their events, in one place!

## Installation

### Non-Docker Install Instructions

Requires [Composer](https://getcomposer.org/) to install dependencies

#### Method 1: Run the install dependencies script

If you have composer installed globally on your machine, run the install_dependencies.sh that I have provided.
This will install all composer dependencies and run the database migrations.

`./install_dependencies.sh`

#### Method 2: Manually install the dependencies and run the database migrations.

1. Install Dependencies

`composer install`

2. Edit the env file and add database params

`DATABASE_URL=mysql://db_user:db_password@db_host:db_port/db_name`

3. Run database migrations

`php bin/console doctrine:migrations:migrate`

### Docker Install Instructions

Requires [Docker](https://www.docker.com/products/docker-desktop) to build installed locally.

#### Method 1: Run the docker_install script that I have provided.

1. Ensure that the .env file has the correct settings for the SQL container.

`DATABASE_URL=mysql://root:root@mysql:3306/eventer`

2. Run the installation script.

`./docker_install.sh`

#### Method 2: Manually run the commands to create the docker images and containers.

1. Build the images from the docker compose file.

`docker-compose -f "docker-compose.yml" up -d --build`

2. Wait for the SQL container to finish setting itself up (15 to 20 seconds).

3. Execute php-fpm bash to 'chroot' into the docker container.

`docker-compose exec php-fpm bash`

4. Setup the database with the doctrine migrations

`php bin/console doctrine:migrations:migrate`

## Usage

### Running A Non-Docker Installation

Either run in a PHP development environment such as XAMPP or run a symfony server:

`symfony server:start`

### Running A Docker Installation

Run the program by running all of the docker containers and opening a browser and going to http://localhost:8000/

## License

Eventer is [MIT-Licensed](LICENSE)
