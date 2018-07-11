<?php

namespace Modules\Developer\Http\Controllers;

use App\Entities\Invitation;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Exception;
use Modules\Developer\Events\InviteFriend;
use Modules\Developer\Http\Requests\InvitationRequest;


class DeveloperController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('developer::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('developer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('developer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('developer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function inviteToFriend(InvitationRequest $request)
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
