<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;
use App\Http\Resources\newsImagesResource;
class newsResource extends JsonResource
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
                'slug'          => $this->slug,
                'id'            => $this->id,
                'sub_title'     => $this->sub_title,
                'author'        => $this->author,
                'ref'           => $this->ref,
                'news_date'     => $this->news_date,
                'thumbnail'     => asset($this->thumbnail),
                'cover'         => asset($this->cover),
                'images'        => newsImagesResource::collection($this->images),
                'description'   => $this->description
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}