@extends('layouts.app')
@section('title', 'Terra Nostra')
@section('content')
<div class="row justify-content-center">
    <section class="jumbotron text-center" id="backColor">
        <div class="container">
            <h1 class="jumbotron-heading">¿Buscas productos de origen natural?</h1>
            <img src="{{ asset('img/img01.jpg') }}" style="width: 55rem;">
            <p class="lead">
                Terra Nostra Chile te entrega un catálogo con una variedad de productos. Estos son elaborados por productores rurales y con bienes de su propia tierra. Adquiere alguno de los productos para fomentar una alimentación saludable y mejorar la economía de estas familias.
            </p>
            <p class="lead">
                Acercamos lo mejor del campo a tu mesa.
            </p>
        </div>
    </section>
</div>
@endsection
