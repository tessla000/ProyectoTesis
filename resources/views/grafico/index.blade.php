@extends('layouts.app')
@section('content')
<div class="panel-body">
	<div class="row">
		<div class="col-md-6">
			{!! $chart->html() !!}
			<button class="float-right" onclick="myFunction1()">Información</button>
			<div id="myDIV1" style="display: none;">
				<p><span>Has ingresado {{ $proCount }} tipos de productos distintos</span></p>
			</div>
		</div>
		<br><br>
{{-- 		<div class="col-md-6">
			{!! $line_chart->html() !!}
			<button class="float-right" onclick="myFunction2()">Información</button>
			<div id="myDIV2" style="display: none;">
				<p><span>Han sido vendidos un total de {{ $sum2 }} productos, obteniendo una ganancia de ${{ $sum1 }}</span></p>
			</div>
		</div>
		<br><br> --}}
		<div class="col-md-6">
			{!! $area_chart->html() !!}
			<button class="float-right" onclick="myFunction3()">Información</button>
			<div id="myDIV3" style="display: none;">
				<p><span>Han sido vendidos un total de {{ $sum2 }} productos, obteniendo una ganancia de ${{ $sum1 }}</span></p>
			</div>
		</div>
		<br><br>
	</div>
	<hr>
	<button class="float-none" onclick="myFunction4()">Información</button>
	<div class="row">
		<div id="myDIV4" style="display: none;" class="col">
			@include('partials.producto')
		</div>
	</div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{{-- {!! $line_chart->script() !!} --}}
{!! $area_chart->script() !!}
@endsection