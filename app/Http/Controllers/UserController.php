<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Response;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $avatar = $request->input('avatar');

        $querySucceeded = User::insert(
          ['username' => $username, 'password' => $password, 'email_address' => $email, 'avatar' => $avatar]
        );

        if ($querySucceeded)
        {
            $returnValue['status'] = 200;
            $returnValue['message'] = 'OK';

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['error_message'] = 'An error occurred while trying to store new user.';

        return Response::json($returnValue, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Checks whether the user with the passed username and password exists.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::where(['username' => $username, 'password' => $password])->first();

        if ($user != null)
        {
            $returnValue['status'] = 200;
            $returnValue['message'] = $user;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['error_message'] = 'User does not exist.';

        return Response::json($returnValue, 400);
    }

    /**
     * Gets all of the users that are not set as the requester's contacts.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAvailableUsers(Request $request)
    {
        $requesterId = $request->input('id');
        $username = $request->input('username');

        $users = User::leftJoin('contacts', 'contacts.contact_id', '=', 'user.id')
            ->where('user.id', '!=', $requesterId)
            ->where('user.username', 'LIKE', '%'.$username.'%')
            ->get(['user.*']);

        if ($users != null)
        {
            $returnValue['status'] = 200;
            $returnValue['message'] = $users;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 405;
        $returnValue['error_message'] = 'No users are registered with given or similar nickname.';

        return Response::json($returnValue, 405);
    }

    /**
     * Selects all of the given users existing contacts.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getContacts($id)
    {
        $user = User::find($id);

        if ($user != null)
        {
            $contacts = $user->contacts()
                ->join('user', 'user.id', '=', 'contacts.contact_id')
                ->get(['id', 'username', 'email_address', 'avatar']);

            $returnValue['status'] = 200;
            $returnValue['message'] = $contacts;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['error_message'] = 'User does not exist.';

        return Response::json($returnValue, 400);
    }

    /**
     * Selects all of the given users contact requests.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getContactRequests($id)
    {
        $user = User::find($id);

        if ($user != null)
        {
            $requests = $user->requests()
                ->get();

            $contacts = $user->requests()
                ->join('user', 'user.id', '=', 'requests.requester_id')
                ->get(['user.id', 'username', 'email_address', 'avatar']);

            for ($i = 0; $i < count($requests); $i++)
            {
                $requests[$i]['requester'] = $contacts[$i];
            }

            $returnValue['status'] = 200;
            $returnValue['message']= $requests;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['error_message'] = 'User does not exist.';

        return Response::json($returnValue, 400);
    }
}
