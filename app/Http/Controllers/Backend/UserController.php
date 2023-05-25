<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {

            if(!Auth::attempt($request->only(['email','password']))){
                return $this->errorResponse([],'Email & Password does not match with our records',Response::HTTP_NOT_FOUND);
            }
            $user = User::where('email', $request->email)->first();
            if(auth('sanctum')->check()){
                auth()->user()->tokens()->delete();
            }
            return $this->successResponse(new UserResource($user),'User logged in successfully');

        } catch (\Exception $exception) {
            $errors['message'] = $exception->getMessage();
            return $this->errorResponse($errors,'Exception errors',Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getUser(Request $request){
        /** @var User $user */
        $user = $request->user();
        return $this->successResponse(new UserResource($user),'');

    }
    public function logout(Request $request){
        /** @var User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return $this->successResponse('','User logged out successfully');
    }
    public function userList(Request $request){
        $users = User::paginate(10);
        return $this->successResponse(new UserResourceCollection($users),'');
    }
    public function store(UserRequest $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $this->successResponse('','User created successfully');

    }

    public function edit($id)
    {
        $user = User::find($id);
        return $this->successResponse(new UserResource($user),'');
    }
    public function update(UserUpdateRequest $request){

        User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $this->successResponse('','User update successfully');

    }
    public function destroy(Request $request){
        User::find($request->user_id)->delete();
        return $this->successResponse('','User deleted successfully');
    }
}
