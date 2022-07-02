<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';


use Github\Client;

$client = new Client();

$client = new \Github\Client();
$client->authenticate(TOKEN_GIT_USER, null, \Github\AuthMethod::ACCESS_TOKEN);
$repositories = $client->currentUser()->repositories(GIT_USER,'full_name','asc');
