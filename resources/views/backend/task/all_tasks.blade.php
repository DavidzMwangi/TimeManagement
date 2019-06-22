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
                        <h3 class="card-title">Task Management</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>User Name</th>
                                <th>Start Date Time</th>
                                <th>End Date Time</th>
                                <th>Completion Status</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr v-for="(task,index) in tasks">
                                <td>@{{ index+1 }}</td>
                                <td>@{{ task.title }}</td>
                                <td> @{{ task.description }}</td>
                                <td> @{{ task.user.name }}</td>
                                <td> @{{ task.start_date_time }}</td>
                                <td> @{{ task.end_date_time }}</td>
                                <td >
                                    <span class="badge badge-danger" v-if="task.is_completed==0">InComplete</span>
                                    <span class="badge badge-primary" v-if="task.is_completed==1">Complete</span>
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
                tasks:[],
            },
            created:function(){
                this.getAllTasks();
            },
            methods:{
                getAllTasks:function () {
                    let url='{{route('get_all_tasks')}}';
                    let me=this;
                    axios.get(url)
                        .then(res=>{
                            me.tasks=res.data;

                        })
                        .catch(err=>{

                        });
                },


            }
        })

    </script>
@endsection