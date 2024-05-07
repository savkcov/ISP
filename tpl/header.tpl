<!DOCTYPE html>
<html lang="ru">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $this->page_title; ?> - <?php echo SiteName; ?></title>
		<link href="/src/css/libs/bootstrap.min.css?t=<? echo time(); ?>" rel="stylesheet" type="text/css" />
		<!--<link href="/src/css/style.css?t=<? echo time(); ?>" rel="stylesheet" type="text/css" />-->
		
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand mt-2 mt-lg-0" href="/">
					<h5 class="pt-1">ISM</h5>
				</a>
				<div class="collapse navbar-collapse">
					<h6 class="pt-1 text-white">Транзакции пользователей</h6>
				</div>
			</div>
		</nav>
		<main class="container-fluid mt-5">
