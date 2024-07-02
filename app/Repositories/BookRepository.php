<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

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

    public function query(): Builder
    {
        return $this->all();
    }
}
