@extends('backend.layouts.master')
@section('style')
    <link href="{{asset('plugins/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" />

@endsection

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

                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="settings">
                                    <form class="form-horizontal" method="post" action=""  name="profile_form">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="name" v-model="user.name"  >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class=" control-label">Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputName" v-model="name" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class=" control-label">Password Confirmation</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputName" v-model="name"  name="password_confirmation" placeholder="Password Confirmation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" class="btn btn-danger" @click="updateProfile()">Submit</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>


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

    <script src="{{asset('plugins/holder-master/holder.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/jasny-bootstrap/js/jasny-bootstrap.js')}}"></script>
    <script type="application/javascript">
        var data_content=new Vue({
            el:'#whole_content',
            data:{
              user:{}

            },
            created:function () {
                this.getAuthUser();
            },
            methods:{
            getAuthUser:function(){
                let url='{{route('auth_user')}}';
                let me=this;
                axios.get(url)
                    .then(res=>{

                    me.user=res.data;
                    console.log(res.data);
                    })
                    .catch(err=>{
                    console.log(err)

                    })
            },
            updateProfile:function () {
                let url1='{{route('update_profile')}}';
                let me=this;
                let form=document.forms.namedItem('profile_form');
                let formData=new FormData(form);

                axios.post(url1,formData)
                    .then(res=>{
                        me.user=res.data;
                        swal("Success!", "Successfully updated User Profile", "success");
                    })
                    .catch(err=>{
                        swal("Warning!","An error occurred, please retry","warning");


                    })
            }

            }
        })
    </script>
@endsection
