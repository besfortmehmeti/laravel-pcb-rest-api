<?php

namespace Fortshpejt\PCB\Facades;

use Illuminate\Support\Facades\Facade;

class Pcb extends Facade
{

	protected static function getFacadeAccessor(){
		return 'pcb';
	}
	
}