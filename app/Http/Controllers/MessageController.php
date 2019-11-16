<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
	public function store()
	{
		$message = request()->validate([
			'nombre' => 'required',
			'email' => 'required|email',
			'telefono' => 'required',
			'asunto' => 'required',
			'mensaje' => 'required|min:10'
		],[
			'nombre.required' => 'Nombre requerido',
			'email.required' => 'Correo requerido',
			'telefono.required' => 'Correo requerido',
			'asunto.required' => 'Correo requerido',
			'mensaje.required' => 'Correo requerido'
		]);
		Mail::to('demo@laravel.com')->queue(new MessageReceived($message));
		return back()->with('message','Recibimos tu mensaje, te responderemos en menos de 24 horas.');
	}
}
