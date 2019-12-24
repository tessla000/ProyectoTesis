<div class="list-group">
	<button data-toggle="collapse" data-target="#collapse2" type="button" class="list-group-item list-group-item-action active">Tus Productos Favoritos De Los Usuarios</button>
	<div class="card-columns no-gutters rounded-0">
		@foreach($proFav as $producto)
		<div class="card rounded-0 border-0 bg-light" style="width: 18rem;">
			<a href="{{ route('producto.show', $producto) }}">
				<img class="card-img-top img-fluid"  src="{{ asset('storage/' . $producto->image) }}" alt="Card image cap">
			</a>
			<div class="card-body">
				<h5 class="card-title">{{$producto->name}}</h5>
				<p class="card-text">{{ $producto->favoritesCount }} Likes</p>
			</div>
		</div>
		@endforeach
	</div>
</div>