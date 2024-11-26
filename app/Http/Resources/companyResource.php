<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
use App\Http\Resources\companyImagesResource;
class companyResource extends JsonResource
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
            if($this->name){
                return [
                    'name'              => $this->name,
                    'id'                => $this->id,
                    'slug'              => $this->slug,
                    'email'             => $this->email,
                    'phone'             => $this->phone,
                    'address'           => $this->address,
                    'lan'               => $this->lan,
                    'lat'               => $this->lat,
                    'thumbnail'         => $this->thumbnail,
                    'logo'              => asset($this->logo),
                    'video'             => $this->video,
                    'description'       => $this->description,
                    'short_description' => $this->short_description,
                    'web_link'          => $this->web_link,
                    'images'            => companyImagesResource::collection($this->images)
                ];
            }else{
                return [
                    'logo'              => $this->logo,
                ];
            }
            
        }catch (\Exception $e) {
            return null;
        }
    }
}