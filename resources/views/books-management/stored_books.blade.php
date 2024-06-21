@extends('books-management.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stored.books') }}">All Books</a>
                    </li>
                    @if(auth()->user()->role == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('add.book') }}">Add a Book</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('download.list') }}">Downloaded Books</a>
                    </li>
                    @if(auth()->user()->role == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.history') }}">Users History</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
            <h2>Books list</h2>
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}

                </div>
            @endif
            <table>
                <thead>
                    <tr>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">ID</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Book title</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Author</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Description</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Price</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Cover image</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Download Book
                            PDF</th>
                        <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Action</th>
                        <!-- Add more table headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->id }}</td>
                            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->book_title }}</td>
                            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->author_name }}</td>
                            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->book_description }}</td>
                            <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->price }}</td>
                            <td style="border: 1px solid #dddddd; padding: 8px;"><img
                                    src="{{ asset('uploads/' . $item->cover_image_path) }}"
                                    alt ="coverpage" class="img-thumbnail" width="75" /></td>
                            <td style="border: 1px solid #dddddd; padding: 8px;"><a
                                    href="{{ url('/download-book-pdf/'.$item->id) }}">{{ $item->file_path }}</a>
                            </td>
                            <td style="border: 1px solid #dddddd; padding: 8px;"><a
                                    href="{{ url('/book_detail/'.$item->id) }}"
                                    class="btn btn-success"><i class='fa fa-eye'></i></a><br><br>
                                @if(auth()->user()->role == 2)
                                    <a href="{{ url('/book_delete/'.$item->id) }}"
                                        class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                            class='fa fa-trash'></i></a>
                                @endif
                            </td>
                            <!-- Add more table cells for additional data fields -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</div>

@endsection
