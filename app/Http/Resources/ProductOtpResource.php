<?php

namespace App\Http\Resources;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOtpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'product_info'=>product::where('mobile',$this->mobile)->get(),
            'otp_code'=>$this->code,
        ];
    }
}
