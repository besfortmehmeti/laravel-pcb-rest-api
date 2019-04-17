<?php
namespace Fortshpejt\PCB;

use Fortshpejt\PCB\Traits\PcbRequest;
use Fortshpejt\PCB\Handlers\PcbOrderCallbackHandler;
use SoapBox\Formatter\Formatter;
use Illuminate\Http\Request;

use Cookie;


class Pcb
{

	use PcbRequest;


	public function __construct( )
	{
		
		$this->setConfig();
	
	}


	public function createOrderRequest($order_id, $amount, $description = '', $currency = null)
	{

		$data = [
			'amount' => $amount,
			'description' => $description,
		];

		if(!is_null($currency))
			$data['currency'] = $currency;
				
		$response = $this->createOrder($data);

		if($response['code'] == '00') {

			return $response;

		} else {		
			throw new \Exception('ErrorCode: '.$response['code'].' - '.$response['msg'], 1);
		}

	}


	public function getOrderStatusRequest($OrderID, $SessionID)
	{
		$data = [
			'OrderID' => $OrderID,
			'SessionID' => $SessionID,
		];
				
		$response = $this->getorderStatus($data);

		dd($response);
		
	}
	
	
	public function orderHandler(Request $request)
	{

		$handler = new PcbOrderCallbackHandler();

		return $handler->handle($request);

	
	}
	
	
}