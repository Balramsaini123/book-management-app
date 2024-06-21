<?php
namespace App\Repositories\Interfaces;

/**
 * Interface BookRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface BookRepositoryInterface {

    /**
     * Get all books from the repository.
     *
     * @return array
     */
    public function all();

    /**
     * Create a new book record in the repository.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find a book by its ID.
     *
     * @param mixed $id
     * @return mixed|null
     */
    public function find($id);

    /**
     * Find a book by its ID or throw an exception if not found.
     *
     * @param mixed $id
     * @return mixed
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id);

    /**
     * Delete a book from the repository by its ID.
     *
     * @param mixed $id
     * @return bool
     */
    public function delete($id);
}
