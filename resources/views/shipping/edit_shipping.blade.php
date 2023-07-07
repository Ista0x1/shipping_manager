@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافة شحن
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إدارة الشحن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة شحن</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shippings.update', ['shipping' => $shipping->id])}}" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">إسم الشحن</label>
                                <input type="text" class="form-control" id="inputName" name="name"
                                    title="يرجى إدخال إسم الشحن" value="{{ $shipping->name ?? '' }}" required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">العميل</label>
                                <select name="customer_id" class="form-control SlectBox">
                                    <!-- placeholder -->
                                    <option value="{{ $shipping->customer->id ?? '' }}" selected>
                                        {{ $shipping->customer->name ?? 'Customer Not Found' }}
                                    </option>

                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"> {{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">رقم التتبع</label>
                                <input type="text" class="form-control" id="inputName" name="id"
                                    title="يرجى إدخال رقم الهاتق" value="{{ $shipping->id ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>تاريخ الشحن</label>
                                <input class="form-control fc-datepicker" name="date_origin" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $shipping->date_origin ?? '' }}" required>
                            </div>
                            <div class="col">
                                <label>تاريخ الوصول</label>
                                <input class="form-control fc-datepicker" name="date_final" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $shipping->date_final ?? '' }}">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">نوع الشحن</label>
                                <select name="method_id" class="form-control SlectBox">
                                    <!-- placeholder -->
                                    @if ($shipping->method != null)
                                        <option value="{{ $shipping->method->id }}" selected>
                                            {{ $shipping->method->name }}
                                        </option>
                                    @else
                                        <option value="" selected>Method Not Found</option>
                                    @endif

                                    @foreach ($methods as $method)
                                        <option value="{{ $method->id }}"> {{ $method->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">الوصف</label>
                                <textarea class="form-control" id="exampleTextarea" name="description"
                                    rows="3">{{ $shipping->description ?? '' }}</textarea>
                            </div>
                        </div>

                        </div><br>
                        <h4 class="card-title mg-b-12">معلومات الطرد</h4>

                        <div id="products-container">
                            @foreach ($products as $item)

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">إسم المنتج</label>
                                    <input type="text" class="form-control" id="inputName" name="product_name[]"
                                        title="يرجي ادخال إسم المنتج" value="{{$item->name}}" >
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">الوصف</label>
                                    <input type="text" class="form-control" id="inputName" name="product_description[]"
                                        title="يرجي ادخال إسم المنتج" value="{{$item->description}}" >
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">الكمية</label>
                                    <input type="number" class="form-control" id="inputName" name="quantity[]"
                                        title="يرجي إدخال رقم الهاتق" value="{{$item->quantity}}" >
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">الحجم</label>
                                    <select name="volume[]" class="form-control SlectBox" id="">
                                        <option value="{{$item->volume}}" selected>{{$item->volume}}</option>
                                        <option value="شوال">شوال</option>
                                        <option value="كولي صغير ">كولي صغير</option>
                                        <option value="كولي كبير">كولي كبير</option>
                                        <option value="نص">نص 1/2</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">ماركة </label>
                                    <select name="marka[]" class="form-control SlectBox" id="">
                                        <option value="{{$item->brand}}" selected>{{$item->brand}}</option>
                                        <option value="f1">F1</option>
                                        <option value="f2">F2</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">ثمن الوحدة</label>
                                    <input type="number" class="form-control" id="price" name="price[]"
                                        title="يرجي إدخال رقم الهاتق" value="{{$item->priceperitem}}" onchange="calculateTotal()">
                                </div>

                            </div>

                            @endforeach
                        </div>
                        <div class="d-flex justify-content-right">
                            <button type="button" id="add-product-btn" style="border: 2px;" class="btn  mg-t-14">إضافة منتج</button>
                        </div>
                        {{-- 2 --}}
                        {{-- <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد القسم</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control">
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div> --}}


                        {{-- 3 --}}
                        <h4 class="card-title mg-b-12">الشحن من </h4>

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">العنوان</label>
                                <input type="text" class="form-control" id="inputName" name="adress_origin"
                                    title="يرجي ادخال عنوان العميل" value="{{$shipping->adress_origin}}" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المدينة</label>
                                <input type="text" class="form-control" id="inputName" name="city_origin"
                                    title="يرجي ادخال مدينة العميل" value="{{$shipping->city_origin}}" >
                            </div>



                        </div>
                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">رقم الهاتف </label>
                                <input type="text" class="form-control" id="inputName" name="phone_origin"
                                    title="يرجي ادخال عنوان العميل" value="{{$shipping->phone_origin}}" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">إسم المرسل</label>
                                <input type="text" class="form-control" id="inputName" name="city"
                                    title="يرجي ادخال مدينة العميل" >
                            </div>



                        </div>
                        <h4 class="card-title mt-4  mg-b-12">الشحن إلى </h4>

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">العنوان</label>
                                <input type="text" class="form-control" id="inputName" name="adress_final"
                                    title="يرجي ادخال عنوان العميل" value="{{$shipping->adress_final}}" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المدينة</label>
                                <input type="text" class="form-control" id="inputName" name="city_final"
                                    title="يرجي ادخال مدينة العميل" value="{{$shipping->city_final}}" >
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label" > رقم الهاتف المستلم</label>
                                <input type="text" class="form-control" id="inputName" name="phone_final"
                                    title="يرجي ادخال عنوان العميل" value="{{$shipping->phone_final}}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">إسم المستلم</label>
                                <input type="text" class="form-control" id="inputName" name="city"
                                    title="يرجي ادخال مدينة العميل" >
                            </div>
                        </div>
                        <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">الإجمالي</label>
                            <input type="number" class="form-control" id="total" name="total"
                                title="يرجي إدخال رقم الهاتق" oninput="myFunction()" value="{{$shipping->total}}" >
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                            <input type="text" class="form-control" id="Value_VAT" name="tax_amount" value="{{$shipping->tax_amount}}" >
                        </div>
                        </div>



                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
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



<script>
    $(document).ready(function() {
      $('#add-product-btn').click(function() {
        // Create a new set of form fields
        var newProductFields =
        '<div class="row">' +
        '   <div class="col">' +
        '       <label for="inputName" class="control-label">إسم المنتج</label>' +
        '       <input type="text" class="form-control" id="inputName" name="product_name[]" title="يرجي ادخال إسم المنتج">' +
        '   </div>' +
        '   <div class="col">' +
        '       <label for="inputName" class="control-label">الوصف</label>' +
        '       <input type="text" class="form-control" id="inputName" name="product_description[]" title="يرجي ادخال إسم المنتج">' +
        '   </div>' +
        '   <div class="col">' +
        '       <label for="inputName" class="control-label">الحجم</label>' +
        '       <select name="volume[]" class="form-control SlectBox">' +
        '           <option value="شوال">شوال</option>' +
        '           <option value="كولي صغير">كولي صغير</option>' +
        '           <option value="كولي كبير">كولي كبير</option>' +
        '           <option value="نص">نص 1/2</option>' +
        '       </select>' +
        '   </div>' +
        '</div>' +
        '<div class="row product-row">' +
        '   <div class="col">' +
        '       <label for="inputName" class="control-label">الكمية</label>' +
        '       <input type="number" class="form-control" id="quantity" onchange="calculateTotal()" name="quantity[]" title="يرجي إدخال رقم الهاتق" value="0">' +
        '   </div>' +
        '   <div class="col">' +
        '       <label for="inputName" class="control-label">ماركة</label>' +
        '       <select name="marka[]" class="form-control SlectBox">' +
        '           <option value="f1">F1</option>' +
        '           <option value="f2">F2</option>' +
        '       </select>' +
        '   </div>' +
        '   <div class="col">' +
        '       <label for="inputName" class="control-label">ثمن الوحدة</label>' +
        '       <input type="number" class="form-control" id="price" onchange="calculateTotal()" name="price[]" title="يرجي إدخال رقم الهاتق" value="0">' +
        '   </div>' +
        '</div>';

        // Append the new fields to the container
        $('#products-container').append(newProductFields);
      });
    });
  </script>
    <script>
  function myFunction() {
    var Rate_VAT = parseFloat(document.getElementById("tax-rate").value);
    var total = parseFloat(document.getElementById("total").value);

    var tax_amount = total * (Rate_VAT / 100);
    var net = total - tax_amount;

    document.getElementById("Value_VAT").value = tax_amount.toFixed(2);
    document.getElementById("Total-net").value = net.toFixed(2);
}

</script>


@endsection
