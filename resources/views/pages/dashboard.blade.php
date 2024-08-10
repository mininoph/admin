@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
    	<div class="row">
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$user}}</h4>
                                <p class="mb-0">{{ __('Users')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$transaction}}</h4>
                                <p class="mb-0">{{ __('Transaction')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$pending}}</h4>
                                <p class="mb-0">{{ __('Pending Payment')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$complete}}</h4>
                                <p class="mb-0">{{ __('Completed Payment')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->
        
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-primary">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Offerwall Earning')}}</h6>
                                <h2>${{$offerwall_income[0]->income}} </h2>
                            </div>
                            <div class="icon">
                                <i class="fab fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-danger">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Videos')}}</h6>
                                <h2>{{$video}}</h2>
                            </div>
                            <div class="icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-warning">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Website')}}</h6>
                                <h2>{{$weblink}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-globe"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget bg-dark">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>{{ __('Rewards Option')}}</h6>
                                    <h2>{{$redeem}}</h2>
                                </div>
                                <div class="icon">
                                <i class="ik ik-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget bg-dark">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>{{ __('Today Active User')}}</h6>
                                    <h2>{{$today}}</h2>
                                </div>
                                <div class="icon">
                                <i class="ik ik-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget bg-dark">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>{{ __('This Week Active User')}}</h6>
                                    <h2>{{$week}}</h2>
                                </div>
                                <div class="icon">
                                <i class="ik ik-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget bg-dark">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>{{ __('This Month Active User')}}</h6>
                                    <h2>{{$month}}</h2>
                                </div>
                                <div class="icon">
                                <i class="ik ik-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Application Sales end -->
    	</div>
    	
    	 <div class="col-lg-12 col-xl-12">
    	       <div class="row">
        	      <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="">Users Analysis</h3>
                        </div>
                         <div class="card-block text-center">
                                <div id="revenueMonthly" class="chart-shadow"></div>
                            </div>
                    </div>
                 </div>
                 
    	    </div>   
    	   </div>
    </div>
	<!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

       <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/gauge.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/animate.min.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/pie.js') }}"></script>
        <script src="{{ asset('plugins/ammap3/ammap/ammap.js') }}"></script>
        <script src="{{ asset('plugins/ammap3/ammap/maps/js/usaLow.js') }}"></script>
        
        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
                <script src="{{ asset('js/apexcharts.min.js') }}"></script>
        <script src="{{ asset('js/dashboardchart.js') }}"></script>

     <script>
        $(document).ready(function() {
            var user = @json($alluser);
            var total = {{$user}};
            users_Analysis(total,user[1]['count'],user[2]['count'],user[3]['count'],user[4]['count'],user[5]['count'],user[6]['count'],user[7]['count'],user[8]['count'],user[9]['count'],user[10]['count'],user[11]['count'],user[12]['count'])
        });
    </script>
    @endpush
@endsection