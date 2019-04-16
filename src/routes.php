<?php

Route::prefix('transaction')->name('transaction.')->group(function () {

	Route::post('{action}', '\Fortshpejt\PCB\Pcb@orderHandler')->where('action', 'accept|cancel|decline')->name('handler');
	
});