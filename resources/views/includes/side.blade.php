<nav id="sidebar">
    <ul class="nav flex-column">

        <li class="nav-item admin-dash">
            <div class="row">
                <div class="col-sm-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS95HiQI0ygPVVvedy_X3AwbPGtSNXg98qnhjyjJiSqwlxwVOqK" width="50" class="rounded">
                </div>
                <div class="col-sm-8">
                    <div> {{Auth::user()->name}}</div>
                    <div>
                        Online
                    </div>
                </div>
            </div>
        </li>

        @php
            $sidelinks = \Ongoingcloud\Laravelcrud\General\HandlePermission::getSideLinks();
            $extrasidelinks = \Ongoingcloud\Laravelcrud\General\HandlePermission::extraSideLink();
        @endphp

        <li class="nav-item {{ request()->is('dashboard*') ? 'active-parent' : '' }}
            {{ request()->is('home*') ? 'active-parent' : '' }}">
            <a class="nav-link" href="/home">
                <i class="fa fa-dashboard"></i> Dashboard
            </a>
        </li>

        @foreach($sidelinks['modules'] as $module)
            @php
                $groups = $sidelinks['module_groups'][strtolower($module->name)];
                $group_id = $module->id;
            @endphp

            <li class="nav-item dropdown-btn {{ request()->is("$module->url*") ? "active-parent" : ""  }}">
                <h6 class="sidebar-section">
                    <i class="fa {{$module->icon}}"></i> 
                    <span>{{$module->name}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </h6>
            </li>

            <div class="dropdown-container" style="display: {{ request()->is("$module->url*") ? "block" : "none"  }}">
                @foreach($groups as $group)
                    @if(in_array($group->permission, $sidelinks['permissions']))
                        <li class='{{ request()->is("$module->url/$group->url**") ? "active" : ""  }}'>
                            <a href='{{route($group->route)}}' style="text-decoration: none;">
                            <i class="fa {{$group->icon}}"></i>  {{$group->display_name}}</a>
                        </li>
                    @endif
                @endforeach
            </div>
        @endforeach

        @foreach($extrasidelinks['module_groups'] as $link)
            @if(in_array($link->permission, $sidelinks['permissions']))
                <li class='{{ request()->is("$link->url*") ? "active" : ""  }}'>
                    <a href='{{route($link->route)}}' style="text-decoration: none;">
                    <i class="fa {{$link->icon}}"></i>  {{$link->display_name}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>