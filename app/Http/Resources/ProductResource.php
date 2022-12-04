<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $productsCollection = collect([]);
        $categories = collect([]);
        $data['name'] = $this->name;
        $data['price'] = $this->price;
        $data['type'] = $this->type;
        $data['user_id'] = $this->user_id;
        $data['user_name'] = $this->user->name;
        $data['image'] = count($this->images_url) != 0 ? $this->images_url[0]['url'] : null;
        $data['number_of_reviews'] = $this->reviews->count();
        $data['number_of_watches'] = 200;
        $data['is_favorite'] = $this->is_favorite;
        foreach ($this->categories as $category) {
            $category = $category->category;
            $categories->push([
                'id' => $category->id,
                'name' => $category->name,
            ]);
        }
        $data['categories'] = $categories;
        return $data;
        // $productsCollection->push($data);
        // return $productsCollection;
    }
}
