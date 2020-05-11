<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {       
      
        return  [
            
            
            'posts' => parent::toArray($request),
            'comments' => $this->comments,
            'likers' => $this->likers
        ];
       
    }

    


}
