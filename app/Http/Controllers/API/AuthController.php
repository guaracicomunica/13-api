<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            ['except' => ['unauthorized', 'login', 'register']]
        );
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if(!$token = auth('api')->attempt($credentials)){
                $user = User::where('email', $request->input('email'))->with('orders')->first();
                if($user != null || empty($request->input('email'))) {
                    return response()->json(['error' => 'Seu e-mail ou senha estão incorretos!'], 401);
                }
                return response()->json(['error' => 'Usuário não cadastrado, clique em "CADASTRA-SE" para realizar seu cadastro.'], 401);
            }

            $user = User::where('email', $request->input('email'))->with('orders')->first();

            $result = array_merge(['user'=> $user],$this->respondWithToken($token));

            return response()->json($result);
        } catch (\Throwable $e) {
            ExceptionLog::makeFromException($e)->save();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        try {
            auth('api')->logout();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Throwable $e) {
            ExceptionLog::makeFromException($e)->save();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'cpf' => 'string|max:25|unique:users',
                'telefone' => 'required|string|max:25',
                'password' => 'required|string|confirmed|min:6',
                'role' => 'required|numeric'
            ]);

            if($validator->fails()){
                return response()->json(["error" => $validator->errors()->toJson()], 400);
            }

            DB::beginTransaction();

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            ));

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $request->role,
            ]);

            DB::commit();

            $credentials = $request->only(['email', 'password']);

            $token = auth('api')->attempt($credentials);

            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user,
                'access_token' => $token
            ], 201);

        } catch (ValidationException $e) {
            DB::rollBack();
            ExceptionLog::makeFromException($e)->save();
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function user()
    {
        try {
            $user = auth('api')->user();
            $user->cvlis;
            return response()->json($user);
        } catch (\Throwable $e) {
            ExceptionLog::makeFromException($e)->save();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60*60
        ];
    }

    public function unauthorized() {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

}

