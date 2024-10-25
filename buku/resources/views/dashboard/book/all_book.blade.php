@extends('dashboard.book_dashboard')
@section('dashboard')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Book</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <!-- Button Add Book -->
                <a href="{{ route('add.book') }}" class="btn btn-primary">Add Book</a> &nbsp;&nbsp;

                <!-- Button Import -->
                <a href="{{ route('import') }}" class="btn btn-warning ">Import </a>
                &nbsp;&nbsp; 
                <!-- Button Export (GET Link) -->
                <a href="{{ route('export.book') }}" class="btn btn-danger">Export</a>
            </div> 
        </div>


    </div>
    <!--end breadcrumb-->
  
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Thumbnail</th> 
                            <th>Description</th> 
                            <th>Author</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($books as $key=> $item) 
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td> 
                            <td> <img src="{{ asset($item->thumbnail) }}" alt="" style="width: 70px; height:40px;"> </td>
                            <td>{{ $item->description }}</td> 
                            <td>{{ $item->author }}</td> 
                            <td>
       <a href="{{ route('edit.book',$item->id) }}" class="btn btn-info" title="Edit"><i class="lni lni-eraser"></i> </a>   
       <a href="{{ route('delete.book',$item->id) }}" class="btn btn-danger" id="delete" title="delete"><i class="lni lni-trash"></i> </a>  
                     
                            </td>
                        </tr>
                        @endforeach
                         
                    </tbody>
                     
                </table>
            </div>
        </div>
    </div>


   
   
</div>
 



@endsection