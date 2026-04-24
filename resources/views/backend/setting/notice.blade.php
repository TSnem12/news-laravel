@extends('admin.admin_master')
@section('admin')
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


        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Notice Settings</h4>

                    <div class="template-demo">
                        @if ($notice->status == 1)
                            <a href="{{ route('deactive.notice', $notice->id) }}" class="btn btn-danger">De Active</a>
                        @else
                            <a href="{{ route('active.notice', $notice->id) }}" class="btn btn-primary">Active</a>
                        @endif
                    </div>

                    @if ($notice->status == 1)
                        <small class="text-success">Now Notice Is Active </small>
                    @else
                        <small class="text-danger">Now Notice Is DeActive </small>
                    @endif

                    <br><br>


                    <form class="forms-sample" method="POST" action="{{ route('update.notice', $notice->id) }}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleTextarea1">Notice English</label>
                            <textarea class="form-control" name="notice_en" id="summernote">
                                
                                {{ $notice->notice_en }}

                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea1">Notice Arabic</label>
                            <textarea class="form-control" name="notice_ar" id="summernote">
                                
                                {{ $notice->notice_ar }}

                            </textarea>
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Update</button>

                    </form>
                </div>
            </div>
        </div>
    @endsection
