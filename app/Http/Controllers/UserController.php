<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Response;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        $querySucceded = DB::table('user')->insert(
          ['username' => $username, 'password' => $password, 'emailAddress' => $email]
        );

        if ($querySucceded) {
            echo Response::json(array('status' => 200, 'message' => 'OK'), 200);
        }
        else {
            echo Response::json(array('status' => 400, 'message' => 'ERR'), 400);
        }
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
            echo Response::json(array('status' => 200, 'message' => json_encode($user)), 200);
        }
        else {
            echo Response::json(array('status' => 400, 'message' => 'ERR'), 400);
        }
    }
}
