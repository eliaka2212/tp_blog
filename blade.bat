@echo off
IF "%1"=="" (
    echo Usage: .\blade <view_name>
    echo Exemple: .\blade articles.index
    echo Creates a new Blade view using: php artisan make:view
    exit /b
)
php artisan make:view %*
