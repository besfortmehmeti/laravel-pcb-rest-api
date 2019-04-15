<?php

Route::prefix('transaction')->group(function () {
	Route::get('pcb', function(){
		echo 'Hello from the Pcb package!';
	});
});