<?php

namespace App\Http\Controllers;

use App\Transaccion;
use Cart;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\WebpayNormal;
use Freshwork\Transbank\WebpayPatPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
	public function initTransaction(WebpayNormal $webpayNormal)
	{
		$amount = Cart::getSubTotal();
		$buyOrder = 'order-' . rand(1000, 9999);
		$webpayNormal->addTransactionDetail($amount, $buyOrder);
		$response = $webpayNormal->initTransaction(route('checkout.webpay.response'), route('checkout.webpay.finish'));
		// Probablemente también quieras crear una orden o transacción en tu base de datos y guardar el token ahí.
		return RedirectorHelper::redirectHTML($response->url, $response->token);
	}

	public function response(WebpayPatPass $webpayPatPass)
	{
		$result = $webpayPatPass->getTransactionResult();
		session(['response' => $result]);
	  // Revisar si la transacción fue exitosa ($result->detailOutput->responseCode === 0) o fallida para guardar ese resultado en tu base de datos.
		if ($result->detailOutput->responseCode == 0) {
			Transaccion::create([
				'amount' => $result->detailOutput->amount,
				'buyOrder' => $result->detailOutput->buyOrder,
				'commerceCode' => $result->detailOutput->commerceCode,
				'authorizationCode' => $result->detailOutput->authorizationCode,
				'detalle' => Cart::getContent(),
				'userId' => Auth::id(),
			]);
			request()->session()->flash('message', 'Compra Realizada!');
		}
		return RedirectorHelper::redirectBackNormal($result->urlRedirection);
	}

	public function finish()
	{
		dd($_POST, session('response'));
	  // Acá buscar la transacción en tu base de datos y ver si fue exitosa o fallida, para mostrar el mensaje de gracias o de error según corresponda
		Cart::clear();
	}
}
