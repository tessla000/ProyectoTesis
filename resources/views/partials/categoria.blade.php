<div class="list-group">
	<button data-toggle="collapse" data-target="#collapse1"  type="button" class="list-group-item list-group-item-action active">Categorias</button>
	@foreach($categoriaC as $categoria)
	<a id="collapse1" href="{{ route('producto.index', ['categoria' => $categoria]) }}" class="list-group-item list-group-item-action collapse show">{{$categoria->name}}</a>
	@endforeach
</div>
{{-- <nav class="nav flex-column">
	<a class="nav-link disabled" href="#">Categorias</a>
	@foreach($categoriaC as $categoria)
	<a class="nav-link" href="{{ route('producto.index', ['categoria' => $categoria->categoria_id]) }}">{{$categoria->name}}</a>
	@endforeach
</nav> --}}