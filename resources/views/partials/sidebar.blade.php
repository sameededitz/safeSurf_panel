<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i>Zoter</a>-->
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/images/logo-lg.png') }}" alt="" class="logo-large">
            </a>
        </div>
    </div>

    <div class="sidebar-inner niceScrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Applications</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="qlementine-icons:server-16" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.vps.servers') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="qlementine-icons:server-16" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> VPS Servers</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.servers') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="ic:baseline-vpn-lock" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> VPN Servers</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.plans') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="mdi:currency-usd" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Plans</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.transactions') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="hugeicons:transaction" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Transactions</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.users') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="ri:user-line" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Users</span>
                    </a>
                </li>
                <li class="menu-title">Panels</li>
                <li>
                    <a href="{{ route('admin.accounts') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="ri:admin-line" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Admins</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.notifications') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="iconamoon:notification" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Notifications</span>
                    </a>
                </li>

                <li>
                    <a href="h" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="bx:support" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Tickets Support</span>
                    </a>
                </li>

                <li>
                    <a href="i" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="mage:email" class="flex-shrink-0 mr-2" width="20"
                            height="20"></iconify-icon>
                        <span> Email Manage</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.feedback') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="material-symbols-light:feedback-outline" class="flex-shrink-0 mr-2"
                            width="20" height="20"></iconify-icon>
                        <span> Feedbacks</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.tos') }}" class="waves-effect d-flex align-items-center">
                        <iconify-icon icon="material-symbols-light:settings-outline-rounded" class="flex-shrink-0 mr-2"
                            width="20" height="20"></iconify-icon>
                        <span> Settings</span>
                    </a>
                </li>



                {{-- <li>
                    <a href="" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="qlementine-icons:server-16" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> VPS Servers</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="ic:baseline-vpn-lock" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> VPN Servers</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="mdi:currency-usd" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Plans</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="hugeicons:transaction" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Transactions</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="ri:user-line" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Users</div>
                    </a>
                </li>


                <li class="menu-title">Panels</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="ri:admin-line" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Admins</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="iconamoon:notification" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Notifications</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="bx:support" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Ticket Support</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="mage:email" class="flex-shrink-0" width="20"
                                height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Email Manage</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="material-symbols-light:feedback-outline" class="flex-shrink-0"
                                width="20" height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px"> Feedbacks</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect d-flex align-items-center">
                        <div class="icons">
                            <iconify-icon icon="material-symbols-light:settings-outline-rounded" class="flex-shrink-0"
                                width="20" height="20"></iconify-icon>
                        </div>
                        <div style="margin-inline-start: 20px">Settings</div>
                    </a>
                </li> --}}

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
