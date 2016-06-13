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

$routes->get('/owned', function() {
    HelloWorldController::owned_list();
});

$routes->get('/owned/pokemon', function() {
    HelloWorldController::owned_pokemon();
});

$routes->get('/owned/edit', function() {
    HelloWorldController::owned_edit();
});
