<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DownloadedBookRepositoryInterface;
use App\Models\Downloadedbook;

/**
 * Class DownloadedBookRepository
 *
 * This class implements the DownloadedBookRepositoryInterface and provides methods
 * specific to interacting with Downloadedbook models in the database.
 *
 * @package App\Repositories
 */
class DownloadedBookRepository extends BaseRepository implements DownloadedBookRepositoryInterface {

    /**
     * DownloadedBookRepository constructor.
     *
     * @param Downloadedbook $model The Downloadedbook model instance to be used by the repository.
     */
    public function __construct(Downloadedbook $model)
    {
        $this->model = $model;
    }
}
