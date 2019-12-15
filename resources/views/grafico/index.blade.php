@extends('layouts.app')
@section('content')
<div class="panel-body">
	<div class="row">
		<div class="col-md-6">
			{!! $chart->html() !!}
		</div>
		<br/><br/>
		<div class="col-md-6">
			{!! $pie_chart->html() !!}
		</div>

		<div class="col-md-6">
			{!! $area_chart->html() !!}
		</div>
		<br/><br/>
	</div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $pie_chart->script() !!}
{!! $area_chart->script() !!}
@endsection