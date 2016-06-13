<?php

$routes->get('/', function() {
    UtilController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login', function() {
    UtilController::login();
});

$routes->post('/login', function() {
    UtilController::handle_login();
});

$routes->get('/pokemon', function() {
    PokemonController::index();
});

$routes->post('/pokemon', function() {
    PokemonController::store();
});

$routes->get('/pokemon/new', function() {
    PokemonController::create();
});

$routes->get('/pokemon/:id', function($id) {
    PokemonController::show($id);
});

$routes->get('/pokemon/:id/edit', function($id) {
    PokemonController::edit($id);
});

$routes->post('/pokemon/:id/edit', function($id) {
    PokemonController::update($id);
});

$routes->post('/pokemon/:id/destroy', function($id) {
    PokemonController::destroy($id);
});

$routes->get('/pokemon/:id/add', function($id) {
    OwnedController::create($id);
});

$routes->post('/pokemon/:id/add', function($id) {
    OwnedController::store($id);
});

$routes->get('/owned', function() {
    OwnedController::index();
});

$routes->get('/owned/:id', function($id) {
    OwnedController::show($id);
});

$routes->get('/owned/:id/edit', function($id) {
    OwnedController::edit($id);
});

$routes->post('/owned/:id/edit', function($id) {
    OwnedController::update($id);
});

$routes->post('/owned/:id/destroy', function($id) {
    OwnedController::destroy($id);
});