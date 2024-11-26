<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
use App\Http\Resources\teamResource;
class teamResource extends JsonResource
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
                'id'            => $this->id,
                'image'         => asset($this->image),
                'name'          => $this->name,
                'designation'   => $this->designation,
                'description'   => $this->description
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}