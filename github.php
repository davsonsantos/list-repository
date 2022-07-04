<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

$repositories = $client->currentUser()->repositories(GIT_USER,'full_name','asc');
