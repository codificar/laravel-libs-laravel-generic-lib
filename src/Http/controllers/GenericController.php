<?php

namespace Codificar\Generic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// Importar models
use Codificar\Generic\Models\Generic;

// Importar FormRequest
use Codificar\Generic\Http\Requests\SaveExampleFormRequest;

// Importar Resource
use Codificar\Generic\Http\Resources\saveExampleResource;


use Input, Validator, View, Response;
use Provider, Settings, Ledger, Finance, Bank, LedgerBankAccount;

class GenericController extends Controller {

    

    /**
     * View the generic report
     * 
     * @return View
     */
    public function getExampleVuejs() {

        $varTeste = "Valor qualquer de teste";

        return View::make('generic::example_vuejs')
                    ->with([
                        'teste' => $varTeste
                    ]);
    
    }


    public function saveExample(ProviderAddWithdrawalFormRequest $request)
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
		return new ProviderAddWithdrawalResource([
            'ledger'            => $ledger,
            'withdraw_value'    => $value,
            'bank_account_id'   => $bankAccountId,
            'current_balance'   => $currentBalance,
            'withdraw_settings' => $withDrawSettings
		]);

    }



    public function getAppApiExample()
    {
        // Get the provider id (some projects is 'provider_id' and others is just 'id')
        $providerId = Input::get('provider_id') ? Input::get('provider_id') : Input::get('id');
        $provider = Provider::find($providerId);
        
        $withdrawals_report = Withdrawals::getWithdrawalsSummary($provider->ledger->id, 'provider');
        
        // Return data
		return new ProviderWithdrawalsReportResource([
			'withdrawals_report' => $withdrawals_report
		]);
    }

}