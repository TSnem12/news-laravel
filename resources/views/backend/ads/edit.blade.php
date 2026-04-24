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
                                <img src="{{ asset('backend/assets/images/dashboard/Group126@2x.png') }}"
                                    class="gradient-corona-img img-fluid" alt="">
                            </div>
                            <div class="col-5 col-sm-7 col-xl-8 p-0">
                                <h4 class="mb-1 mb-sm-0">Welcome to Easy News </h4>

                            </div>
                            <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                                <span>
                                    <a href=" {{ url('/') }} " target="_blank"
                                        class="btn btn-outline-light btn-rounded get-started-btn">Vist Fontend ? </a>
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
                    <h4 class="card-title">Edit Ads </h4>

                    <form class="forms-sample" action="{{ route('update.ads', $ads->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                            <label for="exampleInputName1">Ads Link </label>
                            <input type="text" class="form-control" id="exampleInputName1" name="link"
                                value="{{ $ads->link }}">
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlFile1">Image Upload </label>
                                <input type="file" name="ads" class="form-control-file" id="exampleFormControlFile1">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleFormControlFile1"></label>
                                <img src="{{ asset('images/ads/' . $ads->ads) }}" style="width: 100px">
                                <input type="hidden" name="old_image" id="exampleFormControlFile1"
                                    value="{{ $ads->ads }}">
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="exampleInputName1">Ads Type</label>
                            <select class="form-control" name="type">

                                <option value="1" {{ $ads->type == 1 ? 'selected' : '' }}>Vertical Ads </option>
                                <option value="2" {{ $ads->type == 2 ? 'selected' : '' }}>Horizontal Ads </option>

                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary mr-2">Update</button>

                    </form>
                </div>
            </div>
        </div>
    @endsection
