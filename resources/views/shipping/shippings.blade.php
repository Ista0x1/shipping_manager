@extends('layouts.master')
@section('title')
    جميع الشحن
@endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إدارة الشحن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/الشحن</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">

                        <!--/div-->

                        <!--div-->
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">


                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">إسم</th>
                                                    <th class="border-bottom-0">العميل</th>
                                                    <th class="border-bottom-0">الحالة</th>
                                                    <th class="border-bottom-0">الوصف</th>
                                                    <th class="border-bottom-0">الهاتف</th>
                                                    <th class="border-bottom-0">المدينة</th>
                                                    <th class="border-bottom-0">الدولة</th>
                                                    <th class="border-bottom-0">التاريخ الشحن</th>
                                                    <th class="border-bottom-0">تاريخ الوصول</th>
                                                    <th class="border-bottom-0">نوع الشحن</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($shippings as $shipping)
                                                        <tr>

                                                            <td><a href="{{route('shippings.show',$shipping->id)}}">{{ $loop->iteration }}</a></td>
                                                            <td>{{ $shipping->name }}</td>
                                                            <td>{{ $shipping->customer->name ?? 'لا يوجد' }}</td>
                                                            <td>
                                                                @switch($shipping->status_value)
                                                                    @case(1)
                                                                    <span class="text-success">{{ $shipping->status }}</span>
                                                                        @break
                                                                    @case(2)
                                                                    <span class="text-warning">{{ $shipping->status }}</span>
                                                                        @break
                                                                    @case(3)
                                                                    <span class="text-warning">{{ $shipping->status }}</span>
                                                                    @break
                                                                    @case(4)
                                                                    <span class="text-danger">{{ $shipping->status }}</span>
                                                                    @break
                                                                    @default
                                                                    <span class="text-warning">{{ $shipping->status }}</span>
                                                                @endswitch

                                                        </td>
                                                            <td>{{ $shipping->description }}</td>
                                                            <td>{{ $shipping->phone_final }}</td>
                                                            <td>{{ $shipping->city_final }}</td>
                                                            <td>{{ $shipping->country_final }}</td>
                                                            <td>{{ $shipping->date_origin }}</td>
                                                            <td>{{ $shipping->date_final }}</td>
                                                            <td>{{ $shipping->method->name ?? 'لا يوجد' }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button aria-expanded="false" aria-haspopup="true"
                                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                        type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                    <div class="dropdown-menu tx-13">

                                                                            <a class="dropdown-item"
                                                                                href="{{ route('shippings.edit',$shipping->id)}}">تعديل
                                                                            الشحن</a>



                                                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $shipping->id }}"
                                                                                data-toggle="modal" data-target="#delete_invoice"><i
                                                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                                الشحن</a>



                                                                            <a class="dropdown-item"
                                                                                href="{{ route('Status_shipping', $shipping->id) }}"><i
                                                                                    class=" text-success fas fa-pen"></i>&nbsp;&nbsp;تغير
                                                                                حالة
                                                                                الشحن</a>



                                                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $shipping->id }}"
                                                                                data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                                    class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                                                الارشيف</a>



                                                                            <a class="dropdown-item" href="print_shipping/{{$shipping->id}}"><i
                                                                                    class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                                                الشحن
                                                                            </a>

                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/div-->
                    </div>
				</div>

@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
