<?php

namespace Codificar\Generic\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use DB;
/**
 * Class saveCnabSettingsResource
 *
 * @package MotoboyApp
 *
 *
 * @OA\Schema(
 *         schema="saveCnabSettingsResource",
 *         type="object",
 *         description="Retorno Retorno do relatorio de saques do prestador",
 *         title="Generic Details Resource",
 *        allOf={
 *           @OA\Schema(ref="#/components/schemas/saveCnabSettingsResource"),
 *           @OA\Schema(
 *              required={"success", "request"},
 *           )
 *       }
 * )
 */
class saveCnabSettingsResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {

        //update data
        DB::table('settings')->where('key', 'rem_company_name')->update(array('value' => $this['rem_company_name']));
        DB::table('settings')->where('key', 'rem_cpf_or_cnpj')->update(array('value' => $this['rem_cpf_or_cnpj']));
        DB::table('settings')->where('key', 'rem_document')->update(array('value' => $this['rem_document']));
        DB::table('settings')->where('key', 'rem_agency')->update(array('value' => $this['rem_agency']));
        DB::table('settings')->where('key', 'rem_agency_dv')->update(array('value' => $this['rem_agency_dv']));
        DB::table('settings')->where('key', 'rem_account')->update(array('value' => $this['rem_account']));
        DB::table('settings')->where('key', 'rem_account_dv')->update(array('value' => $this['rem_account_dv']));
        DB::table('settings')->where('key', 'rem_bank_code')->update(array('value' => $this['rem_bank_code']));
        DB::table('settings')->where('key', 'rem_agreement_number')->update(array('value' => $this['rem_agreement_number']));
        DB::table('settings')->where('key', 'rem_transfer_type')->update(array('value' => $this['rem_transfer_type']));
        return [
            'success' => true,
            'message' => $this['message']
        ];
    }

}
