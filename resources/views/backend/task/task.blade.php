@extends('backend.layouts.master')

@section('style')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tasks Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Task</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="tasks_section">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tasks Management</h3>

                        <button  class="btn btn-success float-right"  data-toggle="modal" data-target="#new_task_modal">Add New Task </button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Is Completed</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr v-for="(task,index) in tasks">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ task.title }}</td>
                                <td> @{{ task.description }}</td>
                                <td> @{{ task.start_date_time }}</td>
                                <td> @{{ task.end_date_time }}</td>


                                <td >
                                    <span class="badge badge-danger" v-if="task.is_completed==0">No</span>
                                    <span class="badge badge-primary" v-if="task.is_completed==1">Yes</span>
                                </td>

                                <td>
                                    <button class="btn btn-success btn-sm" v-if="task.is_completed==0" @click="markComplete(task.id)">Mark As Complete</button>

{{--                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type==0)--}}

{{--                                        <a href="#" @click="deleteUser(user.id)"  title="Delete">  <span class="fa fa-trash"></span></a>--}}
{{--                                    @endif--}}

{{--                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type==1)--}}
                                        <a href="#" @click="deleteTask(task.id)" title="Delete">  <span class="fa fa-trash"></span></a>
{{--                                    @endif--}}
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



        <div class="modal " tabindex="-1" role="dialog" id="new_task_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="alert alert-danger" v-if="extra_message!==''">


                            @{{ extra_message }}
                        </div>
                        <div class="tab-pane active " id="settings">

                            <form class="form-horizontal" method="post" action="" name="save_task_form">
                                {{csrf_field()}}


                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-12">
                                        <label for="inputName" class="col-sm-2 control-label">Title</label>

                                            <input type="text" class="form-control" id="inputName"   name="title" placeholder="Title">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-12">
                                        <label for="description" class="col-sm-2 control-label">Description</label>

                                            <textarea class="form-control" id="description" name="description">


                                            </textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="start" class=" control-label">Start Date Time</label>

                                            <input type="datetime-local" class="form-control" name="start_date_time" id="start" >
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="end" class=" control-label">End Date Time</label>

                                            <input type="datetime-local" class="form-control" name="end_date_time" id="end" >
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

            el:'#tasks_section',
            data:{
                tasks:[],
                extra_message:'',
            },
            created:function(){
                this.getAllUserTasks();
            },
            methods:{
                getAllUserTasks:function () {
                    let url='{{route('user.get_user_tasks')}}';
                    let me=this;
                    axios.get(url)
                        .then(res=>{
                            me.tasks=res.data;

                        })
                        .catch(err=>{

                        });
                },
                saveData:function () {

                    this.extra_message='';
                    let url1='{{route('user.save_new_task')}}';
                    let me=this;
                    let form=document.forms.namedItem('save_task_form');
                    let formData=new FormData(form);
                    axios.post(url1,formData)
                        .then(res=>{
                            swal("Success!", "Successfully saved new Task", "success");

                            me.extra_message='';
                            $('#new_task_modal').modal('hide');
                            me.tasks=res.data;
                        })
                        .catch(err=>{
                            swal("Warning!","An error occurred, please retry","warning");
                            me.extra_message="An Error has Occurred. Please Try Again";
                        })
                },
                deleteTask:function (taskId) {
                    let url3='{{url('user/delete_task')}}'+'/'+taskId;
                    let me=this;
                    axios.get(url3)
                        .then(function (res) {
                            me.tasks=res.data;
                            swal("Success!", "Successfully deleted task", "success");

                        })
                        .catch(err=>{
                            swal("Warning!","An error occurred, please retry","warning");
                        })

                },
                markComplete:function (taskId) {
                    let url3='{{url('user/mark_as_complete_task')}}'+'/'+taskId;
                    let me=this;

                    axios.get(url3)
                        .then(res=>{
                            me.tasks=res.data;


                        })
                        .catch(err=>{

                            swal("Warning!","An error occurred, please retry","warning");

                        })
                }
            }
        })

    </script>
@endsection