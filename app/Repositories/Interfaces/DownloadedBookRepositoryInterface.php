<?php
namespace App\Repositories\Interfaces;

/**
 * Interface DownloadedBookRepositoryInterface
 *
 * This interface defines methods for interacting with downloaded books.
 *
 * @package App\Repositories\Interfaces
 */
interface DownloadedBookRepositoryInterface {

    /**
     * Get all downloaded books from the repository.
     *
     * @return array Returns an array of downloaded books.
     */
    public function getAll();
}
