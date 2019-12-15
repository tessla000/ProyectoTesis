<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Orden;
use App\Producto;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
	public function index()
	{
		$products = Producto::whereYear('created_at', '=', date('Y'))->get();
		$chart = Charts::database($products, 'bar', 'highcharts')
		->title("Product Details")
		->elementLabel("Total Products")
		->dimensions(1000, 500)
		->responsive(true)
		->groupByMonth(date('Y'), true);

		$pie_chart = Charts::create('pie', 'highcharts')
		->title('Pie Chart Demo')
		->labels(['Product 1', 'Product 2', 'Product 3'])
		->values([15,25,50])
		->dimensions(1000,500)
		->responsive(true);

		$area_chart = Charts::create('area', 'highcharts')
		->title('Area Chart')
		->elementLabel('Chart Labels')
		->labels(['First', 'Second', 'Third'])
		->values([28,52,64,86,99])
		->dimensions(1000,500)
		->responsive(true);

		return view('grafico.index',compact('chart', 'pie_chart', 'area_chart'));
	}
}
