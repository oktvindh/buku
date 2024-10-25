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
                    <li class="breadcrumb-item active" aria-current="page">Edit Book</li>
                </ol>
            </nav>
        </div>
         
    </div>
    <!--end breadcrumb-->
 
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Book</h5>
            
            <form id="myForm" action="{{ route('update.book') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="book_id" value="{{ $book->id }}">


                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Name</label>
                    <input type="text" name="book_name" class="form-control" id="input1" value="{{ $book->name }}" >
                </div>

                 <div class="form-group col-md-6">
                <label for="input1" class="form-label">Author </label>
                <input type="text" name="author" class="form-control" id="input1" value="{{ $book->author }}" >
            </div>

            <div class="form-group col-md-12">
                <label for="input1" class="form-label">Description </label>
                <textarea name="description" class="form-control" id="myeditorinstance">{{ old('description', $book->description) }}</textarea>
            </div>

               




           


            


            

           
  
            <hr>
         

             
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>
 
   
</div>


  {{-- //// Start Main Book Image Update /// --}}

<div class="page-content">
    <div class="card">
        <div class="card-body">

            <form action="{{ route('update.book.thumbnail') }}" method="post" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="id" value="{{ $book->id }}">
            <input type="hidden" name="old_img" value="{{ $book->thumbnail }}">


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Thumbnail</label>
                    <input class="form-control" name="thumbnail" type="file" id="image">
                </div>

                
            </div>

            <br><br>
            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
      <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                  
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
        
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="subcategory_id"]').html('');
                        var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },

                }); 
            } else {
                alert('danger');
            }
        });
    });

</script>

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
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
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