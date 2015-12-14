<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Response;
Use App\ContactRequest;

class ContactRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = ContactRequest::get();

        if ($requests != null)
        {
            $returnValue['status'] = 200;
            $returnValue['message'] = $requests;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = 'An error occurred while fetching requests.';

        return Response::json($returnValue, 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->input('userId');
        $requester = $request->input('requesterId');
        $state = false;
        $request_text = $request->input('requestText');

        $querySucceeded = ContactRequest::insert(
            ['user_id' => $user, 'requester_id' => $requester, 'state' => $state, 'request_text' => $request_text]
        );

        if ($querySucceeded)
        {
            $returnValue['status'] = 200;
            $returnValue['message'] = "OK";

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = "An error occurred while creating the request.";

        return Response::json($returnValue, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateSucceeded = ContactRequest::where('id', $id)->update(
            array(['state', false])
        );

        if ($updateSucceeded)
        {
            $returnValue['status'] = 200;
            $returnValue['message'] = "OK";

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = "An error occurred while trying to delete a request.";

        return Response::json($returnValue, 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
