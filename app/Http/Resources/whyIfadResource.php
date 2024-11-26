<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
class whyIfadResource extends JsonResource
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
                'title'         => $this->title,
                'slug'          => $this->slug,
                'short_description'   => $this->short_description,
                'description'   => $this->description
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}