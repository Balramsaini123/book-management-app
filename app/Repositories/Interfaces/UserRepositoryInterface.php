<?php
namespace App\Repositories\Interfaces;

/**
 * Interface UserRepositoryInterface
 *
 * This interface defines methods for interacting with user data.
 *
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface {

    /**
     * Create a new user record.
     *
     * @param array $data The data for creating the user.
     * @return mixed Returns the created user object or identifier.
     */
    public function create(array $data);

    /**
     * Find a user by their email address.
     *
     * @param string $email The email address of the user to find.
     * @return mixed|null Returns the user object if found, otherwise null.
     */
    public function findByEmail(string $email);
}
