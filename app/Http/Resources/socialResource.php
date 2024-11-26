<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class socialResource extends JsonResource
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
                'icon'          => asset($this->icon),
                'title'         => $this->title,
                'link'          => $this->link
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}