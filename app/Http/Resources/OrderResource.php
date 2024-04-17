<?php

namespace App\Http\Resources;


use App\Libraries\AppLibrary;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $latestCreditPurchase = $this->creditDepositPurchases->first();
        return [
            'id'                   => $this->id,
            'order_serial_no'      => $this->order_serial_no,
            'user_id'              => $this->user_id,
            "total_amount_price"   => AppLibrary::currencyAmountFormat($this->total),
            "total_currency_price" => AppLibrary::currencyAmountFormat($this->total),
            'payment_status'       => $this->payment_status,
            'status'               => $this->status,
            'status_name'          => trans('orderStatus.' . $this->status),
            'order_items'          => optional($this->orderProducts)->count(),
            'order_datetime'       => AppLibrary::datetime($this->order_datetime),
            'user'                 => new UserResource($this->user),
            'purchase_type'        => $this->purchase_type,
            'paid'                 => AppLibrary::currencyAmountFormat(optional($latestCreditPurchase)->paid),
            'balance'              => AppLibrary::currencyAmountFormat(optional($latestCreditPurchase)->balance),
        ];
    }
}
