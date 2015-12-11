<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Response;
use App\Contacts;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contacts::get();

        if ($contacts != null) {
            $returnValue['status'] = 200;
            $returnValue['message'] = $contacts;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = 'An error occurred while fetching contacts.';

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
        $contact = $request->input('contactId');

        $querySucceeded = Contacts::insert(
            ['user_id' => $user, 'contact_id' => $contact]
        );

        if ($querySucceeded) {
            $returnValue['status'] = 200;
            $returnValue['message'] = "OK";

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = "An error occurred while adding a new contact.";

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contacts::find($id);

        if ($contact != null) {

            $deleted = $contact->delete();

            if ($deleted) {
                $returnValue['status'] = 200;
                $returnValue['message'] = "Contact was successfully deleted.";

                return Response::json($returnValue, 200);
            }

            $returnValue['status'] = 400;
            $returnValue['message'] = 'An error occurred while trying to delete the selected contact.';

            return Response::json($returnValue, 400);
        }

        $returnValue['status'] = 404;
        $returnValue['message'] = 'Contact not found.';

        return Response::json($returnValue, 404);
    }
}
