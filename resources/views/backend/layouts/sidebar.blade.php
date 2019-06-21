<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('uploads/rentals.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
{{--            <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>--}}
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @role('Admin')
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        DashBoard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.roles_permissions.index')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        Roles and Permissions
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        User Management
                    </p>
                </a>
            </li>
            @endrole

            @role('Manager')
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('landlord.dashboard')}}" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-dashboard"></i>--}}
{{--                    <p>--}}
{{--                        DashBoard--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-item">--}}
{{--                <a href="{{route('landlord.apartments')}}" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-building-o"></i>--}}
{{--                    <p>--}}
{{--                        Apartments--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-item">--}}
{{--                <a href="{{route('landlord.building')}}" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-building"></i>--}}
{{--                    <p>--}}
{{--                        Buildings--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a href="{{route('landlord.rooms')}}" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-home"></i>--}}
{{--                    <p>--}}
{{--                        Rooms--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a href="{{route('landlord.tenants')}}" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-users"></i>--}}
{{--                    <p>--}}
{{--                        Tenants--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}



{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-warning"></i>--}}
{{--                    <p>--}}
{{--                        Damages--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}



{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-gears"></i>--}}
{{--                    <p>--}}
{{--                        Maintenance--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}



{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                    <i class="nav-icon fa fa-book"></i>--}}
{{--                    <p>--}}
{{--                        Reports--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}



            @endrole


            @role('RegularUser')
                        <li class="nav-item">
                            <a href="{{route('user.tasks')}}" class="nav-link">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    Task
                                </p>
                            </a>
                        </li>

            <li class="nav-item">
                <a href="{{route('user.profile')}}" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>
            @endrole

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
