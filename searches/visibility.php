<?php
require_once '../vendor/autoload.php';
require_once '../config.php';


if ($PostData['visibility'] == 'archive'):
    $repositories = $client->currentUser()->repositories(GIT_USER, 'full_name', 'asc', $PostData['visibility']);
    foreach ($repositories as $repository) :
        if ($repository['archived'] === true) :
            $jSON['ajax_response'] .= "
            <div class='d-flex text-muted pt-3 ajax_response'>
            <img class='rounded-circle' style='width: 5%; height: 100%; margin: 13px;' alt='{$repository['owner']['login']}' src='{$repository['owner']['avatar_url']}' data-holder-rendered='true'>

                <div class='pb-3 mb-0 small lh-sm border-bottom w-100'>
                    <div class='d-flex justify-content-between'>
                        <strong class='text-gray-dark'>@{$repository['name']} (archived)</strong>
                        <a target='_blank' href=']{$repository['html_url']}'>Acessar</a>
                    </div>
                    <span class='d-block'>{$repository['name']} / {$repository['description']}</span>
                    <p class='mb-0 small lh-sm '>
                        Data Publicação: " . date('d/m/Y H:i:s', strtotime($repository['pushed_at'])) . "
                    </p>
                    <p class='mb-0 small lh-sm '>
                        Data Criação: " . date('d/m/Y H:i:s', strtotime($repository['created_at'])) . "
                    </p>
                    <p class='mb-0 small lh-sm'>
                        Data Atualização: " . date('d/m/Y H:i:s', strtotime($repository['updated_at'])) . "
                    </p>
                </div>
            </div>
            ";
        endif;
    endforeach;
else:
    $repositories = $client->currentUser()->repositories(GIT_USER, 'full_name', 'asc', $PostData['visibility']);
    $jSON['ajax_response'] = "";
    foreach ($repositories as $repository) :
            $jSON['ajax_response'] .= "
            <div class='d-flex text-muted pt-3 ajax_response'>
            <img class='rounded-circle' style='width: 5%; height: 100%; margin: 13px;' alt='{$repository['owner']['login']}' src='{$repository['owner']['avatar_url']}' data-holder-rendered='true'>

                <div class='pb-3 mb-0 small lh-sm border-bottom w-100'>
                    <div class='d-flex justify-content-between'>
                        <strong class='text-gray-dark'>@{$repository['name']} ({$repository['visibility']})</strong>
                        <a target='_blank' href=']{$repository['html_url']}'>Acessar</a>
                    </div>
                    <span class='d-block'>{$repository['name']} / {$repository['description']}</span>
                    <p class='mb-0 small lh-sm '>
                        Data Publicação: " . date('d/m/Y H:i:s', strtotime($repository['pushed_at'])) . "
                    </p>
                    <p class='mb-0 small lh-sm '>
                        Data Criação: " . date('d/m/Y H:i:s', strtotime($repository['created_at'])) . "
                    </p>
                    <p class='mb-0 small lh-sm'>
                        Data Atualização: " . date('d/m/Y H:i:s', strtotime($repository['updated_at'])) . "
                    </p>
                </div>
            </div>
            ";
    endforeach;
endif;


if ($jSON) :
    echo json_encode($jSON);
else :
    $jSON['trigger'] = '<div class="alert alert-danger"><b>OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!</div>';
    echo json_encode($jSON);
endif;
