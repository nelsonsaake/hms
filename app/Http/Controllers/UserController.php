<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\MessageResponse;
use App\Http\Responses\ErrorResponse;
use App\Http\Request\StoreUserRequest;
use App\Http\Request\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository, 
    ) {
    }

    /**
     * Display a listing of the user.
     *
     * @return
     */
    public function index(Request $request)
    {
      //  Gate::authorize('viewAny', User::class);

        try {  
            $users = $this->userRepository->paginate($request->all());
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            Log::debug ("Error getting user: " . $e->getMessage());
            $msg = 'Something went wrong getting users, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Create user view.
     *
     * @param  Request  $request
     * @return
     */
    public function create(Request $request)
    {
       // Gate::authorize('create', User::class);

        try {

            return view(
                'users.create',

            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create user view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  StoreUserRequest  $request
     * @return
     */
    public function store(StoreUserRequest $request)
    {
        // Gate::authorize('create', User::class);

        try { 
            $user = $this->userRepository->create($request->all()); 
            return redirect()
                ->route('users.index')
                ->with('success', 'Create user successful');
        } catch (\Exception $e) {
            Log::debug ("Error creating user: " . $e->getMessage());
            $msg = 'Something went wrong creating user, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function show(User $user)
    {
        // Gate::authorize('view', $user);

        return view(
            'users.show', 
            compact('user'),
        );
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function edit(User $user)
    {
        // Gate::authorize('view', $user);

        try {

            return view(
                'users.edit', 
                compact(
                    'user',),
            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create user view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Gate::authorize('update', $user);

        try {
            $user = $this->userRepository->update($user, $request->all());
            return redirect()
                ->route('users.index')
                ->with('success', 'Update user successful');
        } catch (\Exception $e) {
            Log::debug ("Error updating user: " . $e->getMessage());
             return redirect()->back()->withErrors(
                'Something went wrong updating the user, please try again later.'
            );
        } 
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function destroy(User $user)
    {
        // Gate::authorize('delete', $user);

        try {
            $this->userRepository->destroy($user);
            return redirect()
                ->route('users.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::debug ("Error deleting user: " .  $e->getMessage());
             return redirect()->back()->withErrors(
                'Something went wrong deleting the user, please try again later.'
            );
        } 
    }
}

