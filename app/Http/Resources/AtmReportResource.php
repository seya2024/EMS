<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AtmReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'terminal' => $this->terminal,
            'name' => $this->name,
            'branch' => $this->branch_id,
            'network' => $this->networkType,
            'location' => $this->location,
            'status' => $this->type,
        ];
    }
}

//return AtmReportResource::collection($query->get());
