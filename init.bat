@echo off
REM === Crea la struttura del progetto Delibread ===

REM Controllers - Retailer
mkdir delibread\app\controllers\Retailer
type nul > delibread\app\controllers\Retailer\DashboardController.php
type nul > delibread\app\controllers\Retailer\ProductController.php
type nul > delibread\app\controllers\Retailer\OrderController.php
type nul > delibread\app\controllers\Retailer\RecurringOrderController.php

REM Controllers - Core
mkdir delibread\app\controllers
type nul > delibread\app\controllers\NotificationController.php
type nul > delibread\app\controllers\UserController.php

REM Core
mkdir delibread\app\core
for %%F in (Autoloader Auth Controller Database Model Request Response Router Session) do (
    type nul > delibread\app\core\%%F.php
)

REM Helpers
mkdir delibread\app\helpers
type nul > delibread\app\helpers\ValidationHelper.php
type nul > delibread\app\helpers\UtilHelper.php

REM Models
mkdir delibread\app\models
for %%F in (Bakery Catalog Notification Order OrderItem Product ProductType RecurringOrder Retailer Role User) do (
    type nul > delibread\app\models\%%F.php
)

REM Views - auth
mkdir delibread\app\views\auth
type nul > delibread\app\views\auth\login.php
type nul > delibread\app\views\auth\register.php

REM Views - bakery
mkdir delibread\app\views\bakery\products
mkdir delibread\app\views\bakery\catalogs
mkdir delibread\app\views\bakery\orders
mkdir delibread\app\views\bakery\deliveries
type nul > delibread\app\views\bakery\dashboard.php
type nul > delibread\app\views\bakery\kpi_dashboard.php
type nul > delibread\app\views\bakery\products\index.php
type nul > delibread\app\views\bakery\products\form.php
type nul > delibread\app\views\bakery\catalogs\index.php
type nul > delibread\app\views\bakery\catalogs\form.php
type nul > delibread\app\views\bakery\orders\index.php
type nul > delibread\app\views\bakery\orders\show.php
type nul > delibread\app\views\bakery\deliveries\calendar.php
type nul > delibread\app\views\bakery\deliveries\tour_form.php

REM Views - retailer
mkdir delibread\app\views\retailer\products
mkdir delibread\app\views\retailer\orders
mkdir delibread\app\views\retailer\recurring_orders
type nul > delibread\app\views\retailer\dashboard.php
type nul > delibread\app\views\retailer\products\index.php
type nul > delibread\app\views\retailer\orders\index.php
type nul > delibread\app\views\retailer\orders\create.php
type nul > delibread\app\views\retailer\orders\show.php
type nul > delibread\app\views\retailer\recurring_orders\index.php
type nul > delibread\app\views\retailer\recurring_orders\form.php

REM Views - notifications
mkdir delibread\app\views\notifications
type nul > delibread\app\views\notifications\index.php

REM Views - partials
mkdir delibread\app\views\partials
for %%F in (header footer navbar sidebar_bakery sidebar_retailer) do (
    type nul > delibread\app\views\partials\%%F.php
)

REM Views - errors
mkdir delibread\app\views\errors
for %%F in (403 404 500) do (
    type nul > delibread\app\views\errors\%%F.php
)

REM Public assets
mkdir delibread\public\assets\css
mkdir delibread\public\assets\js
type nul > delibread\public\assets\css\style.css
type nul > delibread\public\assets\js\app.js
type nul > delibread\public\assets\js\form_validation.js

REM Public
type nul > delibread\public\.htaccess
type nul > delibread\public\index.php

REM Database
mkdir delibread\database
type nul > delibread\database\schema.sql

REM Composer
type nul > delibread\composer.json

echo Tutti i file e le cartelle sono stati creati con successo!
pause
