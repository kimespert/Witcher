<?php

/**
 * Project's name: Witcher
 * File: Logger.php
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

use \Datetime;
use \DateTimeZone;
use \Exception;

class Logger
{
	private $date;
	private $zone;

	private $log;
	private $path;

	public function __construct()
	{
		$this->zone = new \DateTimeZone('America/Argentina/Buenos_Aires');
		$this->date = new \Datetime();
		$this->date->setTimezone($this->zone);
		$this->date = $this->date->format('d-m-Y h_i_s');

		$this->log = $this->date . '.log';
		$this->path = 'C:\\xampp\\htdocs\\witcher\\logs\\';
	}

	public function getErrors(String $e): bool
	{
		if(is_dir($this->path))
		{
			if(!file_exists($this->path . $this->log))
			{
				$file = fopen($this->path . $this->log, "w");
				if($file)
				{
					fwrite($file, $e . PHP_EOL);
					fclose($file);
					return true;
				}
			}
		} else {
			if(mkdir('logs', 0777, true))
			{
				$this->getErrors($e);
				return true;
			}
		}
	}
}

// Example

$log = new Logger();

try
{
	throw new Exception('Example');
} catch (Exception $e) {
	$log->getErrors($e->getMessage() . ' ' . $e->getFile() .' ' .$e->getLine());
}