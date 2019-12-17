@extends('layouts.app')
@section('content')
<div class="panel-body">
	<div class="row">
		<div class="col-md-6">
			{!! $chart->html() !!}
			<div>
				<p><span>Han sido vendidos un total de {{ $sum2 }} productos, obteniendo una ganancia de ${{ $sum1 }}</span></p>
			</div>
		</div>
		<br/><br/>
		<div class="col-md-6">
			{!! $line_chart->html() !!}
		</div>
		<br/><br/>
		<div class="col-md-6">
			{!! $areaspline_chart->html() !!}
		</div>
		<br/><br/>
		<div class="col-md-6">
			{!! $area_chart->html() !!}
		</div>
	</div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $line_chart->script() !!}
{!! $areaspline_chart->script() !!}
{!! $area_chart->script() !!}
@endsection