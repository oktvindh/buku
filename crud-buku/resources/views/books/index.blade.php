@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>List of Books</h2>
    <a href="{{ route('books.create') }}" class="btn btn-success mb-2">Add New Book</a>

    <!-- Tombol Export dan Import -->
    <a href="{{ route('books.export') }}" class="btn btn-primary mb-2">Export Books</a>

    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
            @csrf
            <div class="custom-file mr-2">
                <input type="file" name="file" class="custom-file-input" id="importFile" required>
                <label class="custom-file-label" for="importFile">Choose file</label>
            </div>
            <button type="submit" class="btn btn-success">Import Books</button>
        </form>
    </div>


    <table class="table table-bordered" id="books-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Name</th>
                <th>Description</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td><input type="checkbox" class="checkbox" value="{{ $book->id }}"></td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button id="mass-delete" class="btn btn-danger">Delete Selected</button>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#books-table').DataTable();

        $('#select-all').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        });

        $('#mass-delete').on('click', function() {
            var ids = [];
            $('.checkbox:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length > 0) {
                if (confirm('Are you sure you want to delete selected books?')) {
                    $.ajax({
                        url: '{{ route('books.massDelete') }}',
                        type: 'DELETE',
                        data: {
                            ids: ids,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                            alert(response.success);
                        }
                    });
                }
            } else {
                alert('No records selected!');
            }
        });
    });
</script>
@endpush
