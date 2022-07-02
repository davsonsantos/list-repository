<?php

define('TOKEN_GIT_USER', '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');
define('GIT_USER', 'davsonsantos');

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

use Github\Client;

$client = new Client();

$client = new \Github\Client();
$client->authenticate(TOKEN_GIT_USER, null, \Github\AuthMethod::ACCESS_TOKEN);

$jSON['ajax_response'] = "";


