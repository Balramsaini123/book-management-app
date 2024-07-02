<?php

namespace App\DataTables;
 
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Services\BookService;
 
class BooksDataTable extends DataTable
{

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id')
        ->editColumn('cover_image_path', function($book) {
            $url = asset('uploads/' . $book->cover_image_path);
            return '<img src="'.$url.'" alt="Cover Image" height="50">';
        })
        ->editColumn('file_path', function($book) {
            $url = url('/download-book-pdf/' . $book->id);
                return '<a href="' . $url . '">'. "Downlod".'</a>';
        })
        ->addColumn('actions', function($book) {
            $user = auth()->user();
        
            $actions = '<div class="btn-group">
                            <a href="' . route('book.show', $book->id) . '" class="btn btn-xs btn-info mr-1">View</a>';

            if ($user->role == 2) {
                $actions .= '<a href="' . route('book.delete', $book->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-xs btn-danger delete-book">Delete</a>';
            }
        
            $actions .= '</div>';
        
            return $actions;
        })
        ->rawColumns(['cover_image_path','file_path','actions']);
    }
 
    public function query(): QueryBuilder
    {
        return $this->bookService->query();
    }
 
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }
 
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('book_title')->title('Book Title'),
            Column::make('author_name')->title('Author name'),
            Column::make('book_description')->title('Book Description'),
            Column::make('price')->title('Price'),
            Column::make('cover_image_path')->title('Cover Image'),
            Column::make('file_path')->title('Download link'),
            Column::computed('actions')
            ->title('Actions')
            ->exportable(true)
            ->printable(true)
            ->width(120)
            ->addClass('text-center')
            ->html(function ($book) {
                return '
                    <div class="btn-group">
                        <a href="' . route('book.show', $book->id) . '" class="btn btn-xs btn-info mr-1">View</a>
                        <button class="btn btn-xs btn-danger delete-book" data-id="' . $book->id . '">Delete</button>
                    </div>
                ';
            }),
        ];
    }
 
    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}
