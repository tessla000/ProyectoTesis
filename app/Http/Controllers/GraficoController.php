<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Orden;
use App\Producto;
use App\Transaccion;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraficoController extends Controller
{
	public function index()
	{
		$marca = Marca::where('usuario_id', Auth::id())->get('marca_id');
		$productos = Producto::whereYear('created_at', date('Y'))->whereIn('marca_id', $marca)->get();
		// dd($productos);

		$chart = Charts::database($productos, 'bar', 'highcharts')
		->title("Productos Añadidos Por Mes")
		->elementLabel("Cantidad Productos")
		->dimensions(1000, 500)
		->responsive(true)
		->groupByMonth(date('Y'), true);

		$marca = Marca::where('usuario_id', Auth::id())->get('marca_id');
		$producto = Producto::whereIn('marca_id', $marca)->get('producto_id');
		$orden = Orden::whereIn('producto_id', $producto)->get();
		$sum1 = $orden->sum('total');
		$sum2 = $orden->sum('quantity');
		// dd($sum2);

		$line_chart = Charts::create('line', 'highcharts')
		->title('Cantidad Productos Vendidos')
		->elementLabel('Vendidos')
		->labels(['Product 1', 'Product 2', 'Product 3', 'Product 4', 'Product 5', 'Product 6'])
		->values([15,25,50, 5,10,20])
		->dimensions(1000,500)
		->responsive(true);

		$areaspline_chart = Charts::multi('areaspline', 'highcharts')
		->title('Areaspline Chart Demo')
		->colors(['#ff0000', '#ffffff'])
		->labels(['Jan', 'Feb', 'Mar', 'Apl', 'May','Jun'])
		->dataset('Product 1', [10, 15, 20, 25, 30, 35])
		->dataset('Product 2',  [14, 19, 26, 32, 40, 50]);

		$area_chart = Charts::create('area', 'highcharts')
		->title('Area Chart')
		->elementLabel('Chart Labels')
		->labels(['First', 'Second', 'Third'])
		->values([28,52,64,86,99])
		->dimensions(1000,500)
		->responsive(true);

		return view('grafico.index',compact('chart', 'line_chart', 'areaspline_chart', 'area_chart','sum1', $sum1, 'sum2', $sum2));
	}
}
