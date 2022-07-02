<?php
require_once '../vendor/autoload.php';
require_once '../config.php';

// $repositories = $client->api('repo')->show(GIT_USER, trim($PostData['name']));
$repositories = $client->api('search')->repositories(trim($PostData['name']));

$jSON['ajax_response'] = "";
// foreach ($repositories as $key => $repository) :
    for ($i=0; $i < count($repositories) ; $i++):
    $jSON['ajax_response'] .= "
            <div class='d-flex text-muted pt-3 ajax_response'>
                <img class='rounded-circle' style='width: 5%; height: 100%; margin: 13px;' alt='{$repositories['items'][$i]['owner']['login']}' src='{$repositories['items'][$i]['owner']['avatar_url']}' data-holder-rendered='true'>
                <div class='pb-3 mb-0 small lh-sm border-bottom w-100'>
                    <div class='d-flex justify-content-between'>
                        <strong class='text-gray-dark'>@{$repositories['items'][$i]['name']} ({$repositories['items'][$i]['visibility']})</strong>
                        <a target='_blank' href=']{$repositories['items'][$i]['html_url']}'>Acessar</a>
                    </div>
                    <span class='d-block'>{$repositories['items'][$i]['name']} / {$repositories['items'][$i]['description']}</span>
                    <p class='mb-0 small lh-sm '>
                        Data Publicação: " . date('d/m/Y H:i:s', strtotime($repositories['items'][$i]['pushed_at'])) . "
                    </p>
                    <p class='mb-0 small lh-sm '>
                        Data Criação: " . date('d/m/Y H:i:s', strtotime($repositories['items'][$i]['created_at'])) . "
                    </p>
                    <p class='mb-0 small lh-sm'>
                        Data Atualização: " . date('d/m/Y H:i:s', strtotime($repositories['items'][$i]['updated_at'])) . "
                    </p>
                </div>
            </div>
            ";
     endfor;

if ($jSON) :
    echo json_encode($jSON);
else :
    $jSON['trigger'] = '<div class="alert alert-danger"><b>OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!</div>';
    echo json_encode($jSON);
endif;
