@extends('dashboard.book_dashboard')
@section('dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Book</li>
                </ol>
            </nav>
        </div>
         
    </div>
    <!--end breadcrumb-->
 
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Book</h5>
            
            <form id="myForm" action="{{ route('store.book') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Book Name</label>
                    <input type="text" name="book_name" class="form-control" id="input1"  >
                </div>

              <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Thumbnail </label>
                    <input class="form-control" name="thumbnail" type="file" id="image">
                </div>


            <div class="form-group col-md-6">
                <label for="input1" class="form-label">Author </label>
                <input type="text" name="author" class="form-control" id="input1"  >
            </div>

            <div class="form-group col-md-12">
                <label for="input1" class="form-label">Description </label>
                <textarea name="description" class="form-control" id="myeditorinstance"></textarea>
            </div>

           

            <hr>

            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Add</button>
                      
                </div>
            </div>
 
            </form>
        </div>
    </div>
 
   
</div>
 <!----For Section-------->
 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#whole_extra_item_delete").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of add multiple class with ajax ==============-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                book_name: {
                    required : true,
                }, 

            },
            messages :{
                book_name: {
                    required : 'Please Enter Book Name',
                }, 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addBook('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addBook('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
 
<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>


@endsection