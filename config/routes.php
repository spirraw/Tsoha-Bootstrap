<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
    $routes->get('/owned', function() {
    HelloWorldController::owned_list();
  });
  
    $routes->get('/owned/pokemon', function() {
    HelloWorldController::owned_pokemon();
  });
  
    $routes->get('/owned/edit', function() {
    HelloWorldController::owned_edit();
  });