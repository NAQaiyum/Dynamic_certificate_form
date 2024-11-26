<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
use App\Http\Resources\teamResource;
class teamMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        try{
            return [
                'team'     => new teamResource($this->getTeam),
                'id'       => $this->id,
                'message'  => $this->message
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}