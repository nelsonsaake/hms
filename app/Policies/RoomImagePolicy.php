<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\Permissions;use App\Models\RoomImage;

class RoomImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any resources.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can(Permissions::VIEW_ANY_ROOM_IMAGE);
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RoomImage  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RoomImage $resource)
    {
        return $user->can(Permissions::VIEW_ROOM_IMAGE);
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can(Permissions::CREATE_ROOM_IMAGE);
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RoomImage  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RoomImage $resource)
    {
        return $user->can(Permissions::UPDATE_ROOM_IMAGE);
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RoomImage  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RoomImage $resource)
    {
        return $user->can(Permissions::DELETE_ROOM_IMAGE);
    }

    /**
     * Determine whether the user can restore the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RoomImage  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RoomImage $resource)
    {
        return $user->can(Permissions::RESTORE_ROOM_IMAGE);
    }

    /**
     * Determine whether the user can permanently delete the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RoomImage  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RoomImage $resource)
    { 
        return $user->can(Permissions::FORCE_DELETE_ROOM_IMAGE);
    }
}

