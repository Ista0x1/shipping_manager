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
    تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<style>
    .row {
        padding-top: 12px;
        padding-bottom: 12px;
    }
</style>
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.update', ['invoice' => $invoices->id])}}" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="invoice_id" value="{{$invoices->id}}">
                                <label for="inputName" class="control-label">إسم الفاتورة</label>
                                <input type="text" class="form-control" id="inputName" value="{{$invoices->name}}" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" >
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->invoice_date }}" >
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{$invoices->due_date}}">
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">العميل</label>
                                <select name="customer" id="customer_drop" class="form-control" >
                                <!--placeholder-->
                                <option value="{{$customer->id}}" selected > {{$customer->name}}</option>
                                @foreach($customers as $customerss)
                             {{-- i added ss just for to make customer i mentioned before not as this  --}}
                                <option value="{{$customerss->id}}">{{$customerss->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">الشحن</label>
                                <select id="shipping-dropdown" name="shipping" class="form-control">
                                    <option value="">فاتورة بدون شحن</option>
                                        <option value="{{$invoice_details->product_name}}" selected>{{$invoice_details->product_name}}</option>
                                </select>
                            </div>
                            <div class="col">
                                <label  for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="tax" id="Rate_VAT" onchange="calculateTaxAmount()"  class="form-control" >
                                    <!--placeholder-->
                                    <option value="{{$tax->id}}" selected > {{$tax->name}}</option>
                                    @foreach($taxes as $t)
                                    <option value="{{$t->id}}" data-rate="{{$t->tax_rate}}">{{$t->name}}</option>
                                  @endforeach
                                </select>
                            </div>

                        </div>
                        <div id="hide-product">
                        <div id="products-section" style="border:1px black;">
                            <div class="row product-row">
                                <div class="col">
                                    <label for="inputName" class="control-label">إسم المنتج</label>
                                    <input type="text" class="form-control" id="inputName" name="product_name[]"
                                        title="يرجى إدخال اسم المنتج">
                                </div>
                                <div class="col">
                                    <label for="pricePerItem" class="control-label">ثمن الوحدة</label>
                                    <input type="number" class="form-control input-price" id="pricePerItem" name="priceperitem[]"
                                        title="يرجى إدخال ثمن الوحدة" value="0" oninput="calculateTotal()">
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">الكمية</label>
                                    <input type="number" class="form-control input-quantity" id="inputQuantity" name="quantity[]"
                                        title="يرجى إدخال الكمية" value="0" oninput="calculateTotal()">
                                </div>
                            </div>


                        </div>
                            <div class="d-flex justify-content-right">
                                <button type="button" id="add-product-btn" style="border: 2px;" class="btn  mg-t-14">إضافة منتج</button>
                            </div>
                        </div>

                        {{-- 3 --}}



                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" value="{{$invoices->tax_amount}}" name="Value_VAT" >
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" value="{{$invoices->total}}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
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

    $('select[name="shipping"]').on('change', function() {
        var shippingId = $(this).val();
    if (shippingId) {
        $.ajax({
            url: "{{ URL::to('shipping') }}/" + shippingId,
            type: "GET",
            dataType: "json",
            success: function(data) {

                        var taxId = data.taxes[0].id;
                        var customerId= data.customers[0].id;
                        var tax_amount= data.shipping.tax_amount;
                        var total = data.shipping.total;
                        console.log(data.shipping.total);
                        $('#Value_VAT').val(tax_amount);
                        $('#Total').val(total);
                        $('#Rate_VAT').val(taxId);
                        $('#customer_drop').val(customerId);
            },
            error: function() {
                console.log('AJAX request failed');
            }
        });
    } else {
        // Clear and disable the tax dropdown
        $('#Rate_VAT').empty().append(' <option value="" selected disabled> حدد الضريبة</option>''
                                    @foreach($taxes as $tax)''
                                    <option value="{{$tax->id}}" data-rate="{{$tax->tax_rate}}">{{$tax->name}}</option>  @endforeach').prop('disabled', false);
    }

    // function reloadTaxOptions(taxes) {
    //     var taxDropdown = $('#Rate_VAT');
    //     taxDropdown.empty(); // Clear existing options

    //     if (taxes.length > 0) {
    //         // Add new options based on returned taxes
    //         $.each(taxes, function(index, tax) {
    //         taxDropdown.append('<option value="' + tax.id + '">' + tax.name + '</option>');
    //         //taxDropdown.append('<option value""> nothinh here </option>');
    //         });
    //         taxDropdown.prop('disabled', false); // Enable the tax dropdown
    //     } else {
    //         // No taxes available, disable the tax dropdown
    //         taxDropdown.append('<option value="" selected disabled>No taxes available</option>');
    //         taxDropdown.prop('disabled', true);
    //     }


 }) })
</script>





    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }

    </script>

<script>
   function calculateTotal() {
  var total = 0;

  // Iterate over each product row
  $('.product-row').each(function() {
    var quantity = parseInt($(this).find('.input-quantity').val());
    var pricePerItem = parseFloat($(this).find('.input-price').val());
    var productTotal = quantity * pricePerItem;

    // Add the individual product total to the overall total
    total += productTotal;
  });

  // Update the Total field value
  $('#Total').val(total.toFixed(2));
}
function calculateTaxAmount() {
    var selectedOption = $('#Rate_VAT option:selected');
    var taxRate = parseFloat(selectedOption.data('rate'));
    var total = parseFloat($('#Total').val());

    if (isNaN(taxRate) || isNaN(total)) {
      $('#Value_VAT').val('');
      return;
    }

    var taxAmount = (taxRate / 100) * total;
    $('#Value_VAT').val(taxAmount.toFixed(2));
  }
$(document).ready(function() {
  $('#add-product-btn').click(function() {
    // Create a new product row
    var newProductRow =
      '<div class="row product-row">' +
      '  <div class="col">' +
      '    <label for="inputName" class="control-label">إسم المنتج</label>' +
      '    <input type="text" class="form-control" name="product_name[]" title="يرجى إدخال اسم المنتج">' +
      '  </div>' +
      '  <div class="col">' +
      '    <label for="inputName" class="control-label">ثمن الوحدة</label>' +
      '    <input type="number" class="form-control input-price" oninput="calculateTotal()" name="priceperitem[]" title="يرجى إدخال ثمن الوحدة">' +
      '  </div>' +
      '  <div class="col">' +
      '    <label for="inputName" class="control-label">الكمية</label>' +
      '    <input type="number" class="form-control input-quantity" oninput="calculateTotal()" name="quantity[]" title="يرجى إدخال الكمية" value="0">' +
      '  </div>' +
      '</div>';

    // Append the new product row to the container
    $('#products-section').append(newProductRow);
  });
});

  </script>
  <script>
    $(document).ready(function() {
        // Target the shipping dropdown
        var shippingDropdown = $('#shipping-dropdown');

        // Target the products section container
        var productsSection = $('#hide-product');
        productsSection.hide();
        // Hide or show the products section based on the shipping dropdown value
        shippingDropdown.on('change',function() {
            var selectedValue = $(this).val();

            if (selectedValue == '') {
                productsSection.show();
            } else {


                productsSection.hide();
            }
        });
    });
</script>
@endsection
