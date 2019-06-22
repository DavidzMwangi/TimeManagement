@extends('backend.layouts.master')

@section('style')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="user_section">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Management</h3>

                        <button  class="btn btn-success float-right"  data-toggle="modal" data-target="#view_pictures_modal">Add New User </button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr v-for="(user,index) in users">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ user.name }}</td>
                                <td> @{{ user.email }}</td>
                                <td >


                                    <span class="badge badge-primary" v-if="user.user_type==0">Admin</span>

                                    <span class="badge badge-success" v-if="user.user_type==1">Manager</span>
                                    <span class="badge badge-secondary" v-if="user.user_type==2">Regular User</span>
                                </td>

                                <td >
                                    <span class="badge badge-danger" v-if="user.is_active==0">No</span>
                                    <span class="badge badge-primary" v-if="user.is_active==1">Yes</span>

                                    <button class="btn btn-sm btn-success" v-if="user.is_active==0" @click="activateUser(user.id)">Activate</button>
                                    <button class="btn btn-sm btn-danger" v-if="user.is_active==1" @click="deactivateUser(user.id)">De-Activate</button>
                                </td>

                                <td>

                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type==0)

                                        <a href="#" @click="deleteUser(user.id)"  title="Delete">  <span class="fa fa-trash"></span></a>
                                    @endif

                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type==1)
                                        <a href="#" @click="deleteUser(user.id)" title="Delete" v-if="user.user_type==2">  <span class="fa fa-trash"></span></a>
                                    @endif
                                </td>
                            </tr>


                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->



        <div class="modal " tabindex="-1" role="dialog" id="view_pictures_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="alert alert-danger" v-if="extra_message!==''">


                            @{{ extra_message }}
                        </div>
                        <div class="tab-pane active " id="settings">

                            <form class="form-horizontal" method="post" action="" name="save_user_form">
                                {{csrf_field()}}


                                <div class="form-group col-sm-12 col-md-10">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="">
                                        <input type="text" class="form-control" id="inputName"   name="name" placeholder="Name">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_type" class="control-label">User Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="user_type" id="user_type">

                                            @role('Admin')

                                            <option value="0" >Admin</option>
                                            <option value="1" >Manager</option>

                                            @endrole

                                            <option value="2" >Regular User</option>
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
                                        <button type="button"  @click="saveData" class="btn btn-danger" >Submit</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                        <!-- /.tab-pane -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('script')

    <!-- SlimScroll -->
    <script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>



    <script type="application/javascript">
        let content=new Vue({

            el:'#user_section',
            data:{
                users:[],
                extra_message:'',
            },
            created:function(){
                this.getAllUsers();
            },
            methods:{
                getAllUsers:function () {
                    let url='{{route('manager.get_all_regular_users')}}';
                    let me=this;
                    axios.get(url)
                        .then(res=>{
                            me.users=res.data;

                        })
                        .catch(err=>{

                        });
                },
                saveData:function () {

                    this.extra_message='';
                    let url1='{{route('manager.save_new_user')}}';
                    let me=this;
                    let form=document.forms.namedItem('save_user_form');
                    let formData=new FormData(form);
                    axios.post(url1,formData)
                        .then(res=>{
                            swal("Success!", "Successfully saved new User ", "success");

                            me.extra_message='';
                            $('#view_pictures_modal').modal('hide');

                            me.getAllUsers();
                        })
                        .catch(err=>{
                            swal("Warning!","An error occurred, please retry","warning");

                            me.extra_message="An Error has Occurred. Please Try Again";
                        })
                },
                deleteUser:function (userId) {
                    let url3='{{url('manager/delete_user')}}'+'/'+userId;
                    let me=this;
                    axios.get(url3)
                        .then(function (res) {
                            me.getAllUsers();
                            swal("Success!", "Successfully deleted User", "success");

                        })
                        .catch(err=>{
                            swal("Warning!","An error occurred, please retry","warning");

                        })

                },
                activateUser:function (userId) {
                    let url="{{url('manager/activate_user')}}"+'/'+userId;
                    let me=this;
                    axios.get(url)
                        .then(res=>{
                            swal("Success!", "Successfully Activated User", "success");
                            me.getAllUsers();

                        })
                        .catch(err=>{
                            console.log(err);

                            swal("Warning!","An error occurred, please retry","warning");

                        })
                },
                deactivateUser:function (userId) {
                    let url1="{{url('manager/de_activate_user')}}"+'/'+userId;
                    let me=this;

                    axios.get(url1)
                        .then(res=>{
                            swal("Success!", "Successfully De-Activated User", "success");

                            me.getAllUsers();

                        })
                        .catch(err=>{
                            swal("Warning!","An error occurred, please retry","warning");
                            console.log(err);

                        })
                }
            }
        })

    </script>
@endsection