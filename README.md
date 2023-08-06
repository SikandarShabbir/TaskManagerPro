## How to boot the application

Please make sure you have installed the following dependencies on your environment
   
   - Composer version 2.*
   - PHP 8.1
   - mysql version 8
   - Node 14.5.*
   - Docker version 24.*

1) Clone the GitHub repository from https://github.com/SikandarShabbir/TaskManagerPro.git

2) Change the directory to TaskManagerPro.
    - `cd TaskManagerPro/`
3) Copy .env.example and rename to .env in the root directory. 
    - `cp .env.example .env`
    -  Run `composer install`
    -  Run `npm install`
    -  Run `npm run prod`

4) Run `./vendor/bin/sail up`
   
5) Run `sail artisan migrate --seed`

6) Go to the link http://0.0.0.0:8000/ in the browser.

And test the TaskManagerPro Demo.
   
Thanks.
