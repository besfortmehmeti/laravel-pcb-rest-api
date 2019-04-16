<?php

Route::prefix('transaction')->name('transaction.')->group(function () {
	Route::get('pcb', function(){

		return PCB::index();

	});


	Route::get('status', function(){

		return PCB::getOrderStatusRequest('25949', 'EF99E38B2AC4B7823709BF033828DBD0');

	});

	Route::post('{action}', '\Fortshpejt\PCB\Pcb@orderHandler')->where('action', 'accept|cancel|decline')->name('handler');


	
});