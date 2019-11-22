<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Blog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'blogPost' => $this->body,
            'author_id' => $this->author_id,
            'user' => $this->author,
            'webFormatUrl' => "https://cdn.pixabay.com/photo/2013/10/15/09/12/flower-195893_960_720.jpg",

        ];
    }
}
