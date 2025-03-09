
### laravel
#### (If you don't have php and composer installed)
https://laravel.com/docs/12.x/installation#installing-php
##### Linux
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"
##### Mac
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.4)"
##### Windows
--This doesn't work due to some dependencies. Use the wsl and linux install.
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))

#### (If you already have php and composer installed)
composer global require laravel/installer

For windows 
Add C:\Users\david\AppData\Roaming\Composer\vendor\bin 
For Ubuntu
Add /home/david/.config/composer/vendor/bin
or 
watever bin resulted from the prior script to the user path
Restart VSCode to reload path


#### continue setup
(For windows appended _wn to try it from the global php install in windows and not wsl)
laravel new basic-content-service
Don't run the migrations during install
cd basic-content-service
Run the below in unix environments, but separate statements for windows
npm install && npm run build
php artisan make:model Post -m
Add the following to the migration file 
////////////////////////////////////
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->uuid('unique_id')->default(DB::raw('UUID()')); // UUID with default
            $table->string('title', 200); // VARCHAR(200)
            $table->text('content'); // TEXT column
            $table->timestamp('created_at')->useCurrent(); // Default to now()
            $table->string('author', 200)->nullable(); // VARCHAR(200), nullable
            $table->string('category', 100)->nullable(); // VARCHAR(100), nullable
            $table->timestamp('updated_at')->nullable(); // Nullable timestamp
            $table->integer('likes_count')->default(0); // Integer, default 0
            $table->integer('author_id')->nullable(); // Nullable integer
            $table->boolean('is_published')->default(false); // Boolean, default false
            $table->integer('views')->default(0); // Integer, default 0
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
////////////////////////////////////

php artisan make:controller API/PostController --api --model=Post

Also add in a routes/api.php with the following two lines
use App\Http\Controllers\API\PostController;
Route::apiResource('posts', PostController::class);

In bootstrap/app.php add the following line to the routing configuration
        api: __DIR__.'/../routes/api.php',


##### To load a custom env file 
php artisan make:command LoadEnv
php artisan env:load ../../../aws-resources/localhost-laravel.env

To prevent loading, rename .env in the project root to something else.
I changed it to -.env

##### production database settings
For production add in the values to config/database 
with a tie in to the ../../../aws-resources/localhost-laravel-prod.txt
for the password. So this before the return statement in config/database.php
$github_base = "C:/Users/david/Documents/github";
$password = file_get_contents($github_base."/aws-resources/localhost-laravel-prod.txt");

Set the default database to mariadb
    'default' => env('DB_CONNECTION', 'mariadb'),

and put the following in for the mariadb option
        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', $password),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],


php artisan migrate
php artisan serve --port=8080


##### stuff to do to communicate w/ windows mariadb from wsl (Just use mariadb on wsl)
in windows for mariadb
GRANT ALL PRIVILEGES ON *.* TO 'root'@'server' IDENTIFIED BY 'mynewpassword';
FLUSH PRIVILEGES;

You can find the server name when you run 
netcat 192.168.40.198 3306
where netcat 192.168.40.198 is the ip of your computer
As a bit of housekeeping when you switch to wsl mariadb instance run the following sql
delete from user where host='desktop-k9og5vq.lan';

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
