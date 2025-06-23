<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;

class UserRepository
{

    /**
     * paginate: filter user, and paginate
     * 
     * @param array $data {
     *    @type string $search (optional)
     *    @type string $start_date (optional)
     *    @type string $end_date (optional)
     *    @type string $per_page (optional)
     * }
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $data)
    { 
        $search = get($data, 'search');

        return User::query()
            ->when($search, function ($query) use ($search) {
                return $query
                    ->where('name', 'like', "%$search%");
            }) 
            ->when(get($data, 'start_date'), function ($query) use ($data) {
                $query->whereDate('created_at', '>=', Carbon::parse(get($data, 'start_date')));
            })
            ->when(get($data, 'end_date'), function ($query) use ($data) {
                $query->whereDate('created_at', '<=', Carbon::parse(get($data, 'end_date')));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(get($data, 'per_page'));
    }

    /**
    * find: find user
    *
    * @param string $userId
    * @return User|null
    */
    public function find(string $userId): User|null
    {
        return User::find($userId);
    }

    /**
     * create: create user in db
     *
     * @param array $data {
     *    @type string $name
     *    @type string $email
     * }
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {

        return User::create($data);
    }

    /**
     * update: update $user with data in db
     *
     * @param \App\Models\User $user
     * @param array $data {
     *    @type string $name (optional)
     *    @type string $email (optional)
     * }
     * @return User
     */
    public function update(User $user, array $data)
    {

        $user->update($data);

        return $user;
    }

    /**
     * destroy: soft delete $user
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function destroy(User $user)
    {

        $user->delete();
    }
}

