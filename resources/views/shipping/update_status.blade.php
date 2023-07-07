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
                <form action="{{ route('Status_shipping_update') }}" method="post" autocomplete="off">

                    {{ csrf_field() }}
                    {{-- 1 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">إسم الشحن</label>
                            <input type="text" class="form-control" id="inputName" name="name"
                                title="يرجي ادخال إسم الشحن" value="{{$shipping->name}}" readonly required>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">العميل</label>
                            <input type="text" class="form-control" id="inputName" name="name"
                            title="يرجي ادخال إسم الشحن" value="{{$shipping->customer->name}}" readonly required>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">رقم التتبع</label>
                            <input type="text" class="form-control" id="inputName"  name="id"
                                title="يرجي إدخال رقم الهاتق" value="{{$shipping->id}}" readonly>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">الوصف</label>
                            <textarea class="form-control" readonly id="exampleTextarea" aria-valuetext="{{$shipping->description}}" name="description" rows="3"></textarea>
                        </div>
                    </div><br>
                    <h4 class="card-title mg-b-12">الشحن من </h4>

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">العنوان</label>
                            <input type="text" class="form-control" id="inputName" name="adress_origin"
                                title="يرجي ادخال عنوان العميل" value="{{$shipping->adress_origin}}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">المدينة</label>
                            <input type="text" class="form-control" id="inputName" name="city_origin"
                                title="يرجي ادخال مدينة العميل" value="{{$shipping->city_origin}}" readonly >
                        </div>





                    </div>
                    <h4 class="card-title mt-4  mg-b-12">الشحن إلى </h4>

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">العنوان</label>
                            <input type="text" class="form-control" id="inputName" name="adress_final"
                                title="يرجي ادخال عنوان العميل" value="{{$shipping->adress_final}}" readonly >
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">المدينة</label>
                            <input type="text" class="form-control" id="inputName" name="city_final"
                                title="يرجي ادخال مدينة العميل" value="{{$shipping->city_final}}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الدولة</label>
                            <input type="text" class="form-control" id="inputName" name="country_final"
                                title="يرجي ادخال دولة العميل" value="{{$shipping->country_final}}" readonly>
                        </div>

                    </div>


<div class="row">
    <div class="col">
        <label for="exampleTextarea">حالة الشحن</label>
        <select class="form-control" id="Status" name="Status" required>
            <option selected="true" disabled="disabled">-- حدد حالة الشحن --</option>
            <option value="قيد الانتظار">قيد الانتظار</option>
            <option value="تم الشحن">تم الشحن</option>
            <option value="تحت التوصيل">تحت التوصيل</option>
            <option value="ملغى">ملغى</option>
        </select>
    </div>

    <div class="col">
        <label>تاريخ  التغيير</label>
        <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
            type="text" >
    </div>


</div><br>

<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">تحديث الحالة </button>
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
