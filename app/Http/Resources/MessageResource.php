<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
