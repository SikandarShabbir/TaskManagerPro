## How to boot the application

1) Clone the GitHub repository from https://github.com/SikandarShabbir/TaskManagerPro.git link.

2) Change the directory to TaskManagerPro.
    - `cd TaskManagerPro/`
3) Copy .env.example and rename to .env in the root directory. 
    - `cp .env.example .env`

4) Run `./vendor/bin/sail up`
   
5) Run `sail artisan migrate --seed`

6) Go to the link http://0.0.0.0:8000/ in the browser.

And test the TaskManagerPro Demo.
   
Thanks.
