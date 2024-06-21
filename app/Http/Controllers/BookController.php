<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Services\BookService;
use Illuminate\Support\Facades\Auth;


/**
 * Class BookController
 *
 * Controller responsible for handling book management operations,
 * including adding, storing, downloading, and displaying books and their details.
 *
 * @package App\Http\Controllers
 */
class BookController extends Controller
{

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

   /**
     * Display the form for adding a new book.
     *
     * @return \Illuminate\View\View
     */
     public function add_new_book(){
        return view('books-management.add_book');
     }

     /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
     public function submit_book(BookCreateRequest $request){

        $this->bookService->addBook($request);
        return redirect()->route('stored.books')->with('success', 'Book Added Successfully');

     }

     /**
     * Display a listing of stored books.
     *
     * @return \Illuminate\View\View
     */

     public function stored_books(){
      $data = $this->bookService->getAllBooks();
    return view('books-management.stored_books', compact('data'));
     }

      /**
     * Download a book and store download information in the database.
     *
     * @param  int  $id  The ID of the book to download
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
     public function download($id){
        return $this->bookService->download($id);
     }

     /**
     * Display book detail.
     *
     * @return \Illuminate\View\View
     */
     public function book_details($id){
        $data = $this->bookService->getBookDetails($id);
        return view('books-management.book_deatails', compact('data'));
     }

      /**
     * delete specific book.
     *
     *@return \Illuminate\Http\RedirectResponse
     */
     public function book_delete($id){
        $this->bookService->deleteBook($id);
        return redirect()->route('stored.books')->with('success','book deleted successfully');
     }

     /**
     * Display a list of downloaded books for the logged-in user.
     *
     * @return \Illuminate\View\View
     */
    public function download_list(){
        $user = Auth::user();
        $downloads = $user->downloads;
    return view('books-management.list_of_downloadedbooks', ['downloads' => $downloads]);
    }
 
     /**
     * Display a list of all users' download history.
     *
     * @return \Illuminate\View\View
     */
    public function users_history(){
        $user_data = $this->bookService->getAllDownloads();
        return view('/books-management.users_history',compact('user_data'));
    }
}
