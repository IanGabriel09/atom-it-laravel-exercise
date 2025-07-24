@extends('_layouts.app')

{{-- Page internal styles --}}
@section('internal-styles')
@endsection

{{-- Page content --}}
@section('content')
    <div class="container mt-4">
        <h1>To-Do List</h1>

        @include('_components.nav')

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-secondary alert-dismissible fade show w-50">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Book Form --}}
        <div class="card mb-4">
            <div class="card-header">Add / Edit Book</div>
            <div class="card-body">
                <form method="POST" action="{{ route('books.store') }}" id="book-form">
                    @csrf
                    <input type="hidden" name="_method" value="POST" id="form-method">
                    <input type="hidden" name="book_id" id="book_id">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="published_year" class="form-label">Published Year</label>
                        <input type="number" name="published_year" id="published_year" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="authors" class="form-label">Authors</label>
                        <select name="authors[]" id="authors" class="form-select" multiple>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit-button">Add Book</button>
                    <button type="button" class="btn btn-secondary ms-2 d-none" id="cancel-edit">Cancel</button>
                </form>
            </div>
        </div>

        {{-- Book List --}}
        <div class="card">
            <div class="card-header">Book List</div>
            <div class="card-body">
                @if ($books->isEmpty())
                    <p>No books available.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Published</th>
                                <th>Authors</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->description }}</td>
                                    <td>{{ $book->published_year }}</td>
                                    <td>
                                        @php
                                            $authorIds = [];
                                        @endphp
                                        @foreach ($book->authors as $author)
                                            @php $authorIds[] = $author->id; @endphp
                                            <span class="badge bg-secondary">{{ $author->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="d-flex gap-2">
                                        {{-- Delete Form --}}
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>

                                        {{-- Edit Button --}}
                                        <button class="btn btn-sm btn-warning"
                                            onclick='editBook(
                                                {{ $book->id }},
                                                {!! json_encode($book->title) !!},
                                                {!! json_encode($book->description) !!},
                                                {{ $book->published_year ?? 'null' }},
                                                {!! json_encode($authorIds) !!}
                                            )'
                                        > Edit </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- Page scripts --}}
@section('scripts')
    <script>
        function editBook(id, title, description, publishedYear, authorIds) {
            const form = $('#book-form');
            form.attr('action', '/books/' + id);
            $('#form-method').val('PUT');
            $('#book_id').val(id);
            $('#submit-button').text('Update Book');
            $('#cancel-edit').removeClass('d-none');

            $('#title').val(title);
            $('#description').val(description);
            $('#published_year').val(publishedYear);

            // Set selected authors
            $('#authors option').each(function () {
                $(this).prop('selected', authorIds.includes(parseInt($(this).val())));
            });
        }

        $('#cancel-edit').click(function () {
            const form = $('#book-form');
            form.attr('action', '{{ route("books.store") }}');
            $('#form-method').val('POST');
            $('#book_id').val('');
            $('#submit-button').text('Add Book');
            form.trigger('reset');
            $('#authors option').prop('selected', false);
            $(this).addClass('d-none');
        });

        $(document).ready(function() {
            console.log(@json($authors));
        });
    </script>
@endsection
