<?php

namespace Codificar\Generic\Http\Controllers;

use Codificar\Generic\Models\Generic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//FormRequest
use Codificar\Generic\Http\Requests\ProviderAddGenericFormRequest;

//Resource
use Codificar\Generic\Http\Resources\ProviderGenericReportResource;
use Codificar\Generic\Http\Resources\ProviderAddGenericResource;

use Input, Validator;
use Provider, Settings, Ledger, Finance;
class GenericController extends Controller {

    public function getGenericReport()
    {
        // Get the provider id (some projects is 'provider_id' and others is just 'id')
        $providerId = Input::get('provider_id') ? Input::get('provider_id') : Input::get('id');
        $provider = Provider::find($providerId);
        
        $generic_report = Generic::getGenericSummary($provider->ledger->id, 'provider');
        
        // Return data
		return new ProviderGenericReportResource([
			'generic_report' => $generic_report
		]);
    }

    public function addWithDraw(ProviderAddGenericFormRequest $request)
    {
        // Get the params
        $providerId = $request->get('provider_id');
        $value = $request->get('withdraw_value');
        $bankAccountId = $request->get('bank_account_id');

        // Get the ledger
        $ledger = Ledger::findByProviderId($providerId);
        
        // Get the current balance from ledger. 
        $currentBalance = Finance::sumValueByLedgerId($ledger->id);

        // Get the settings of withdraw
        $withDrawSettings = array(
            'with_draw_enabled' => Settings::getWithDrawEnabled(),
            'with_draw_max_limit' => Settings::getWithDrawMaxLimit(),
            'with_draw_min_limit' => Settings::getWithDrawMinLimit(),
            'with_draw_tax' => Settings::getWithDrawTax()
        );
        

        // Return data
		return new ProviderAddGenericResource([
            'ledger'            => $ledger,
            'withdraw_value'    => $value,
            'bank_account_id'   => $bankAccountId,
            'current_balance'   => $currentBalance,
            'withdraw_settings' => $withDrawSettings
		]);

    }

}