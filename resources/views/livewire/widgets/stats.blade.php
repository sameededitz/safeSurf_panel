<div class="mt-5"> <!-- Added margin-top to the wrapper -->
    <div class="row mt-20">
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total VPS Servers</p>
                            <h4 class="my-1">{{ $totalVpsServers }}</h4>
                        </div>
                        <div class="ml-auto">
                            <iconify-icon icon="solar:server-2-linear" width="24" height="24"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total VPN Servers</p>
                            <h4 class="my-1">{{ $totalServers }}</h4>
                        </div>
                        <div class="ml-auto">
                            <iconify-icon icon="material-symbols-light:vpn-key-outline" width="24" height="24"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Plans</p>
                            <h4 class="my-1">{{ $totalPlans }}</h4>
                        </div>
                        <div class="ml-auto">
                            <iconify-icon icon="streamline:subscription-cashflow" width="24" height="24"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Users</p>
                            <h4 class="my-1">{{ $totalUsers }}</h4>
                            <p class="mb-0 font-weight-light"><i class='bx bxs-up-arrow align-middle'></i>{{ $userChangePercentage }}% Since last week</p>
                        </div>
                        <div class="ml-auto">
                            <iconify-icon icon="flowbite:users-group-outline" width="24" height="24"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>