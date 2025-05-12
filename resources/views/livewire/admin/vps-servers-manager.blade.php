<div>
    <div class="row mt-4" wire:init="fetchServerUsage">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
            <button type="button" wire:click="fetchServerUsage"
                class="btn btn-outline-info d-flex align-items-center justify-content-center float-right gap-2">
                <iconify-icon icon="radix-icons:reload" width="24" height="24" wire:loading.remove
                    wire:target="fetchServerUsage" class="transition-all duration-300"></iconify-icon>

                <iconify-icon icon="radix-icons:reload" width="24" height="24" wire:loading
                    wire:target="fetchServerUsage" class="animate-spin transition-all duration-300"></iconify-icon>

                <span wire:loading.remove wire:target="fetchServerUsage">
                    Refresh
                </span>

                <span wire:loading wire:target="fetchServerUsage">
                    Loading...
                </span>
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <!-- CPU Usage -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-body text-center">
                    <div class="widget-heading">
                        <h6 class="mb-1">CPU Usage</h6>
                    </div>
                    <div class="w-chart align-items-center justify-content-center" wire:ignore>
                        <div id="cpu-chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RAM Usage -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="card widget-six">
                <div class="card-body text-center">
                    <div class="widget-heading">
                        <h6 class="mb-1">RAM Usage</h6>
                    </div>
                    <div class="w-chart align-items-center justify-content-center" wire:ignore>
                        <div id="ram-chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disk Usage -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="card widget-six">
                <div class="card-body text-center">
                    <div class="widget-heading">
                        <h6 class="mb-1">Disk Usage</h6>
                    </div>
                    <div class="w-chart align-items-center justify-content-center" wire:ignore>
                        <div id="disk-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <!-- WireGuard Status -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-body">
                    <div class="widget-heading d-flex justify-content-between align-items-center">
                        <h6 class="mb-1">WireGuard</h6>
                        <span class="badge badge-light-{{ $wireguardStatus == 'Running' ? 'success' : 'danger' }}">
                            {{ $wireguardStatus == 'Running' ? 'Running' : $wireguardStatus }}
                        </span>
                    </div>
                    <div class="users-connected">
                        {{ $wireguardConnectedUsers }} Users
                    </div>
                </div>
            </div>
        </div>

        <!-- IKEv2 Status -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-body">
                    <div class="widget-heading d-flex justify-content-between align-items-center">
                        <h6 class="mb-1">IKEv2</h6>
                        <span class="badge badge-light-{{ $ikev2Status == 'Running' ? 'success' : 'danger' }}">
                            {{ $ikev2Status == 'Running' ? 'Running' : $ikev2Status }}
                        </span>
                    </div>
                    <div class="users-connected">
                        {{ $ikev2ConnectedUsers }} Users
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="card">
                <div class="card-body">
                    <div class="widget-heading d-flex justify-content-between align-items-center">
                        <h6 class="mb-1">Open VPN</h6>
                        <span class="badge badge-light-{{ $ikev2Status == 'Running' ? 'success' : 'danger' }}">
                            {{ $ikev2Status == 'Running' ? 'Running' : $ikev2Status }}
                        </span>
                    </div>
                    <div class="users-connected">
                        {{ $ikev2ConnectedUsers }} Users
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" wire:init="fetchConnectedUsers">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right" style="padding: 10px;">
            <button type="button" wire:click="fetchConnectedUsers"
                class="btn btn-outline-info d-flex align-items-center justify-content-center float-right gap-2">

                <iconify-icon icon="radix-icons:reload" width="24" height="24" wire:loading.remove
                    wire:target="fetchConnectedUsers" class="transition-all duration-300"></iconify-icon>

                <iconify-icon icon="radix-icons:reload" width="24" height="24" wire:loading
                    wire:target="fetchConnectedUsers" class="animate-spin transition-all duration-300"></iconify-icon>

                <span wire:loading.remove wire:target="fetchConnectedUsers">
                    Fetch Connected Users
                </span>

                <span wire:loading wire:target="fetchConnectedUsers">
                    Loading...
                </span>

            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title"><h3>Connected Users</h3></div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex flex-row">
                    <div>
                        <select class="form-control" wire:model="vpnTypeFilter">
                            <option value="all">All VPN Types</option>
                            <option value="wireguard">WireGuard</option>
                            <option value="ikev2">IKEv2</option>
                            <option value="openvpn">OpenVPN</option>
                        </select>
                    </div>
                </div>
            </div>
            <table id="tech-companies-1" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>IP Address</th>
                        <th>Uptime</th>
                        <th>VPN Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $filteredUsers = collect($connectedUsers)->filter(function ($user) use ($vpnTypeFilter) {
                            return $vpnTypeFilter === 'all' || $user['vpn_type'] === $vpnTypeFilter;
                        });
                    @endphp

                    @forelse ($filteredUsers as $index => $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(preg_replace('/_[^_]+$/', '', $user['name'])) }}</td>
                            <td>{{ $user['ip'] }}</td>
                            <td>{{ $user['uptime'] }}</td>
                            <td>{{ ucfirst($user['vpn_type']) }}</td>
                            <td>
                                <a href=""
                                    class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                    <iconify-icon icon="ic:round-manage-accounts" width="20" height="20"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No connected users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
            <button type="button" wire:click="runScript"
                class="btn btn-outline-info d-flex align-items-center justify-content-center float-right gap-2">

                <iconify-icon icon="carbon:script" width="24" height="24" wire:loading.remove
                    wire:target="runScript" class="transition-all duration-300"></iconify-icon>

                <iconify-icon icon="radix-icons:reload" width="24" height="24" wire:loading
                    wire:target="runScript" class="animate-spin transition-all duration-300"></iconify-icon>

                <span wire:loading.remove wire:target="runScript">
                    Run IKEv2 Script
                </span>

                <span wire:loading wire:target="runScript">
                    Loading...
                </span>

            </button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card bg-dark text-white terminal">
                <div class="card-header">
                    Script Output
                </div>
                <pre id="script-output" class="terminal-output text-white text-left px-3 py-2" wire:stream="output"
                    style="white-space: pre-wrap; overflow-wrap: break-word; word-wrap">{{ $output }}</pre>
            </div>
        </div>
    </div>

</div>
@script
    <script>
        // $(document).ready(function () {
        //           if (!$.browser.webkit) {
        //               $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
        //           }
        //       });
        function extractNumber(value) {
            return parseFloat(value.replace(/[^\d.]/g, '')) || 0;
        }

        function createGaugeChart(element, value, label) {
            var options = {
                series: [value],
                chart: {
                    height: 250,
                    type: "radialBar",
                    offsetY: -10
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 135,
                        track: {
                            background: "#e0e0e0"
                        },
                        dataLabels: {
                            name: {
                                fontSize: "16px",
                                color: "#888",
                                offsetY: 120
                            },
                            value: {
                                offsetY: 76,
                                fontSize: "22px",
                                formatter: val => val + "%"
                            }
                        }
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "light", // Optional: Gives a darker tone
                        type: "horizontal", // You can also use 'vertical' or 'diagonal'
                        gradientToColors: ["#A8E063"], // The end color for the gradient (lighter green)
                        stops: [0, 50, 65, 91], // The gradient stops
                        colorStops: [{
                                offset: 0,
                                color: "#004D40", // Dark green
                                opacity: 1
                            },
                            {
                                offset: 50,
                                color: "#388E3C", // Medium green
                                opacity: 1
                            },
                            {
                                offset: 75,
                                color: "#66BB6A", // Light green
                                opacity: 1
                            },
                            {
                                offset: 100,
                                color: "#A8E063", // Very light green
                                opacity: 1
                            }
                        ]
                    }
                },
                stroke: {
                    dashArray: 4
                },
                labels: [label]
            };

            var chart = new ApexCharts(document.querySelector(element), options);
            chart.render();
            return chart;
        }


        var cpuChart = createGaugeChart("#cpu-chart", 0, "CPU Usage");
        var ramChart = createGaugeChart("#ram-chart", 0, "RAM Usage");
        var diskChart = createGaugeChart("#disk-chart", 0, "Disk Usage");

        $wire.on('updateUsage', (event) => {
            function extractNumber(value) {
                return parseFloat(value.replace(/[^\d.]/g, '')) || 0;
            }

            let cpuUsage = extractNumber(event.cpu);
            let [ramUsed, ramTotal] = (event.ram.match(/\d+/g) || [0, 1]).map(Number);
            let ramPercent = (ramUsed / ramTotal) * 100;
            let [diskUsed, diskTotal] = (event.disk.match(/([\d.]+)/g) || [0, 1]).map(
                Number);
            let diskPercent = (diskUsed / diskTotal) * 100;

            cpuChart.updateSeries([cpuUsage]);
            ramChart.updateSeries([ramPercent.toFixed(2)]);
            diskChart.updateSeries([diskPercent.toFixed(2)]);
        });

        $wire.on('sweetToast', (event) => {
            Swal.fire({
                title: event.title,
                text: event.message,
                icon: event.type,
                timer: 3000,
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false
            });
        });
    </script>
@endscript
@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endsection
