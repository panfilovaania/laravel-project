<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $user = $this->userService->getUserById($user->id);

        return response()->json($user);
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $updatedSUser = $this->userService->updateUser($user, $validated);

        return response()->json($updatedSUser);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy()
    {
       
    }
}
