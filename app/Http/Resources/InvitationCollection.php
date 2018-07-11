<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvitationCollection extends ResourceCollection
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
            'data' => $this->collection->map(function($invitation){
                return [
                    'number' => $invitation->id,
                    'invited_to_name' => $invitation->invited_to_name,
                    'invited_to_email' => $invitation->invited_to_email,
                    'created_at' => $invitation->created_at->format('m/d/Y H:i'),
                    'accepted' => $invitation->accepted
                ];
            }),
            'links' => []
        ];

    }
}
