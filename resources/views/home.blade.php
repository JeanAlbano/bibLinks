@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h1>Links</h1>
		
				<!-- link para adicionar link -->
				<a class="button" href="{{ route('criarLink') }}">Adicionar link</a>
			</div>
			<div class="col-md-3">
				{{-- mostrar por categoria --}}
				@if(count($categorias) > 0)	<!-- se existirem categorias -->

					<div class="form-group">
						<select name="categoria" class="form-control">
							<option value="selecionar" selected disabled>Visualizar por categoria</option>
							@foreach($categorias as $categoria)	<!-- percorrendo todos as categorias -->
								<option value="{{ $categoria->id }}">{{ $categoria->titulo }}</option>
							@endforeach
						</select>
					</div>
					
					{{-- exemplo para acessar o link pela categoria --}}
					{{-- @foreach($categorias as $categoria) --}}
						{{-- @foreach(App\Categoria::find($categoria->id)->link as $r) --}}
							{{-- <p>{{ $r->descricao }}</p>
						@endforeach
					@endforeach --}}
				@endif
			</div>
		</div>
		<hr>

		@if(count($links) > 0)	<!-- se existem links -->
			
			<!-- lógica para ter no máximo 4 colunas por linha -->
			<?php
				$i = 1;
			?>

			<div id="links">
				<div class="row text-center">
					@foreach($links as $link)	<!-- percorrendo todos os links -->

						<div class="col-md-3">
							{{-- botão para deletar link --}}
							<a href="{{ route('deletarLink', ['id' => $link->id]) }}" class="btn btn-danger deletaLink" title="Deletar link">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
							
							{{-- botão para editar link --}}
							<a href="{{ route('editarLink', ['id' => $link->id]) }}" class="btn btn-primary editaLink" title="Editar link">
								<span class="glyphicon glyphicon-edit"></span>
							</a>

							<a href="{{ $link->url }}" target="_blank">
								{{ $link->descricao }}	
							</a>
							
							{{-- <p>{{ App\Link::find($link->id)->categoria->titulo }}</p> --}}	{{-- Exemplo para acessar a categoria pelo link --}}

							@if($i % 4 == 0)	<!-- se atingiu o limite de colunas por linha (4) -->	
						</div>	{{-- fecha a div coluna --}}
				</div>	{{-- fecha a div linha --}}
				<hr>
				<div class="row text-center">	<!-- adiciona uma nova div linha -->
							@else	
								</div>	<!-- fecha a div coluna -->
							@endif
						<?php $i++; ?>	

					@endforeach		
				</div>
			</div>

		@else	<!-- sem links -->	
			<p>Sem links para exibir</p>
		@endif
	</div>
	
	<script>
		$(document).ready(function(){
			$("select[name=categoria]").change(function(){	//quando o select da categoria muda	
				var selectVal = this.value;	//recebendo o valor do select
				window.location.href = "/" + selectVal;				
			});
		});
	</script>
@endsection