<?php
namespace Fortshpejt\PCB;

use Fortshpejt\PCB\Traits\PcbRequest;
use Fortshpejt\PCB\Requests\PcbOrderRequest;
use Fortshpejt\PCB\Handlers\PcbOrderCallbackHandler;
use SoapBox\Formatter\Formatter;
use Illuminate\Http\Request;


class Pcb
{

	use PcbRequest;


	public function __construct( array $config = [] )
	{
		
		$this->setConfig($config);
	
	}


	public function index()
	{

		$data = [
			'amount' => '15.5',
			'currency' => 'EUR',
			'description' => 'Test Order #00001',
		];
				
		$response = $this->createOrder($data);


		if($response['code'] == '00') {
			//return redirect( $response['msg']);
			return redirect( $response['msg']['URL'].'?ORDERID='.$response['msg']['OrderID'].'&SESSIONID='.$response['msg']['SessionID'] );
		} else {		
			throw new \Exception('ErrorCode: '.$response['code'].' - '.$response['msg'], 1);
		}

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
			return redirect( $response['msg']['URL'].'?ORDERID='.$response['msg']['OrderID'].'&SESSIONID='.$response['msg']['SessionID'] );
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

		$orderStatusData = $handler->handle($request);
		
		dd( $orderStatusData );
	}
	
	
}