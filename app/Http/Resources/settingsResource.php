<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class settingsResource extends JsonResource
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
                'logo_header'   => asset($this->logo_header),
                'logo_footer'   => asset($this->logo_footer),
                'id'            => $this->id,
                'icon'          => asset($this->icon),
                'site_title'    => $this->site_title,
                'video'         => $this->video,
                'phone'         => $this->phone,
                'email'         => $this->email,
                'address'       => $this->address,
                'no_employee'   => $this->no_employee,
                'no_companies'  => $this->no_companies,
                'no_customers'  => $this->no_customers,
            ];
        }catch (\Exception $e) {
            return null;
        }
    }
}