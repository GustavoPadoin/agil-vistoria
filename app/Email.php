<?php

namespace App;

use Mail;

class Email
{
    public static function send($vistoria){

		Mail::send('email', ['vistoria' => $vistoria],

			function($m) use($vistoria){

				$m->from(env('MAIL_USERNAME'), 'AGIL VISTORIAS');
				$m->to([$vistoria->cliente->email => $vistoria->cliente->nome, 'agilvistoriasthe@gmail.com' => 'AGIL'])->subject('Confirmação de Agendamento');
			}
		);
	}
}
