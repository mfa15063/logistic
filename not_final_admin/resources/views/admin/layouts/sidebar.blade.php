<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <li class="nav-item">
            <a class="nav-link {{ Route::is('order.*') ? '' : 'collapsed' }} " data-bs-target="#components-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ Route::is('order.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('order.create') }}">
                        <i class="bi bi-circle"></i><span>Add a Order shipping </span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'order.index' ? 'active' : '' }}"
                        href="{{ route('order.index') }}">
                        <i class="bi bi-circle"></i><span>View All Orders</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'order.allNew' ? 'active' : '' }}"
                        href="{{ route('order.allNew') }}">
                        <i class="bi bi-circle"></i><span>View New Orders</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'order.allrejected' ? 'active' : '' }}"
                        href="{{ route('order.allrejected') }}">
                        <i class="bi bi-circle"></i><span>View Rejected Orders</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'order.allPanding' ? 'active' : '' }}"
                        href="{{ route('order.allPanding') }}">
                        <i class="bi bi-circle"></i><span>View Underprocessing Orders</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'order.allDelivered' ? 'active' : '' }}"
                        href="{{ route('order.allDelivered') }}">
                        <i class="bi bi-circle"></i><span>View Delivered Orders</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link {{ Route::is('client.*') ? '' : 'collapsed' }}" data-bs-target="#components-client-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Client</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-client-nav" class="nav-content collapse {{ Route::is('client.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Route::currentRouteName() == 'client.create' ? 'active' : '' }}"
                        href="{{ route('client.create') }}">
                        <i class="bi bi-circle"></i><span>Add a Client </span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'client.index' ? 'active' : '' }}"
                        href="{{ route('client.index') }}">
                        <i class="bi bi-circle"></i><span>View All Clients</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::is('inquiry.*') ? '' : 'collapsed' }}" data-bs-target="#components-inquery-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Inquiry</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-inquery-nav" class="nav-content collapse {{ Route::is('inquiry.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Route::currentRouteName() == 'inquiry.create' ? 'active' : '' }}"
                        href="{{ route('inquiry.create') }}">
                        <i class="bi bi-circle"></i><span>Add a Inquiry </span>
                    </a>
                </li>
                <li>
                    <a class="{{ Route::currentRouteName() == 'inquiry.index' ? 'active' : '' }}"
                        href="{{ route('inquiry.index') }}">
                        <i class="bi bi-circle"></i><span>View All Inquiries</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item ">
            <a class="nav-link single-items {{ Route::currentRouteName() == 'contact_us' ? 'active' : '' }}"
                href="{{ route('contact_us') }}">
                <i class="single-items-i bi bi-chat-left-text"></i>
                <span>Contact Us</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link single-items  {{ Route::currentRouteName() == 'site_setting.edit' ? 'active' : '' }}"
                href="{{ route('site_setting.edit') }}">
                <i class="single-items-i  bi bi-gear"></i>
                <span>Site Settings</span>
            </a>
        </li>


    </ul>

</aside><!-- End Sidebar-->
