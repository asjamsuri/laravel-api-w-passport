<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

use App\User;

use App\Http\Requests\Auth\{
    AuthLoginRequest,
    AuthRegisterRequest
};

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        try {
            $result = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json($result);
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }

    public function login(AuthLoginRequest $request)
    {
        try {
            // get password client's id
            $passwordClient = DB::table('oauth_clients')
                ->where('password_client', true)
                ->first();

            // build the data
            $data = [
                'grant_type' => 'password',
                'client_id' => $passwordClient->id,
                'client_secret' => $passwordClient->secret,
                'username' => $request->username,
                'password' => $request->password,
            ];

            $httpResponse = app()->handle(
                Request::create('/oauth/token', 'POST', $data)
            );

            $result = json_decode($httpResponse->getContent());

            if ($httpResponse->getStatusCode() !== 200) {
                throw new Exception($result->message);
            }

            return response()->json($result);
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            return response()->json(
                $request->user('api')
                    ->token()
                    ->revoke()
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }

    public function me(Request $request)
    {
        try {
            return response()->json(
                $request->user('api')
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }
}
