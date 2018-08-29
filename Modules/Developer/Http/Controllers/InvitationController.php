<?php

namespace Modules\Developer\Http\Controllers;

use App\Entities\Invitation;
use App\Http\Controllers\ApiController;
use App\Http\Resources\InvitationCollection;
use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Developer\Events\InviteFriend;
use Modules\Developer\Http\Requests\InvitationRequest;


class InvitationController extends ApiController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $page_size = $request->get('pageSize', 20);

        $invitations = auth()
            ->user()
            ->invitations()
            ->search($request)
            ->paginate($page_size);
        
        return new InvitationCollection($invitations);
    }

    /**
     * @param InvitationRequest $request
     * @return mixed
     */
    public function store(InvitationRequest $request)
    {
        $activation_token = rand(10000, 99999);

        try{

            $invitation = Invitation::create([
                'invited_to_name' => $request->user,
                'invited_to_email' => $request->email,
                'invited_by' => auth()->user()->id,
                'activation_token' => bcrypt($activation_token)
            ]);

            event(new InviteFriend($invitation, $activation_token));

            return $this->respond(['message'=>'Invitation has been sent!']);
        }catch(Exception $e){
            return $this->respondInternalError($e->getMessage());
        }
    }

}
