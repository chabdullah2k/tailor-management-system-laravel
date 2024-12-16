

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('image/images-removebg-preview.png')}}" alt="" class="dark-logo">
            <img src="{{ asset('image/download-removebg-preview.png')}}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-home"></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('services.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-tools"></span>
                        <span class="mtext">Services</span>
                    </a>
                </li>

                <li>
                <a href="{{ route('customers.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-user"></span>
                    <span class="mtext">customer</span>
                </a>
                </li>
                <li>
                    <a href="{{ route('measurement_fields.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-clipboard-list"></span>
                        <span class="mtext">MeasurementFields</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('measurements.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-ruler"></span>
                        <span class="mtext">Measurements</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-users"></span>
                        <span class="mtext">Users</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('orders.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-box"></span>
                        <span class="mtext">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('expenses.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-money-bill-alt"></span>
                        <span class="mtext">Expenses</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contacts.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-address-book"></span>
                        <span class="mtext">Contact</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('reports.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-chart-line"></span>
                        <span class="mtext">Reports</span>
                    </a>
                </li>





            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
