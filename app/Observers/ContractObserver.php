<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class ContractObserver
{
	public function created()
	{
		Cache::forget('contract_list');
	}
}
