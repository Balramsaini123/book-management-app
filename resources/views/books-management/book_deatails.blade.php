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
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content" style="margin-top: -100px;">
            <!-- Your main content goes here -->
            <div>
                <Navbar /><br /><br /><br /><br />
                <div class="emp-profile py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent text-center">
                                        <img src="{{ asset('uploads/' . $data->cover_image_path) }}"
                                            alt="coverpage" class="img-thumbnail" width="75%" />

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h3 class="mb-0"><i class="fa fa-clone pr-1"></i> Book Deatails</h3>
                                    </div>
                                    <div class="card-body pt-0">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th >Book Title</th>
                                                <td >:</td>
                                                <td>{{ $data->book_title }}</td>
                                            </tr>
                                            <tr>
                                                <th >Author Name</th>
                                                <td >:</td>
                                                <td>{{ $data->author_name }}</td>
                                            </tr>
                                            <tr>
                                                <th >Book Description</th>
                                                <td >:</td>
                                                <td>{{ $data->book_description }}</td>
                                            </tr>
                                            <tr>
                                                <th >Book Price</th>
                                                <td >:</td>
                                                <td>{{ $data->price }}</td>
                                            </tr>
                                            <tr>
                                                <th>Book Rating</th>
                                                <td >:</td>
                                                <td>4.2/5</td>
                                            </tr>
                                            <tr>
                                                <th >In Stock</th>
                                                <td >:</td>
                                                <td>56</td>
                                            </tr>
                                            <tr>
                                                <th>Download Pdf</th>
                                                <td>:</td>
                                                <td><a href={{ url('/download-book-pdf/'.$data->id) }} download>Download</a>
                                                </td>
                                            </tr>
                                        </table>

                                        <button type="button" class="btn btn-primary">Order
                                            Now</button>&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>

                                <div></div>
                                <div class="card shadow-sm">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
