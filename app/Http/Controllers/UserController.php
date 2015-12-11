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

        if ($querySucceeded) {

            $returnValue['status'] = 200;
            $returnValue['message'] = 'OK';

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = 'ERR';

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
     * @return Http response alongside json
     */
    public function getUser(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::where(['username' => $username, 'password' => $password])->first();

        if ($user != null) {

            $returnValue['status'] = 200;
            $returnValue['message'] = $user;

            return Response::json($returnValue, 200);
        }

        $returnValue['status'] = 400;
        $returnValue['message'] = 'User does not exist.';

        return Response::json($returnValue, 400);
    }
}
