<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Orden;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lava;

class GraficoController extends Controller
{
	// public function index()
	// {
	// 	// $lava = new Lavacharts;
	// 	// $population = $lava->DataTable();
	// 	$marca = Marca::where('usuario_id', Auth::id())->get();
	// 	$producto = Producto::whereIn('marca_id', $marca)->get();
	// 	$population = Lava::DataTable();
	// 	$population->addDateColumn('Year')
	// 	->addNumberColumn('Number of People')
	// 	->addRow(['2006', 623452])
	// 	->addRow(['2007', 685034])
	// 	->addRow(['2008', 716845])
	// 	->addRow(['2009', 757254])
	// 	->addRow(['2010', 778034])
	// 	->addRow(['2011', 792353])
	// 	->addRow(['2012', 839657])
	// 	->addRow(['2013', 842367])
	// 	->addRow(['2014', 873490]);

	// 	// $lava->AreaChart('Population', $population, [
	// 	Lava::AreaChart('Population', $population, [
	// 		'title' => 'Population Growth',
	// 		'legend' => [
	// 			'position' => 'in'
	// 		]
	// 	]);
	// 	// return view('chart', ['varb' => $lava]);
	// 	return view('grafico.index');
	// }

	// public function index()
	// {
	// 	$finances  = Lava::DataTable();
	// 	$finances ->addDateColumn('Year')
	// 	->addNumberColumn('Ganancias')
	// 	->setDateTimeFormat('Y')
	// 	->addRow(['2004', 1000])
	// 	->addRow(['2005', 1170])
	// 	->addRow(['2006', 660])
	// 	->addRow(['2007', 1030]);
	// 	Lava::ColumnChart('Finances', $finances , [
	// 		'title' => 'Company Performance',
	// 		'titleTextStyle' => [
	// 			'color'    => '#eb6b2c',
	// 			'fontSize' => 14
	// 		]
	// 	]);
	// 	return view('grafico.index');
	// }

	public function index()
	{
		$marca = Marca::where('usuario_id', Auth::id())->get();
		$producto = Producto::whereIn('marca_id', $marca)->get();
		$orden = Orden::where('producto_id', $producto)->get();
		$ventas = Lava::DataTable();
		$ventas->addDateColumn('Date')
		->addNumberColumn('Ventas')
		->addRow(['2014-10-1',  67])
		->addRow(['2014-10-2',  68])
		->addRow(['2014-10-3',  68])
		->addRow(['2014-10-4',  72])
		->addRow(['2014-10-5',  61])
		->addRow(['2014-10-6',  70])
		->addRow(['2014-10-7',  74])
		->addRow(['2014-10-8',  75])
		->addRow(['2014-10-9',  69])
		->addRow(['2014-10-10', 64])
		->addRow(['2014-10-11', 59])
		->addRow(['2014-10-12', 65])
		->addRow(['2014-10-13', 66])
		->addRow(['2014-10-14', 75])
		->addRow(['2014-10-15', 76])
		->addRow(['2014-10-16', 71])
		->addRow(['2014-10-17', 72])
		->addRow(['2014-10-18', 63]);
		Lava::LineChart('Temps', $ventas, [
			'title' => 'Weather in October'
		]);
		return view('grafico.index');
	}
}
