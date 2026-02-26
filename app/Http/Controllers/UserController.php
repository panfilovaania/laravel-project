<?php

namespace App\Http\Controllers;

use App\Dto\User\CreateUserRequestDto;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

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
        $users = $this->userService->getUsers();

        return response()->json($users);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $dto = new CreateUserRequestDto(
            name: $validated['name'],
            email: $validated['email'],
            password: Hash::make($validated['password']),
            phone: $validated['phone'],
            birthday: $validated['birthday']
        );
        
        $createdUser = $this->userService->createUser($dto);

        return response()->json($createdUser);
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
     public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
    
        return response()->noContent();
    }
}
