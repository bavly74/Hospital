@extends('dashboard.layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا بموظف الاشعة</h2>
            </div>
        </div>

        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">Customer Ratings</label>
                <div class="main-star">
                    <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
                </div>
            </div>
            <div>
                <label class="tx-13">Online Sales</label>
                <h5>563,275</h5>
            </div>
            <div>
                <label class="tx-13">Offline Sales</label>
                <h5>783,675</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-4 col-md-4 col-xm-12">
            <div class="overflow-hidden card sales-card bg-primary-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h6 class="mb-3 text-white tx-12">اجمالي الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">{{App\Models\Ray::all()->count()}}</h4>
                            </div>

                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-xm-12">
            <div class="overflow-hidden card sales-card bg-danger-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h6 class="mb-3 text-white tx-12">الفواتير الغير مكتملة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">{{App\Models\Ray::where('case',0)->count()}}</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-xm-12">
            <div class="overflow-hidden card sales-card bg-success-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h6 class="mb-3 text-white tx-12">الفواتير المكتملة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">{{App\Models\Ray::where('case',1)->count()}}</h4>
                            </div>

                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>

    </div>
    <!-- row closed -->



    <!-- row opened -->
    <div class="row row-sm row-deck">

        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-1 card-title">Your Most Recent Earnings</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="mb-3 tx-12 tx-muted ">This is your most recent earnings for today's date.</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ الفاتورة</th>
                            <th>اسم المريض</th>
                            <th>اسم الطبيب</th>
                            <th>المطلوب</th>
                            <th>حالة الفاتورة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(\App\Models\Ray::latest()->take(5)->get() as $invoice )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="tx-right tx-medium tx-inverse">{{$invoice->created_at}}</td>
                                <td class="tx-right tx-medium tx-danger">{{$invoice->patient->name}}</td>
                                <td class="tx-right tx-medium tx-inverse">{{$invoice->doctor->name}}</td>
                                <td class="tx-right tx-medium tx-danger">{{$invoice->description}}</td>
                                <td class="tx-right tx-medium tx-inverse">
                                    @if($invoice->case == 0)
                                        <span class="badge badge-danger">تحت الاجراء</span>
                                    @else
                                        <span class="badge badge-success">مكتملة</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            لاتوجد بيانات
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('dashboard/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('dashboard/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('dashboard/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('dashboard/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('dashboard/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('dashboard/js/index.js')}}"></script>
    <script src="{{URL::asset('dashboard/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
