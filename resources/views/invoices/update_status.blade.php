@extends('layouts.master')
@section('css')
@endsection
@section('title')
    تغير حالة الدفع
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تغير حالة الدفع</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('Status_update') }}" method="post" autocomplete="off">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id" value="{{$invoices->id}}">
                            <label for="inputName" class="control-label">إسم الفاتورة</label>
                            <input type="text" class="form-control" id="inputName" value="{{$invoices->name}}" name="invoice_number" title="يرجي ادخال رقم الفاتورة" readonly>
                        </div>
                        <div class="col">
                            <label>تاريخ الفاتورة</label>
                            <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD" type="text" value="{{ $invoices->invoice_date }}" readonly>
                        </div>
                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD" type="text" value="{{$invoices->due_date}}" readonly>
                        </div>
                    </div>

                    {{-- Rest of the form fields --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">العميل</label>
                            <select name="customer" id="customer_drop" class="form-control" readonly>
                                <!-- Placeholder -->
                                <option value="{{$customer->id}}" selected>{{$customer->name}}</option>

                            </select>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                            <input type="text" class="form-control" id="Value_VAT" value="{{$invoices->tax_amount}}" name="Value_VAT" readonly>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                            <input type="text" class="form-control" id="Total" name="Total" value="{{$invoices->total}}" readonly>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly></textarea>
                        </div>
                    </div><br>

<div class="row">
    <div class="col">
        <label for="exampleTextarea">حالة الدفع</label>
        <select class="form-control" id="Status" name="Status" required>
            <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
            <option value="مدفوعة">مدفوعة</option>
            <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
        </select>
    </div>

    <div class="col">
        <label>تاريخ الدفع</label>
        <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
            type="text" required>
    </div>


</div><br>

<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
</div>

</form>
</div>
</div>
</div>
</div>
<!-- row closed -->

<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
var date = $('.fc-datepicker').datepicker({
dateFormat: 'yy-mm-dd'
}).val();

</script>
@endsection
