<div class="list-group">
	<button id="divCategoria" data-toggle="collapse" data-target="#collapse1"  type="button" class="list-group-item list-group-item-action active">Categorias</button>
	@foreach($categoriaC as $categoria)
	<a id="collapse1" href="{{ route('producto.index', ['categoria' => $categoria]) }}" class="list-group-item list-group-item-action collapse show">{{$categoria->name}}</a>
	@endforeach
</div>