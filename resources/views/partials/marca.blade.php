<div class="list-group">
	<button data-toggle="collapse" data-target="#collapse2" type="button" class="list-group-item list-group-item-action active">Marcas</button>
	@foreach($marcaM as $marca)
	<a id="collapse2" href="{{ route('producto.index', ['marca' => $marca]) }}" class="list-group-item list-group-item-action collapse show">{{$marca->name}}</a>
	@endforeach
</div>
{{-- <nav class="nav flex-column">
	<a class="nav-link disabled" href="#">Marcas</a>
	@foreach($marcaM as $marca)
	<a class="nav-link" href="{{ route('producto.index', ['marca' => $marca->marca_id]) }}">{{$marca->name}}</a>
	@endforeach
</nav> --}}