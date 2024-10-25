@extends('dashboard.book_dashboard')
@section('dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

 
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Import</h5>
            <form id="myForm" action="{{ route('import.book') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf


                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Xlsx File Import</label>
                    <input type="file" name="import_file" class="form-control" id="input1"  >
                </div>
 
 
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Upload</button>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>


   
   
</div>
 

@endsection