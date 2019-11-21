<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Transaccion;
use Cart;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\WebpayNormal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

@include 'vendor/autoload.php';

class CheckoutController extends Controller
{
	public function initTransaction(WebpayNormal $webpayNormal)
	{
		$bag = CertificationBagFactory::integrationWebpayNormal();
		$webpayNormal = TransbankServiceFactory::normal($bag);
		$amount = Cart::getSubTotal();
		$buyOrder = 'order-' . rand(1000, 9999);
		$webpayNormal->addTransactionDetail($amount, $buyOrder);
		$response = $webpayNormal->initTransaction(route('response'), route('finish'));
		// Probablemente también quieras crear una orden o transacción en tu base de datos y guardar el token ahí.
		return RedirectorHelper::redirectHTML($response->url, $response->token);
	}

	public function response(WebpayNormal $webpayNormal)
	{
		$bag = CertificationBagFactory::integrationWebpayNormal();
		$webpayNormal = TransbankServiceFactory::normal($bag);
		$result = $webpayNormal->getTransactionResult();
		session(['response' => $result]);
		$webpayNormal->acknowledgeTransaction();
	  // Revisar si la transacción fue exitosa ($result->detailOutput->responseCode === 0) o fallida para guardar ese resultado en tu base de datos.
		if ($result->detailOutput->responseCode === 0) {
			Transaccion::create([
				'amount' => $result->detailOutput->amount,
				'buyOrder' => $result->detailOutput->buyOrder,
				'commerceCode' => $result->detailOutput->commerceCode,
				'authorizationCode' => $result->detailOutput->authorizationCode,
				'resultado' => $result->detailOutput->responseCode,
				'detalle' => Cart::getContent(),
				'userId' => Auth::id(),
			]);
			foreach (Cart::getContent() as $item) {
				$cart = $item->quantity;
				$producto = Producto::find($item->id);
				$stock = $producto->stock - $cart;
				$producto->stock = $stock;
				$producto->save();
			}
			request()->session()->flash('message', 'Compra Realizada!');
			Cart::clear();
		}else{
			Transaccion::create([
				'amount' => $result->detailOutput->amount,
				'buyOrder' => $result->detailOutput->buyOrder,
				'commerceCode' => $result->detailOutput->commerceCode,
				'authorizationCode' => $result->detailOutput->authorizationCode,
				'resultado' => $result->detailOutput->responseCode,
				'detalle' => Cart::getContent(),
				'userId' => Auth::id(),
			]);
			request()->session()->flash('message', 'Compra Rechazada!');
		}
		return RedirectorHelper::redirectBackNormal($result->urlRedirection);
	}

	public function finish()
	{
		dd($_POST, session('response'));
	  // Acá buscar la transacción en tu base de datos y ver si fue exitosa o fallida, para mostrar el mensaje de gracias o de error según corresponda
	}
}
