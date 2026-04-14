@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="{{asset('backend/assets/images/dashboard/Group126@2x.png')}}" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Welcome to Easy News </h4>
                        
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
        <a href=" {{ url('/') }} " target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Vist Fontend ? </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

 

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Post</h4>
                    
 <form class="forms-sample" action="{{ route('update.post', $posts->id) }}" method="post" enctype="multipart/form-data">
  @csrf

    <div class="row">

    <div class="form-group col-md-6">
      <label for="exampleInputName1">Title English</label>
      <input type="text" class="form-control" id="exampleInputName1" name=" title_en" value="{{ $posts->title_en }}">
    </div>

     <div class="form-group col-md-6">
      <label for="exampleInputName1">Title Arabic</label>
      <input type="text" class="form-control" id="exampleInputName1" name="title_ar" value="{{ $posts->title_ar }}">
    </div>

  </div> <!-- End Row  --> 




 <div class="row">

    <div class="form-group col-md-6">
      <label for="exampleInputName1">Category</label>
       <select class="form-control" id="exampleSelectGender" name="category_id">
        <option disabled="" selected="">--Select Category--</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $posts->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_en  }} | {{ $category->category_ar  }}</option>
            @endforeach
        </select>
    </div>

     <div class="form-group col-md-6">
      <label for="exampleInputName1">SubCategory</label>
      <select class="form-control" name="subcategory_id" id="subcategory_id">
        <option disabled="" selected="">--Select SubCategory--</option>
          @foreach($subcategories as $subcategory)
          <option value="{{ $subcategory->id }}" {{ $posts->subcategory_id == $subcategory->id ? 'selected' : '' }}>
            {{ $subcategory->subcategory_en }} | {{ $subcategory->subcategory_ar }}
          </option>
          @endforeach          
      </select>
    </div>

  </div> <!-- End Row  --> 





 <div class="row">

    <div class="form-group col-md-6">
      <label for="exampleInputName1">District</label>
       <select class="form-control" id="exampleSelectGender" name="district_id">
        <option disabled="" selected="">--Select District--</option>
            @foreach($districts as $district)
                <option value="{{ $district->id }}" {{ $posts->district_id == $district->id ? 'selected' : '' }}>{{ $district->district_en  }} | {{ $district->district_ar  }}</option>
            @endforeach
       </select>
    </div>

     <div class="form-group col-md-6">
      <label for="exampleInputName1">SubDistrict</label>
      <select class="form-control" id="subdistrict_id" name="subdistrict_id">
        <option disabled="" selected="">--Select SubDistrict--</option>
        @foreach($subdistricts as $subdistrict)
          <option value="{{ $subdistrict->id }}" {{ $posts->subdistrict_id == $subdistrict->id ? 'selected' : '' }}>
            {{ $subdistrict->subdistrict_en }} | {{ $subdistrict->subdistrict_ar }}
          </option>
        @endforeach
      </select>
    </div>

  </div> <!-- End Row  --> 
 

   <div class="row">

        <div class="form-group col-md-6">
          <label for="exampleFormControlFile1">News Image Upload </label>
          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
        </div>


        <div class="form-group col-md-6">
        <label for="exampleInputName1"></label>
        <img src="{{ asset('images/post_image/' .$posts->image) }}" style="height: 70px; width: 90px;">
        <input type="hidden" class="form-control" id="exampleInputName1" name="old_image" value="{{ $posts->image }}">
        </div>

    </div> <!-- End Row  --> 



    <div class="row">

        <div class="form-group col-md-6">
        <label for="exampleInputName1">Tags English</label>
        <input type="text" class="form-control" id="exampleInputName1" name="tags_en" value="{{ $posts->tags_en }}">
        </div>

        <div class="form-group col-md-6">
        <label for="exampleInputName1">Tags Arabic</label>
        <input type="text" class="form-control" id="exampleInputName1" name="tags_ar" value="{{ $posts->tags_ar }}">
        </div>

    </div> <!-- End Row  --> 


    <div class="form-group">
        <label for="exampleTextarea1">Details English</label>
        <textarea class="form-control" name="details_en" id="summernote">{{ $posts->details_en }}</textarea>
    </div>


    <div class="form-group">
        <label for="exampleTextarea1">Details Arabic</label>
        <textarea class="form-control" name="details_ar" id="summernote1">{{ $posts->details_ar }}</textarea>
    </div>



<hr>
  <h4 class="text-center">Extra Opions </h4>
  <br>

    <div class="row">
    
        <label class="form-check-label col-md-6" style="margin-left: 20px">
        <input type="checkbox" name="headline" class="form-check-input" value="1" {{ $posts->headline == 1 ? 'checked' : '' }}> Headline <i class="input-helper"></i></label>

        <label class="form-check-label col-md-6" style="margin-left: 20px">
        <input type="checkbox" name="bigthumbnail" class="form-check-input" value="1" {{ $posts->bigthumbnail == 1 ? 'checked' : '' }}> General Big Thumbnail <i class="input-helper"></i></label>

        <label class="form-check-label col-md-6" style="margin-left: 20px">
        <input type="checkbox" name="first_section" class="form-check-input" value="1" {{ $posts->first_section == 1 ? 'checked' : '' }}> First Section <i class="input-helper"></i></label>

        <label class="form-check-label col-md-6" style="margin-left: 20px">
        <input type="checkbox" name="first_section_thumbnail" class="form-check-input" value="1" {{ $posts->first_section_thumbnail == 1 ? 'checked' : '' }}> First Section BigThumbnail <i class="input-helper"></i></label>
            
    
    </div> <!-- End Row  -->
<br><br>
 
    <button type="submit" class="btn btn-primary mr-2">Update</button>
                     
    </form>
    </div>
</div>
</div>



<!-- This is for Category  -->
<script type="text/javascript">
   $(document).ready(function() {
         $('select[name="category_id"]').on('change', function(){
             var category_id = $(this).val();
             if(category_id) {
                 $.ajax({
                     url: "{{  url('/get/subcategory/') }}/"+category_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        $("#subcategory_id").empty();
                          $.each(data,function(key,value){
                              $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_en+'</option>');
                              });

                     },
                    
                 });
             } else {
                 alert('danger');
             }
         });
     });
</script>


<!-- 
 This is for District  -->
<script type="text/javascript">
   $(document).ready(function() {
         $('select[name="district_id"]').on('change', function(){
             var district_id = $(this).val();
             if(district_id) {
                 $.ajax({
                     url: "{{  url('/get/subdistrict/') }}/"+district_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        $("#subdistrict_id").empty();
                          $.each(data,function(key,value){
                              $("#subdistrict_id").append('<option value="'+value.id+'">'+value.subdistrict_en+'</option>');
                              });

                     },
                    
                 });
             } else {
                 alert('danger');
             }
         });
     });
</script>




@endsection