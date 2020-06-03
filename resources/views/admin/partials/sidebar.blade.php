<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                            <a class="{{ Nav::isRoute('admin.dashboard') }}" href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                           @if(Gate::check('create-users') || Gate::check('update-users'))
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                            </a>
                            @endif
                            <ul class="sub">
                               @if(Gate::check('create-users') || Gate::check('update-users'))
                                <li><a class="{{ Nav::isResource('user.index') }}" href="{{ route('user.index') }}">List Users</a></li>
                                @endif
                                @can('create-users')
                                    <li><a class="{{ Nav::isResource('user.create') }}" href="{{ route('user.create') }}">Create Users</a></li>
                                @endcan
                            </ul>
                        </li>
                       @if(Gate::check('create-users') || Gate::check('update-users'))
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-lock"></i>
                                <span>Permission</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ Nav::isResource('permission.index') }}" href="{{ route('permission.index') }}">List Permission</a></li>
                                <li><a class="{{ Nav::isResource('permission.create') }}" href="{{ route('permission.create') }}">Create Permission</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(Gate::check('create-users') || Gate::check('update-users'))
                        <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-tasks"></i>
                                    <span>Role</span>
                                </a>
                                <ul class="sub">
                                    <li><a {{ Nav::isResource('role.index') }} href="{{ route('role.index') }}">List Role</a></li>
                                    <li><a {{ Nav::isResource('role.create') }} href="{{ route('role.create') }}">Create Role</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(Gate::check('create-users') || Gate::check('update-users') || Gate::check('read-users'))
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>Send info</span>
                            </a>
                            <ul class="sub">
                                <li><a {{ Nav::isResource('products.index') }} href="{{ route('products.index') }}">Orders with User</a></li>
                            </ul>
                        </li>
                        @endif

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
