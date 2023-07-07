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
                    <form action="{{ route('shippings.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">المسمى</label>
                                <input type="text" class="form-control" id="inputName" name="name"
                                    title="يرجي ادخال إسم الشحن" required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">رقم العميل</label>
                                <input type="number" class="form-control" id="code"  name="code"
                                    title="يرجي إدخال رقم العميل"  >
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">إسم العميل</label>
                                <input type="text" class="form-control" id="customerName"  name="customer_name"
                                    title="واتقو الله يجعل لكم مخرجا"  >
                            </div>
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>تاريخ الشحن</label>
                                <input class="form-control fc-datepicker" name="date_origin" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">نوع الشحن</label>
                                <select name="method_id" class="form-control SlectBox" >
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد نوع الشحن</option>
                                    @foreach ($methods as $method)
                                        <option value="{{ $method->id }}"> {{ $method->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">الوصف</label>
                                <textarea class="form-control" id="exampleTextarea" name="description" rows="3"></textarea>
                            </div>
                        </div><br>
                        <h4 class="card-title mg-b-12">معلومات الطرد</h4>

                        <div id="products-container">
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">إسم المنتج</label>
                                    <input type="text" class="form-control" id="inputName" name="product_name[]"
                                        title="يرجي ادخال إسم المنتج" >
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">الوصف</label>
                                    <input type="text" class="form-control" id="inputName" name="product_description[]"
                                        title="يرجي ادخال إسم المنتج" >
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">الحجم</label>
                                    <select name="volume[]" class="form-control SlectBox" id="">
                                        <option value="شوال">شوال</option>
                                        <option value="كولي صغير ">كولي صغير</option>
                                        <option value="كولي كبير">كولي كبير</option>
                                        <option value="نص">نص 1/2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row product-row">
                                <div class="col">
                                    <label for="inputName" class="control-label">الكمية</label>
                                    <input type="number" class="form-control" onchange="calculateTotal()" id="quantity" name="quantity[]"
                                        title="يرجي إدخال رقم الهاتق" value="0" >
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">ماركة </label>
                                    <select name="marka[]" class="form-control SlectBox" id="">
                                        <option value="f1">F1</option>
                                        <option value="f2">F2</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">ثمن الوحدة</label>
                                    <input type="number" class="form-control" id="price" name="price[]"
                                        title="يرجي إدخال رقم الهاتق" value="0" onchange="calculateTotal()">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-right">
                            <button type="button" id="add-product-btn" style="border: 2px;" class="btn  mg-t-14">إضافة منتج</button>
                        </div>
                        <h4 class="card-title mg-b-12">الشحن من </h4>

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">العنوان</label>
                                <input type="text" class="form-control" id="inputName" name="adress_origin"
                                    title="يرجي ادخال عنوان العميل" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المدينة</label>
                                <input type="text" class="form-control" id="inputName" name="city_origin"
                                    title="يرجي ادخال مدينة العميل" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">رقم الهاتف </label>
                                <input type="text" class="form-control" id="inputName" name="phone_origin"
                                    title="يرجي ادخال عنوان العميل" >
                            </div>

                        </div>
                        <h4 class="card-title mt-4  mg-b-12">الشحن إلى </h4>

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">العنوان</label>
                                <input type="text" class="form-control" id="inputName" name="adress_final"
                                    title="يرجي ادخال عنوان العميل" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المدينة</label>
                                <input type="text" class="form-control" id="inputName" name="city_final"
                                    title="يرجي ادخال مدينة العميل" >
                            </div>

                            <div class="col">
                            <label for="inputName" class="control-label" > رقم الهاتف المستلم</label>
                            <input type="text" class="form-control" id="inputName" name="phone_final"
                                title="يرجي ادخال عنوان العميل" >
                        </div>

                        </div>
                        <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">الضريبة</label>
                            <input type="number" class="form-control"oninput="calculateTotal()" id="tax" name="tax"
                                title="يرجي إدخال رقم الهاتق"  value="0" >
                        </div>
                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total-net" name="Total" readonly>
                            </div>
                        </div>
                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>

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
         $(document).ready(function() {

$('#code').on('change', function() {
    var code = $(this).val();
if (code) {
    $.ajax({
        url: "{{ URL::to('customer') }}/" + code,
        type: "GET",
        dataType: "json",
        success: function(data) {
                    var customername= data.name;
                    var customer_id =data.id;
                    console.log(data);
                    $('#customerName').val(customername);
                    $('#customer_id').val(customer_id);
        },
        error: function() {
            console.log('AJAX request failed');
        }
    });
} else {
    // Clear and disable the tax dropdown
    $('#Rate_VAT').empty().append('<option value="" selected disabled>قم بتحديث الصفحة </option>').prop('disabled', false);
}
}) })
  function myFunction() {
    var Rate_VAT = parseFloat(document.getElementById("tax-rate").value);
    var total = parseFloat(document.getElementById("total").value);

    var tax_amount = total * (Rate_VAT / 100);
    var net = total - tax_amount;

    document.getElementById("Value_VAT").value = tax_amount.toFixed(2);
    document.getElementById("Total-net").value = net.toFixed(2);
}

</script>
<script>
function calculateTotal() {
  var total = 0;
  var taxAmount = parseFloat($('#tax').val()) || 0; // Get the tax amount entered by the user

  // Iterate over each product row
  $('.product-row').each(function() {
    var quantity = parseInt($(this).find('#quantity').val());
    var pricePerItem = parseFloat($(this).find('#price').val());
    if (!isNaN(quantity) && !isNaN(pricePerItem)) {
      var productTotal = quantity * pricePerItem;

      // Add the individual product total to the overall total
      total += productTotal;
    }
  });

  var totalWithTax = total + taxAmount;

  // Update the tax amount and total fields
  $('#tax-amount').val(taxAmount.toFixed(2));
  $('#Total-net').val(totalWithTax.toFixed(2));
}

// Call calculateTotal initially
calculateTotal();

// Call calculateTotal whenever the quantity, price, or tax amount changes


// function calculateTax() {
//   var total = parseFloat($('#Total-net').val());
//   var taxAmount = parseFloat($('#tax').val());
//   var totalWithTax = total + taxAmount;
//   $('#Total-net').val(totalWithTax.toFixed(2));
// }
</script>

@endsection
