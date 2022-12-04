<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class productReviewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request){
        $data['id'] =  $this->id;
        $data['created_at'] =  $this->created_at->format('d/m/Y');
        $data['review'] =  $this->review;
        $data['user_id'] =  $this->user->id;
        $data['user_name'] =  $this->user->name;
        $data['user_image'] =  $this->user->image_url;
        return $data;
    }
}
