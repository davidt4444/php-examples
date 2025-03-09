### Create the project

composer create-project --prefer-dist cakephp/app:~4.0 basic-content-service

This should run without issue in Linux or ubuntu. In windows, you will need to make sure that your version of php matches up. In those cases, run the following.
composer create-project --ignore-platform-req=php --prefer-dist cakephp/app:~4.0 basic-content-service 

### In config/app_local.php
#### Add the following teolines before the retuen statement.
$github_base = "/mnt/c/Users/david/Documents/github";
$password = file_get_contents($github_base."/aws-resources/localhost-laravel-prod.txt");

#### Use the following as the default
        'default' => [
            'host' => 'localhost',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',

            'username' => 'root',
            'password' => $password,

            'database' => 'phpbase',
            /*
             * If not using the default 'public' schema with the PostgreSQL driver
             * set it here.
             */
            //'schema' => 'myapp',

            /*
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', 'mysql://127.0.0.1'),
        ],

### Run the server
bin/cake server -p 8765
