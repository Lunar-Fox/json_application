<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Start project

<p>1. Clone this repository</p>
<p>2. Run "composer update" for install dependencies</p>
<p>3. Run "cp .env.example .env"</p>
<p>4. Configure database in .env or <a href="https://github.com/Lunar-Fox/json_application/blob/master/config/database.php">/config/database.php</a></p>
<p>5. Run "php artisan migrate"</p>
<p>You can use php development server for run this project "php artisan serve"</p>
<br/>
<p>For testing API you can use <a href="https://curl.haxx.se/">CURL</a> or <a href="https://www.postman.com/downloads/">Postman</a></p>


## Routes
<p>POST /api/v1/document/ - create new document</p>
<p>GET /api/v1/document/{id} - get specified document</p>
<p>PATCH /api/v1/document/{id} - edit document</p>
<p>POST /api/v1/document/{id}/publish - publish document</p>
<p>GET /api/v1/document/?page=1&perPage=20 - get documents with pagination</p>

## Main files

<p><a href="https://github.com/Lunar-Fox/json_application/blob/master/app/Http/Controllers/DocumentsController.php">Documents Controller</a></p>
<p><a href="https://github.com/Lunar-Fox/json_application/blob/master/app/Document.php">Documents Model</a></p>
<p><a href="https://github.com/Lunar-Fox/json_application/blob/master/database/migrations/2020_08_25_142947_create_documents_table.php">Documents migration</a></p>