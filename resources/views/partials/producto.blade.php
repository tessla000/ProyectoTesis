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
				<p class="card-text">{{ $producto->descripcion }}</p>
				<p class="card-text">{{ $producto->favoritesCount }} Likes</p>
				<p class="card-text"><small class="text-muted">${{ $producto->valor }}</small></p>
			</div>
			@auth
			@if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
			<div class="card-footer">
				<div class="btn-group" role="group" aria-label="Basic example">
					<a href="{{ route('producto.edit', ['producto' => $producto]) }}">
						<button type="button" class="btn btn-warning">Edit</button>
					</a>
				</div>
			</div>
			@endif
			@endauth
		</div>
		@endforeach
	</div>
</div>