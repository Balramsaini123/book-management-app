<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Models\Book;

/**
 * Class BookRepository
 *
 * This class implements the BookRepositoryInterface and provides methods
 * specific to interacting with Book models in the database.
 *
 * @package App\Repositories
 */
class BookRepository extends BaseRepository implements BookRepositoryInterface {

    /**
     * BookRepository constructor.
     *
     * @param Book $model The Book model instance to be used by the repository.
     */
    public function __construct(Book $model)
    {
        $this->model = $model;
    }
}
