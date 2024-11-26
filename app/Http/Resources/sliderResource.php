<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
class sliderResource extends JsonResource
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
                'title'     => $this->title,
                'id'        => $this->id,
                'sub_title' => $this->sub_title,
                'image'     => asset($this->cover),
                'video'     => $this->video,
                'placement' => $this->placement
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}