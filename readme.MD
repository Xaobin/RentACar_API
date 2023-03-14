## Application in Laravel using API
### API Rent a Car

#### Divided in parts:

Part 1: Folder api_rentcar_part1<p><small> -CarBrandController  -CarBrandModel</small></p>
 Part 2: Folder api_rentcar_part2 (Refactoring)
<p><small> -CarBrandController  -CarBrand Model</small></p>
 Part 3: Folder api_rentcar_part3 (Refactoring)
<p><small> -CarBrandController  -CarBrandModel  -CarModelController  -CarModel Model</small></p>
 Part 4: Folder api_rentcar_part4 (Refactoring: add filter)
<p><small> -CarBrandController  -CarBrandModel 
 -CarModelController  -CarModel Model 
 -Others Models and contollers
</small></p>
 Part 5: Folder api_rentcar_part5 (Add Tymon/JWT)
<p><small> -AuthController </small></p>

Follow Steps for JWT instalation:
[https://jwt-auth.readthedocs.io/en/develop/laravel-installation/](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
[https://jwt-auth.readthedocs.io/en/develop/quick-start/](https://jwt-auth.readthedocs.io/en/develop/quick-start/)

* Not forget: app/Http/Kernel.php 
  - protected $routeMiddleware = [ ...
  -'jwt.auth' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,


#### Commands
        PHP composer create-project --prefer-dist laravel/laravel="8.5.9" app_car
        PHP artisan make:model --migration --controller --resource CarBrand
        PHP artisan make:model -mcr CarModel
        PHP artisan make:model --all Car
        PHP artisan make:model --all CarClient
        PHP artisan make:model --all CarRent
        PHP artisan migrate
        PHP composer require tymon/jwt-auth "1.0.2"
        PHP artisan make:controller AuthController
	npm install vuex@3.6.2

#### Configure .env
#### Copy the Content of app folder
#### Routes/api.php and Database/migrations
#### Tested! and Works!

#### Controller CarBrand
#### Test on Postman
<hr>
<br>
Part 6 - Views
 -Components  -login.vue

        PHP composer require laravel/ui:^3.2.1
        PHP artisan ui vue --auth
        npm install
        npm run dev
        npm install vue-loader@^15.9.8 --save-dev --legacy-peer-deps
        npm run dev

