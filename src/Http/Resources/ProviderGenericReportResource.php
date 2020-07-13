<?php

namespace Codificar\Generic\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProviderGenericReportResource
 *
 * @package MotoboyApp
 *
 *
 * @OA\Schema(
 *         schema="ProviderGenericReportResource",
 *         type="object",
 *         description="Retorno Retorno do relatorio de saques do prestador",
 *         title="Generic Details Resource",
 *        allOf={
 *           @OA\Schema(ref="#/components/schemas/ProviderGenericReportResource"),
 *           @OA\Schema(
 *              required={"success", "request"},
 *           )
 *       }
 * )
 */
class ProviderGenericReportResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {

        return [
            'success' => true,
            'generic_report' => $this['generic_report']
        ];
    }

}
