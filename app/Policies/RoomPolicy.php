<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\Permissions;use App\Models\Room;
class RoomPolicy
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
        return $user->can(Permissions::VIEW_ANY_ROOM);
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Room $resource)
    {
        return $user->can(Permissions::VIEW_ROOM);
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can(Permissions::CREATE_ROOM);
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Room $resource)
    {
        return $user->can(Permissions::UPDATE_ROOM);
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Room $resource)
    {
        return $user->can(Permissions::DELETE_ROOM);
    }

    /**
     * Determine whether the user can restore the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Room $resource)
    {
        return $user->can(Permissions::RESTORE_ROOM);
    }

    /**
     * Determine whether the user can permanently delete the resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $resource
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Room $resource)
    { 
        return $user->can(Permissions::FORCE_DELETE_ROOM);
    }
}

