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
            <div
                style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

                @if($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 style="text-align: center;">Add Book</h2>

                <form action="{{ route('submit.book') }}" method="post" enctype="multipart/form-data"
                    style="margin-bottom: 20px;">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label for="title" style="font-weight: bold; display: block; margin-bottom: 5px;">Book
                            Title:</label>
                        <input type="text" id="title" name="title"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
                            value="{{ old('title') }}" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="author" style="font-weight: bold; display: block; margin-bottom: 5px;">Author
                            Name:</label>
                        <input type="text" id="author" name="author"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
                            value="{{ old('author') }}" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="description" style="font-weight: bold; display: block; margin-bottom: 5px;">Book
                            Description:</label>
                        <textarea id="description" name="description" rows="4"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
                            required>{{ old('description') }}</textarea>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="price" style="font-weight: bold; display: block; margin-bottom: 5px;">Book
                            Price:</label>
                        <input type="text" id="price" name="price"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
                            value="{{ old('price') }}" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="coverpage" style="font-weight: bold; display: block; margin-bottom: 5px;">Book
                            Coverpage
                            Image:</label>
                        <input type="file" id="coverpage" name="coverpage" accept="image/*" style="margin-top: 5px;"
                            value="{{ old('coverpage') }}" >
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="pdf" style="font-weight: bold; display: block; margin-bottom: 5px;">Upload Book
                            PDF:</label>
                        <input type="file" id="pdf" name="pdf" accept=".pdf" value="{{ old('pdf') }}"
                            >
                    </div>
                    <div>
                        <button type="submit"
                            style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Submit</button>
                    </div>
                </form>

            </div>
        </main>
    </div>
</div>
@endsection
