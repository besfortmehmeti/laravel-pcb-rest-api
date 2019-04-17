<?php

namespace Fortshpejt\PCB\Traits;

use SoapBox\Formatter\Formatter;

trait PcbRequest
{
		

	public $mode;
	private $config;
	
	private $data;

	private $sslCA;
	private $sslCert;
	private $sslKey;
	
	private $handlerURL;
	private $CancelURL;
	private $DeclineURL;


	private function setConfig()
    {
        // Set Config
    	$envConfig = config('pcb');

        if (empty($envConfig['mode']) || !in_array($envConfig['mode'], ['sandbox', 'live'])) {
            $this->mode = 'live';
        } else {
            $this->mode = $envConfig['mode'];
        }

        $this->config = $envConfig[$this->mode];

        if(empty($this->config)) return null;

        $this->sslKey  = storage_path('cert/'.$this->config['ssl_key']);
        $this->sslCA  = storage_path('cert/'.$this->config['ssl_cainfo']);
        $this->sslCert  = storage_path('cert/'.$this->config['ssl_cert']);
        
        $this->ApproveURL = $envConfig['ApproveURL'];
        $this->CancelURL  = $envConfig['CancelURL'];
        $this->DeclineURL = $envConfig['DeclineURL'];

    }


    private function execute(){ 

    	$formatter = Formatter::make($this->data, Formatter::ARR);

		$xml = $formatter->toXml('TKKPG', 'UTF-8', true);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->config['url']);

		curl_setopt($ch, CURLOPT_SSLKEY, $this->sslKey );
		curl_setopt($ch, CURLOPT_CAINFO, $this->sslCA );
		curl_setopt($ch, CURLOPT_SSLCERT, $this->sslCert );
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //return results
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);

		//send and return data to caller
		$result = curl_exec($ch);

		if(curl_errno($ch))
    		print curl_error($ch);
		else
    		curl_close($ch);
    	
    	return Formatter::make($result, Formatter::XML)->toArray();

	}



	private function createOrder($array = [])
	{

    	$this->data = [
			'Request' => [
				'Operation' => 'CreateOrder',
				'Language' => 'EN',
				'Order' => [
					'Merchant' => $this->config['merchant'],
					'Amount' => intval($array['amount']*100),
					'Currency' => $array['currency'] ?? config('pcb.currency'),
					'Description' => $array['description'],
					'ApproveURL' => $this->ApproveURL,
					'CancelURL' => $this->CancelURL,
					'DeclineURL' => $this->DeclineURL,
					'OrderType' => $array['orderType'] ?? 'Purchase',
				]
			]
		];
		
		$ex = $this->execute();

		return $this->orderResponse($ex);

	}



	private function getorderStatus($array = [])
	{

    	$this->data = [
			'Request' => [
				'Operation' => 'GetOrderStatus',
				'Language' => 'EN',
				'Order' => [
					'Merchant' => $this->config['merchant'],
					'OrderID' => $array['OrderID'],
				],
				'SessionID' => $array['SessionID'],
			]
		];
		
		$ex = $this->execute();

		return $this->orderResponse($ex);

	}



	private function orderResponse($response)
	{

		switch ($response['Response']['Status']) {
			case '00':
				$msg = $response['Response']['Order'];
				break;
			case '30':
				$msg = "Message invalid format (no mandatory fields and etc.)";
				break;
			case '10':
				$msg = "Internet shop has no access to the Create Order operation (or the Internet shop is not registered)";
				break;
			case '54':
				$msg = "Invalid operation";
				break;
			case '96':
				$msg = "System error";
				break;
			default:
				$msg = "Unknown code";
				break;
		}
		

		return ['code' => $response['Response']['Status'], 'msg' => $msg];

	}


}