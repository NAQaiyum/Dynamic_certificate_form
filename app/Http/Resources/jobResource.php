<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
use App\Http\Resources\companyResource;
class jobResource extends JsonResource
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
                'company'       => new companyResource($this->company),
                'title'         => $this->title,
                'slug'          => $this->slug,
                'sub_title'     => $this->sub_title,
                'vacancy'       => $this->vacancy,
                'deadline'      => $this->deadline,
                'description'   => $this->description
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}