<?php
namespace Fortshpejt\PCB\Handlers;

use SoapBox\Formatter\Formatter;
use Illuminate\Http\Request;

class PcbOrderCallbackHandler
{


	public function handle(Request $request)
	{

		$xmlmsg = base64_decode($request->input('xmlmsg'));
        
        if (!$xmlmsg || empty($xmlmsg)) return null;


        return Formatter::make($xmlmsg, Formatter::XML)->toArray();

	}


}