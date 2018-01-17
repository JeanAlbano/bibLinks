<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Biblioteca de links</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- utilizando o framework front-end bootstrap -->
		
		<link rel="stylesheet" type="text/css" href="{{ url('/css/estilo.css') }}">
		<!-- css customizado -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		{{-- jquery --}}
	</head>
	<body>
		<div class="row">

			@yield('content')
			<!-- onde a view será exibida -->
			
		</div>
	</body>
</html>