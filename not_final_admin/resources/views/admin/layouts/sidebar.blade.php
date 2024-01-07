<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('order.create')}}">
                        <i class="bi bi-circle"></i><span>Add a Order shipping </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('order.index')}}">
                        <i class="bi bi-circle"></i><span>View All Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('order.allNew')}}">
                        <i class="bi bi-circle"></i><span>View New Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('order.allPanding')}}">
                        <i class="bi bi-circle"></i><span>View Panding Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('order.allDelivered')}}">
                        <i class="bi bi-circle"></i><span>View Delivered Orders</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-client-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Client</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-client-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('client.create')}}">
                        <i class="bi bi-circle"></i><span>Add a Client </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('client.index')}}">
                        <i class="bi bi-circle"></i><span>View All Clients</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->


        <li class="nav-item">
            <a class="nav-link " href="{{ route('site_setting.edit') }}">
                <i class="bi bi-gear"></i>
                <span>Site Settings</span>
            </a>
        </li>


    </ul>

</aside><!-- End Sidebar-->
