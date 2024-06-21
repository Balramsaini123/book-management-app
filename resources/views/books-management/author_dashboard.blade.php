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
            <!-- Your main content goes here -->
            <h2>Main Content Area</h2>
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}

                </div>
            @else
                <div class="alert alert-success">
                    <div class="d-block"> Hello! {{ auth()->user()->name }} </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
