@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>List of Books</h2>
    <a href="{{ route('books.create') }}" class="btn btn-success mb-2">Add New Book</a>

    <!-- Tombol Export dan Import -->
    <a href="{{ route('books.export') }}" class="btn btn-primary mb-2">Export</a>

    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
            @csrf
            <div class="custom-file mr-2">
                <input type="file" name="file" class="form-control-file mb-3 d-inline" required>
            </div>
            <button type="submit" class="btn btn-success">Import</button>
        </form>
    </div>

    <div class="mb-3">
        <label for="search" class="form-label">Search:</label>
        <input type="text" id="search" class="form-control" placeholder="Search for books...">
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
    <button id="mass-delete" class="btn btn-danger mb-5">Delete Selected</button>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#books-table').DataTable();

        // Checkbox untuk pilih semua
        $('#select-all').on('click', function() {
            $('.checkbox').prop('checked', this.checked);
        });


        // Fitur hapus massal
        $('#mass-delete').on('click', function() {
            var ids = [];
            $('.checkbox:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length > 0) {
                // Menggunakan SweetAlert2 untuk konfirmasi
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('books.massDelete') }}',
                            type: 'DELETE',
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.success,
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload halaman setelah berhasil dihapus
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem deleting the books.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            } else {
                Swal.fire('Warning', 'No records selected!', 'warning');
            }
        });


        // Pencarian DataTable
        $('#search').on('keyup', function() {
            table.search(this.value).draw(); // Filter data sesuai input
        });
    });
</script>
@endpush
