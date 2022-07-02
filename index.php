<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="css/offcanvas.css" rel="stylesheet">
	<title>Api Graph Github - Person</title>

</head>

<body>

	<body class="bg-light">

		<div class="ajax_load">
			<div class="ajax_load_box">
				<div class="ajax_load_box_circle"></div>
				<div class="ajax_load_box_title">Aguarde, carrengando...</div>
			</div>
		</div>

		<?php
		include 'github.php';
		?>
		<main class="container">

			<div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm" style="background-color: #6f42c1;">
				<img class="me-3 rounded-circle" src="<?= $repositories[0]['owner']['avatar_url'] ?>" alt="" width="48" height="48">
				<div class="lh-1">
					<h1 class="h6 mb-0 text-white lh-1"><?= $repositories[0]['owner']['login'] ?></h1>
					<small><a class="text-white" href="<?= $repositories[0]['owner']['html_url'] ?>"><?= $repositories[0]['owner']['html_url'] ?></a></small>
				</div>
			</div>

			<div class="alert alert-info">Limitei as lista para apenas o meu repositório para que os filtros ficassem com a visaualização menor, enquanto a pesquina por nome do repositório esta buscando no GitHub geral.</div>

			<div class="row">
				<div class="col-6">
					<form class="form-control p-3" name="visibility" action="searches/visibility.php" method="post" enctype="multipart/form-data">
						<label for="" class="form-label">Visualização: </label>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="visibility" id="public" value="public">
							<label class="form-check-label" for="inlineRadio1">Públicos</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="visibility" id="private" value="private">
							<label class="form-check-label" for="inlineRadio2">Privados</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="visibility" id="archive" value="archive">
							<label class="form-check-label" for="inlineRadio2">Arquivados</label>
						</div>
					</form>
				</div>
				<div class="col-6">
					<form class="form-control p-3" name="direction" action="searches/direction.php" method="post" enctype="multipart/form-data">
						<label for="" class="form-label">Ordenação: </label>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="direction" id="asc" value="asc">
							<label class="form-check-label" for="inlineRadio1">A - Z</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="direction" id="desc" value="desc">
							<label class="form-check-label" for="inlineRadio2">Z - A</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="direction" id="commit" value="commit">
							<label class="form-check-label" for="inlineRadio2">Últmo commit</label>
						</div>
					</form>
				</div>

				<div class="col-12 mt-3">
					<form class="form-control p-3" name="search" action="searches/name.php" method="post" enctype="multipart/form-data">
						<div class="col-12">
							<label for="" class="form-label">Nome Repositório</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="name" placeholder="Nome do Repositório" aria-label="Nome do Repositório" aria-describedby="button-addon2">
								<button class="btn btn-outline-primary" type="submit" id="button-addon2">Pesquisar</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="ajax_trigger mt-3"></div>


			<div class="my-3 p-3 bg-body rounded shadow-sm">
				<h6 class="border-bottom pb-2 mb-0">Lista de Repositorios</h6>
				<div class="ajax_response">
					<?php
					foreach ($repositories as $repository) :
						// var_dump($repository['owner']);
						$visibility = $repository['archived'] ? 'archived' : $repository['visibility'];
					?>
						<div class="d-flex text-muted pt-3 ">
							<img class='rounded-circle' style='width: 5%; height: 100%; margin: 13px;' alt='<?=$repository['owner']['login']?>' src='<?=$repository['owner']['avatar_url']?>' data-holder-rendered='true'>

							<div class="pb-3 mb-0 small lh-sm border-bottom w-100">
								<div class="d-flex justify-content-between">
									<strong class="text-gray-dark">@<?= $repository['name'] ?> (<?= $visibility ?>)</strong>
									<a target="_blank" href="<?= $repository['html_url'] ?>">Acessar</a>
								</div>
								<span class="d-block"><?= $repository['name'] ?> / <?= $repository['description'] ?></span>
								<p class="mb-0 small lh-sm ">
									Data Publicação: <?= date('d/m/Y H:i:s', strtotime($repository['pushed_at'])) ?>
								</p>
								<p class="mb-0 small lh-sm ">
									Data Criação: <?= date('d/m/Y H:i:s', strtotime($repository['created_at'])) ?>
								</p>
								<p class="mb-0 small lh-sm">
									Data Atualização: <?= date('d/m/Y H:i:s', strtotime($repository['updated_at'])) ?>
								</p>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>

		</main>


		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
		<script src="js/app.js"></script>

</html>
