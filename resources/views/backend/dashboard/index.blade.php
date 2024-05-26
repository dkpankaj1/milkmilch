<x-app-layout>

    <div class="card">
        <div class="card-body">
            <h2 class="text-center display-5 text-bold">Search</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
                                placeholder="Search customer. . .">
                            <span class="input-group-text">
                                <button type="submit" class="btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Row start -->
    <div class="row">

        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-red">
                    <i class="bi bi-boxes"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-red">{{ $companyState->currency->symbol }} {{ $today_sale }}</h3>
                    <p>Today Sales</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-green">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-green">{{ $companyState->currency->symbol }} {{ $today_purchase }}</h3>
                    <p>Today Purchase</p>
                </div>
            </div>
        </div>
        
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-blue">
                    <i class="bi bi-pie-chart"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-blue">{{ $companyState->currency->symbol }} {{ $total_sale }}</h3>
                    <p>Total Sales</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-yellow">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-yellow">{{ $companyState->currency->symbol }} {{ $total_purchase }}</h3>
                    <p>Total Purchase</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-green">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-green">{{ $available_stock }}</h3>
                    <p>Available Stack</p>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-red">
                    <i class="bi bi-wallet"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-red">NaN</h3>
                    <p>Today Payment collection</p>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-yellow">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-yellow">{{ $total_customer }}</h3>
                    <p>Customer</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-blue">
                    <i class="bi bi-person"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-blue">{{ $total_rider }}</h3>
                    <p>Rider</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->


    {{-- <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Analytics</div>
                </div>
                <div class="card-body">
                    <div id="basic-area-stack-graph"></div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Row start -->
    <div class="row">
        {{-- new sells :: begin --}}
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">New Sells</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Order Status</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_sale as $item)
                                    <tr>
                                        <td>#INV-{{ $item->id }}</td>
                                        <td>{{ $item->customer->user->name }}</td>
                                        <td>{{ $item->order_status }}</td>
                                        <td>{{ $item->grand_total }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ $item->user->name }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        {{-- new sells :: end --}}

        {{-- new purchase :: begin --}}
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">New Purchase</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Supplier</th>
                                    <th>Order Status</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_purchase as $item)
                                    <tr>
                                        <td>#PRC-{{ $item->id }}</td>
                                        <td>{{ $item->supplier->user->name }}</td>
                                        <td>{{ $item->order_status }}</td>
                                        <td>{{ $item->grand_total }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    @push('scripts')
        <!-- Apex Charts -->
        <script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
        <script>
            var options = {
                chart: {
                    height: 300,
                    type: 'area',
                    stacked: true,
                    toolbar: {
                        show: false,
                    },
                    dropShadow: {
                        enabled: true,
                        opacity: 0.1,
                        blur: 5,
                        left: -10,
                        top: 10
                    },
                    events: {
                        selection: function(chart, e) {
                            console.log(new Date(e.xaxis.min))
                        }
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width: 3
                },
                series: [{
                    name: 'Sale',
                    data: generateDayWiseTimeSeries(new Date('11 Feb 2019 GMT').getTime(), 20, {
                        min: 10,
                        max: 60
                    })
                }],
                theme: {
                    monochrome: {
                        enabled: true,
                        colors: ['#435EEF', '#59a2fb', '#8ec0fd', '#c7e0ff'],
                        shadeIntensity: 0.1
                    },
                },
                grid: {
                    borderColor: '#ffffff',
                    strokeDashArray: 5,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false,
                        }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 20,
                        left: 30
                    },
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center'
                },
                xaxis: {
                    type: 'datetime'
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#basic-area-stack-graph"),
                options
            );

            chart.render();

            function generateDayWiseTimeSeries(baseval, count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var x = baseval;
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                    series.push([x, y]);
                    baseval += 86400000;
                    i++;
                }
                console.log(series);
                return series;
            }
        </script>
    @endpush
</x-app-layout>
