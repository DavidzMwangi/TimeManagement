@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.css')}}">

    @endsection
@section('content')
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
    <section class="content" id="permission_roles_content">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Roles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                                {{--<th>Phone Number</th>--}}
                                {{--<th>Confirmed</th>--}}
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    {{--<td>{{$role->created_at->toDayDateTimeString()}} </td>--}}
                                    <td> @foreach($role->permissions as $permission)
                                            <li>{{$permission->name}}</li>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button data-target="#new_permission_modal" data-toggle="modal" class="btn btn-primary" @click="getNewPermissions('{{$role->id}}')">  Add Permission</button>
                                        <button data-target="#revoke_permission_modal" data-toggle="modal" class="btn btn-primary" @click="getExistingPermission('{{$role->id}}')">  Revoke Permission</button>
                                        <a href="" title="Delete">  <span class="fa fa-trash"></span></a>
                                    </td>
                                {{--                                    <td>{{json_encode(\Spatie\Permission\Models\Role::findByName($role->name)->permissions)}}</td>--}}

                                {{--<td>{{$user->phone_number}}</td>--}}
                                {{--<td>--}}
                                {{--@if($user->is_confirmed)--}}
                                {{--<span class="badge badge-success">Yes</span>--}}
                                {{--@else--}}
                                {{--<span class="badge badge-danger">No</span>--}}
                                {{--@endif--}}
                                {{--</td>--}}

                                {{--</tr>--}}

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Permissions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="permission_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Creation Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->created_at->toDayDateTimeString()}} </td>
                                {{--<td>{{$user->last_name}}</td>--}}
                                {{--<td> {{$user->email}}</td>--}}
                                {{--<td>{{$user->phone_number}}</td>--}}
                                {{--<td>--}}
                                {{--@if($user->is_confirmed)--}}
                                {{--<span class="badge badge-success">Yes</span>--}}
                                {{--@else--}}
                                {{--<span class="badge badge-danger">No</span>--}}
                                {{--@endif--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--<a href="{{route('edit_user',['id'=>$user->id])}}" title="Edit" >  <span class="fa fa-edit" ></span></a>--}}
                                {{--<a href="" title="Delete">  <span class="fa fa-trash"></span></a>--}}
                                {{--</td>--}}
                                {{--</tr>--}}

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        {{--modal part--}}

        <div class="modal " tabindex="-1" role="dialog" id="new_permission_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input  type="hidden" :value="role_to_assign_permission" >
                        <table class="table table-bordered table-striped" id="table_assignment">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Creation Date</th>
                                <th>Select</th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="permission in unassigned_permissions">
                                <td>@{{ permission.name }}</td>
                                <td>@{{ permission.created_at }}</td>
                                <td><input type="checkbox" class="custom-checkbox" name="perm"  v-model="permission_record"  :value=" permission.id"  id="perm"></td>
                            {{--<td> {{$user->email}}</td>--}}
                            {{--<td>{{$user->phone_number}}</td>--}}
                            {{--<td>--}}
                            {{--@if($user->is_confirmed)--}}
                            {{--<span class="badge badge-success">Yes</span>--}}
                            {{--@else--}}
                            {{--<span class="badge badge-danger">No</span>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--<a href="{{route('edit_user',['id'=>$user->id])}}" title="Edit" >  <span class="fa fa-edit" ></span></a>--}}
                            {{--<a href="" title="Delete">  <span class="fa fa-trash"></span></a>--}}
                            {{--</td>--}}
                            {{--</tr>--}}


                            </tbody>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="saveData">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal " tabindex="-1" role="dialog" id="revoke_permission_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Revoke Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input  type="hidden" :value="role_to_assign_permission" >
                        <table class="table table-bordered table-striped" id="table_assignment">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Creation Date</th>
                                <th>Select</th>
                                {{--<th>Email</th>--}}
                                {{--<th>Phone Number</th>--}}
                                {{--<th>Confirmed</th>--}}
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="permission in assigned_permissions">
                                <td>@{{ permission.name }}</td>
                                <td>@{{ permission.created_at }}</td>
                                <td><input type="checkbox" class="custom-checkbox" name="perm"  v-model="permission_record"  :value=" permission.id"  id="perm"></td>
                            {{--<td> {{$user->email}}</td>--}}
                            {{--<td>{{$user->phone_number}}</td>--}}
                            {{--<td>--}}
                            {{--@if($user->is_confirmed)--}}
                            {{--<span class="badge badge-success">Yes</span>--}}
                            {{--@else--}}
                            {{--<span class="badge badge-danger">No</span>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--<a href="{{route('edit_user',['id'=>$user->id])}}" title="Edit" >  <span class="fa fa-edit" ></span></a>--}}
                            {{--<a href="" title="Delete">  <span class="fa fa-trash"></span></a>--}}
                            {{--</td>--}}
                            {{--</tr>--}}


                            </tbody>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="saveChanges">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->


@endsection

@section('script')
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $("#permission_table").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <script type="application/javascript">
        var recordsd=new Vue({
            el:'#permission_roles_content',
            data:{
                unassigned_permissions:{},
                permission_record:[],
                role_to_assign_permission:'',
                role_to_detach_permission:'',
                assigned_permissions:{},

            },
            methods:{
                getNewPermissions:function (role_id) {
                    this.role_to_assign_permission=role_id;
                    let me=this;
                    var url23='{{route('admin.roles_permissions.get_other_permissions')}}';
                    axios.post(url23,{'role_id':role_id})
                        .then(function (response) {
                            me.unassigned_permissions=response.data.records;
                        })
                        .catch(function (err) {

                        })
                },

                saveData:function () {
                    // console.log( this.permission_record);
                    var me=this;
                    var url23='{{route('admin.roles_permissions.update_permission_to_roles')}}';
                    axios.post(url23,{'permissions':me.permission_record,'role_id':me.role_to_assign_permission})
                        .then(function (response) {
                            window.location='{{route('admin.roles_permissions.permission_roles')}}'
                        })



                },
                getExistingPermission:function (role_id) {
                    this.role_to_detach_permission=role_id;
                    let me=this;
                    var url23='{{route('admin.roles_permissions.get_active_permissions')}}';
                    axios.post(url23,{'role_id':role_id})
                        .then(function (response) {
                            // console.log(response.data.current_permissions);
                            me.assigned_permissions=   response.data.current_permissions
                        })

                },
                saveChanges:function () {
                    // console.log(this.permission_record);
                    var me=this;
                    var url33='{{route('admin.roles_permissions.update_revokement_to_rules')}}';
                    axios.post(url33,{'permissions':me.permission_record,'role_id':me.role_to_detach_permission})
                        .then(function (response) {
                            window.location='{{route('admin.roles_permissions.permission_roles')}}'
                        })
                }
            }
        })
    </script>
    @endsection