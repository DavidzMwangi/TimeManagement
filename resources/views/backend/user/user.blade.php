@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="whole_content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                {{--<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>--}}
                                {{--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>--}}
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">New/Edit User</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                @if(count($errors->all())>0)
                                    <div class="alert alert-danger">

                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>

                                        @endforeach
                                    </div>

                                @endif
                                <div class="tab-pane active " id="settings">

                                    <form class="form-horizontal" method="post" action="{{route('admin.users.save_new_user')}}">
                                        {{csrf_field()}}
                                        <div class="form-group col-sm-12 col-md-6">
                                            <input value="{{old('id')}}" type="hidden" name="user_id">
                                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                                            <div class="">
                                                <input type="text" class="form-control" id="inputName"  value="{{old('name')}}" name="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6">
                                            <label for="inputName" class=" control-label">First Name</label>

                                            <div class="">
                                                <input type="text" class="form-control" id="inputName" value="{{old('first_name')}}" name="first_name" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" value="{{old('last_name')}}" name="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" value="{{old('email')}}" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName2" class="col-sm-2 control-label">Phone Number</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" name="phone_number" value="{{old('phone_number')}}"  placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">User Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="user_type" id="user_type">
                                                    <option value="0" {{old('user_type')==0?'selected':''}}>Admin</option>
                                                    <option value="1" {{old('user_type')==1?'selected':''}}>Landlord</option>
                                                    <option value="2" {{old('user_type')==2?'selected':''}}>Tenant</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class=" control-label">Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation" class=" control-label">Password Confirmation</label>

                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation" placeholder="Password Confirmation">
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger" >Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @endsection

@section('script')

    @endsection
