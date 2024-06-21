<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * This class provides basic CRUD operations and common data retrieval methods
 * for interacting with a specified Eloquent model.
 *
 * @package App\Repositories
 */
class BaseRepository {

    /**
     * The model instance used by the repository.
     *
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model The Eloquent model instance to be used by the repository.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all records of the model from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a record by its ID.
     *
     * @param mixed $id The ID of the record to find.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a record by its ID or throw an exception if not found.
     *
     * @param mixed $id The ID of the record to find.
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data The data to create the record.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Delete a record from the database by its ID.
     *
     * @param mixed $id The ID of the record to delete.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function delete($id)
    {
        $record = $this->model->find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }

    /**
     * Retrieve all records of the model from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Find a record by the specified email address.
     *
     * @param string $email The email address to search for.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
