<?php

/**
 * Project's name: Witcher
 * File: JWT.php
 * Author: Kimberly Espert
 * 
 * This program is free software; you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation; either version 2 
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
 * GNU General Public License for more details: 
 * http://www.gnu.org/licenses/gpl.html
 */

namespace Witcher\Control;

class JWT
{
	public static function getToken(): void
	{
		$key = 'Bomber';

		$header = [
			'typ'	=>	'JWT',
			'alg'	=>	'HS256'
		];
		$header = json_encode($header);
		$header = base64_encode($header);

		$result = [
			'id'	=>	'1',
			'name'	=>	'Kimberly',
			'age'	=>	'23'
		];
		$result = json_encode($result);
		$result = base64_encode($result);

		$signature = hash_hmac('sha256', "$header.$result", $key, true);
		$signature = base64_encode($signature);
		
		$token = "$header.$result.$signature";
		echo json_encode(['token' => $token], JSON_PRETTY_PRINT);
		header('Content-Type: application/json;charset=utf-8');
		exit();
	}
}
// Example
JWT::getToken();