<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html">
            <img src="images/logo_dapur.jpg" class="img-fluid" alt="">
            <span>Dapoer46</span>
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="
                @if (request()->url() == route('dashboard')) active @endif">
                    <a href="{{ route('dashboard') }}" class="iq-waves-effect"><i
                            class="ri-home-4-line"></i><span>Dashboard</span></a>
                </li>

                {{-- <li class="
                @if (request()->url() == route('sensor.index')) active @endif">
                    <a href="{{ route('sensor.index') }}" class="iq-waves-effect"><i
                            class="ri-sensor-line"></i><span>Sensor</span></a>
                </li> --}}

                {{-- <li class="
          @if (request()->url() == route('led.index')) active @endif
          ">
                    <a href="{{ route('led.index') }}" class="iq-waves-effect"><i
                            class="ri-lightbulb-line"></i><span>LED Control</span></a>

                </li> --}}

                <li class="
                @if (request()->url() == route('users.index')) active @endif">
                    <a href="{{ route('users.index') }}" class="iq-waves-effect"><i
                            class="ri-user-2-line"></i><span>Pengguna</span></a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
