@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<div class="row justify-content-center">
	<section class="contact-section my-5">
		<div class="card">
			<div class="row">
				<div class="col-lg-8">
					<div class="card-body form">
						<form method ="POST" action="{{route('messages.store')}}">
							@csrf
							<h3 class="mt-4"><i class="fas fa-envelope pr-2"></i>Escribenos:</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="md-form mb-0">
										<input type="text" id="form-contact-name" class="form-control" name="nombre" value="{{old('nombre')}}">
										{!! $errors->first('nombre', '<small>:message</small><br>')!!}
										<label for="form-contact-name" class="">Tu nombre</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="md-form mb-0">
										<input type="text" id="form-contact-email" class="form-control" name="email" value="{{old('email')}}">
										{!! $errors->first('email', '<small>:message</small><br>')!!}
										<label for="form-contact-email" class="">Tu email</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="md-form mb-0">
										<input type="text" id="form-contact-phone" class="form-control" name="telefono" value="{{old('telefono')}}">
										{!! $errors->first('telefono', '<small>:message</small><br>')!!}
										<label for="form-contact-phone" class="">Tu número de teléfono</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="md-form mb-0">
										<input type="text" id="form-contact-company" class="form-control" name="asunto" value="{{old('asunto')}}">
										{!! $errors->first('asunto', '<small>:message</small><br>')!!}
										<label for="form-contact-company" class="">Tu asunto</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="md-form mb-0">
										<textarea id="form-contact-message" class="form-control md-textarea" rows="3" name="mensaje">{{old('mensaje')}}</textarea>
										{!! $errors->first('mensaje', '<small>:message</small><br>')!!}
										<label for="form-contact-message">Tu mensaje</label>
										<a class="btn-floating btn-lg blue">
											<i class="far fa-paper-plane"></i>
										</a>
									</div>
								</div>
							</div>
							<button>Enviar</button>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card-body contact text-center h-100 white-text">
						<h3 class="my-4 pb-2">Información de contacto</h3>
						<ul class="text-lg-left list-unstyled ml-4">
							<li>
								<p><i class="fas fa-map-marker-alt pr-2"></i>La Montaña, 0, Teno</p>
							</li>
							<li>
								<p><i class="fas fa-phone pr-2"></i>+ 01 234 567 89</p>
							</li>
							<li>
								<p><i class="fas fa-envelope pr-2"></i>contact@example.com</p>
							</li>
						</ul>
						<hr class="hr-light my-4">
						<ul class="list-inline text-center list-unstyled">
							<li class="list-inline-item">
								<a class="p-2 fa-lg tw-ic">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a class="p-2 fa-lg li-ic">
									<i class="fab fa-linkedin-in"> </i>
								</a>
							</li>
							<li class="list-inline-item">
								<a class="p-2 fa-lg ins-ic">
									<i class="fab fa-instagram"> </i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection