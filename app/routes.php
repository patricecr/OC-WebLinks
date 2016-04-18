<?php

// Home page
$app->get('/', "WebLinks\Controller\HomeController::indexAction")->bind('home');

// Login form
$app->get('/login', "WebLinks\Controller\HomeController::loginAction")->bind('login');