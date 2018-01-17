@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Editar link</h3>
		
		{{-- exibe os erros se exitirem --}}
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div> 			 
		@endif
		{{-- exibe os erros se exitirem --}}

		<form action="/atualizar/{{ $link->id }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<input type="text" name="descricao" placeholder="Descrição" class="form-control" value="{{ $link->descricao }}">
			</div>

			<div class="form-group">
				<input type="text" name="url" placeholder="URL" class="form-control" value="{{ $link->url }}">
			</div>

			<div class="form-group">
				@if(count($categorias) > 0)	<!-- se existem categorias -->
					<label for="categoria">Selecione a categoria</label>
					<select name="categoria" class="form-control">
						@foreach($categorias as $categoria)	<!-- percorrendo todos as categorias -->
							<option value="{{ $categoria->id }}" {{ $link->categoria_id == $categoria->id ? 'selected="selected"' : '' }}>{{ $categoria->titulo }}</option>
							{{-- exibindo as categorias e verificando se é a categoria selecionada --}}
						@endforeach
						<option value="nova">Nova categoria</option>
					</select>
				@else 	{{-- sem categorias --}}
					<input type="text" name="categoriaNova" placeholder="Categoria" class="form-control">	
				@endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Editar url</button>
			</div>
		</form>	
	</div>

	<script>
		$(document).ready(function(){
			$("select[name=categoria]").change(function(){	//quando o select da categoria muda	
				var selectVal = this.value;	//recebendo o valor do select
				if(selectVal == "nova"){
					$(this).parent().html("<input type=\"text\" name=\"categoriaNova\" placeholder=\"Categoria\" class=\"form-control\" autofocus=\"autofocus\">");
				}
			});
		});
	</script>

@endsection