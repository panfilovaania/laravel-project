<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasPermissionRequest;
use App\Models\User;
use App\Services\RBACService\RBACServiceInterface;
use Illuminate\Http\Request;

class RBACController extends Controller
{
    private $RBACService;

    public function __construct(RBACServiceInterface $RBACService)
    {
        $this->RBACService = $RBACService;
    }

    public function hasPermission(HasPermissionRequest $request)
    {
        $validated = $request->validated();

        $user = User::findOrFail($validated['user_id']);

        $hasPermission = $this->RBACService->hasPermission($user, $validated['scope'], $validated['action']);

        if (!$hasPermission)
        {
            return response()->json([
                'message' => "User doesn't have permission to {$validated['scope']}:{$validated['action']}"
            ], 403);
        }

        return response()->json([
            'message' => "Access granted."
        ], 200);
    }
}