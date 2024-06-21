<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * This class implements the UserRepositoryInterface and provides methods
 * specific to interacting with User models in the database.
 *
 * @package App\Repositories
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface {

    /**
     * UserRepository constructor.
     *
     * @param User $model The User model instance to be used by the repository.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
