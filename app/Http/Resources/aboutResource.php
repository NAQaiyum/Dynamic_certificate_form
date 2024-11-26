<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
class aboutResource extends JsonResource
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
                'title'         => $this->title,
                'image'         => asset($this->image),
                'description'   => $this->description
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}