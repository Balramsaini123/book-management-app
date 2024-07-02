<?php

namespace App\Services;

use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Repositories\Interfaces\DownloadedBookRepositoryInterface;
use App\Models\Downloadedbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BookService
 *
 * This class provides service methods for managing books, including adding,
 * downloading, retrieving details, and deleting books, as well as managing
 * downloaded book records.
 *
 * @package App\Services
 */
class BookService {
    
    /**
     * The Book repository instance.
     *
     * @var BookRepositoryInterface
     */
    protected $bookRepository;

    /**
     * The DownloadedBook repository instance.
     *
     * @var DownloadedBookRepositoryInterface
     */
    protected $downloadedBookRepository;

    /**
     * BookService constructor.
     *
     * @param BookRepositoryInterface $bookRepository The Book repository implementation.
     * @param DownloadedBookRepositoryInterface $downloadedBookRepository The DownloadedBook repository implementation.
     */
    public function __construct(BookRepositoryInterface $bookRepository, DownloadedBookRepositoryInterface $downloadedBookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->downloadedBookRepository = $downloadedBookRepository;
    }

    /**
     * Get all books from the repository.
     *
     * @return\Illuminate\Database\Eloquent\Collection|\App\Models\Book[]
     */
    public function getAllBooks()
    {
        return $this->bookRepository->all();
    }

    /**
     * Add a new book to the repository.
     *
     * @param Request $request The HTTP request containing book data.
     * @return \Illuminate\Database\Eloquent\Model The created book object.
     */
    public function addBook(Request $request)
    {
        $request->validated();

        $filename = rand().'bookcover.'.$request->file('coverpage')->getClientOriginalName();
        $request->file('coverpage')->move('uploads', $filename);

        $pdffile = rand().'bookpdf.'.$request->file('pdf')->getClientOriginalName();
        $request->file('pdf')->move('files', $pdffile);

        $user = auth()->user();
        $data = [
            'book_title' => $request->title,
            'author_name' => $request->author,
            'book_description' => $request->description,
            'price' => $request->price,
            'cover_image_path' => $filename,
            'file_path' => $pdffile,
            'user_id' => $user->id
        ];

        return $this->bookRepository->create($data);
    }

    /**
     * Download a book file by its ID.
     *
     * @param int $id The ID of the book to download.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse The file download response.
     */
    public function download($id)
    {
        $data = $this->bookRepository->find($id);
        $filepath = public_path("files/{$data->file_path}");

        $userEmail = Auth::user()->email;
        $bookTitle = $data->book_title;

        Downloadedbook::create([
            'book_title' => $bookTitle,
            'user_email' => $userEmail,
        ]);

        return Response::download($filepath);
    }

    /**
     * Get details of a specific book by its ID.
     *
     * @param int $id The ID of the book.
     * @return \Illuminate\Database\Eloquent\Model|null The book object if found, otherwise null.
     */
    public function getBookDetails($id)
    {
        return $this->bookRepository->find($id);
    }

    /**
     * Delete a book from the repository by its ID.
     *
     * @param int $id The ID of the book to delete.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function deleteBook($id)
    {
        return $this->bookRepository->delete($id);
    }

    /**
     * Get all downloaded book records.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Downloadedbook[]
     */
    public function getAllDownloads()
    {
        return $this->downloadedBookRepository->getAll();
    }

    public function query(): Builder
    {
        return $this->bookRepository->query();
    }
}
