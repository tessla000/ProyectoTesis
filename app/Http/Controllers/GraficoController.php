<?php

namespace App\Http\Controllers;

use App\Favorito;
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
		$proCount = $productos->count();

		$chart = Charts::database($productos, 'bar', 'highcharts')
		->title("Productos Añadidos Por Mes")
		->elementLabel("Cantidad Productos")
		->dimensions(1000, 500)
		->responsive(true)
		->groupByMonth(date('Y'), true);

		$marca = Marca::where('usuario_id', Auth::id())->get('marca_id');
		$producto = Producto::whereIn('marca_id', $marca)->get();
		$pro_id = $producto->map->only(['producto_id']);
		$pro_name = $producto->map->only(['name']);
		$transaccion = Transaccion::where('responseCode', 0)->get();
		$trans = $transaccion->map->only(['transaccion_id']);
		$orden = Orden::whereIn('producto_id', $pro_id)->whereIn('transaccion_id', $trans)->get();
		$sum1 = $orden->sum('total');
		$sum2 = $orden->sum('quantity');
		$name = $producto->pluck('name');
		$orden2 = Orden::whereIn('producto_id', $pro_id)->groupBy('producto_id')->selectRaw('sum(quantity) as sum')->get();
		$val = $orden2->pluck('sum');

		$line_chart = Charts::create('line', 'highcharts')
		->title('Unidades Vendidas')
		->elementLabel('Cantidad')
		->labels($name->all())
		->values($val->all())
		->dimensions(1000,500)
		->responsive(true);

		$area_chart = Charts::create('area', 'highcharts')
		->title('Unidades Vendidas')
		->elementLabel('Cantidad')
		->labels($name->all())
		->values($val->all())
		->dimensions(1000,500)
		->responsive(true);

		$favoritos = Favorito::whereIn('favoriteable_id', $pro_id)->get('favoriteable_id');
		$favName = $favoritos->map->only(['favoriteable_id']);
		$proFav = Producto::whereIn('producto_id', $favName)->get();
		// dd($proFav);

		return view('grafico.index',compact('chart', 'area_chart', 'sum1', $sum1, 'sum2', $sum2, 'proCount', $proCount, 'proFav', $proFav));
	}
}
