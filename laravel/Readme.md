
### laravel
https://laravel.com/docs/12.x/installation#installing-php
#### Linux
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"
#### Mac
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.4)"
#### Windows
--This doesn't work due to some dependencies. Use the wsl and linux install.
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))

#### continue setup
laravel new basic-content-service
Don't run the migrations during install
cd basic-content-service
npm install && npm run build
php artisan make:model Post -m
php artisan make:controller API/PostController --api --model=Post

##### To load a custom env file 
php artisan make:command LoadEnv
php artisan env:load ../../../aws-resources/localhost-laravel.env

To prevent loading, rename .env in the project root to something else.
I changed it to -.env
#####

php artisan migrate
php artisan serve --port=8080

##### stuff to do to communicate w/ windows mariadb from wsl
in windows for mariadb
GRANT ALL PRIVILEGES ON *.* TO 'root'@'server' IDENTIFIED BY 'mynewpassword';
FLUSH PRIVILEGES;

You can find the server name when you run 
netcat 192.168.40.198 3306
where netcat 192.168.40.198 is the ip of your computer

#### test the service
Get All Posts:
curl "http://127.0.0.1:8080/api/posts"

Create a Post:
curl -X POST "http://127.0.0.1:8080/api/posts" 
     -H "Content-Type: application/json" 
     -d '{
    "title": "My First Post",
    "content": "This is the content of my first post.",
    "author": "John Doe",
    "category": "Tech",
    "author_id": 1,
    "is_published": true
}
'


Get a Post:
curl "http://127.0.0.1:8080/api/posts/1"

Update a Post:
curl -X PUT "http://127.0.0.1:8080/api/posts/1" 
     -H "Content-Type: application/json" 
     -d '{
    "title": "Updated Post Title",
    "is_published": false
}'

Delete a Post:
curl -X DELETE "http://127.0.0.1:8080/api/posts/1"



#### Alternate commands to use 
composer run dev
