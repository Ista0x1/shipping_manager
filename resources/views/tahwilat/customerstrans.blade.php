@extends('layouts.master')
@section('title')
    جميع العمليات
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
							<h4 class="content-title mb-0 my-auto">الأرصدة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/جميع العملاء</span>
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
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="filterId" class="form-label">بحث بلكود</label>
                                            <input type="text" id="filterId" class="form-control" placeholder="أدخل كود العميل">
                                            </div>
                                            <div class="col mb-3">
                                                <label for="filterName" class="form-label">بحث بلإسم</label>
                                                <input type="text" id="filterName" class="form-control" placeholder="أدخل إسم العميل">
                                            </div>


                                        </div>

                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">code</th>
                                                    <th class="border-bottom-0">إسم العميل</th>
                                                    <th class="border-bottom-0">الهاتف</th>
                                                    <th class="border-bottom-0">إجمالي الأورو</th>
                                                    <th class="border-bottom-0">رصيد الأورو (الباقي) </th>
                                                    <th class="border-bottom-0">إجمالي الدولار</th>
                                                    <th class="border-bottom-0">رصيد الدولار (الباقي)</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customers as $item)
                                                <tr>
                                                <td><a href="{{route('customers.show',$item->id)}}">{{$item->code}}</a> </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->total_euro }}</td>
                                                        <td>{{ $item->remaining_euro }}</td>
                                                        <td>{{ $item->total_dollar }}</td>
                                                        <td>{{ $item->remaining_dollar }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف عميل</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <form action="{{ route('customers.destroy', 'test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                </div>
                                <div class="modal-body">
                                    هل انت متاكد من عملية الحذف ؟
                                    <input type="hidden" name="customer_id" id="customer_id" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                </div>
                                </form>
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
<script>
$(document).ready(function() {
    // Bind the keyup event on the filter input fields
    $('#filterId, #filterName').on('keyup', function() {
        var filterId = $('#filterId').val().toLowerCase();
        var filterName = $('#filterName').val().toLowerCase();

        // Iterate through each table row and hide/show based on the filter criteria
        $('#example1 tbody tr').each(function() {
            var id = $(this).find('td:eq(0)').text().toLowerCase();
            var name = $(this).find('td:eq(1)').text().toLowerCase();

            if ((filterId === '' || id.includes(filterId)) &&
                (filterName === '' || name.includes(filterName))) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
<script>
    $('#delete_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #customer_id').val(invoice_id);
    })

</script>
@endsection
