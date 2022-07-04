<?php

define('TOKEN_GIT_USER', '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');
define('GIT_USER', 'davsonsantos');


use Github\Client;

$client = new Client();

$client = new \Github\Client();
$client->authenticate(TOKEN_GIT_USER, null, \Github\AuthMethod::ACCESS_TOKEN);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$jSON['ajax_response'] = "";