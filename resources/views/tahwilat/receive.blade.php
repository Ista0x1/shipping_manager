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
إرسال
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    سحب</span>
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
                    <form action="{{ route('out.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <a href="{{ URL::to('getremaining') }}/1">hh</a>
                                <label for="inputName" class="control-label"> رقم العميل </label>
                                <input type="number" class="form-control" id="customer_code" name="customer_code"
                                    title="يرجي ادخال رقم العميل" required>
                            </div>
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id">
                            <div class="col">
                                <label for="inputName" class="control-label">إسم المحل </label>
                                <input type="text" class="form-control" id="customerName" name="recipient_name"
                                    title="يرجي ادخال إسم " required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">المدينة </label>
                                <input type="text" class="form-control" id="inputName" name="city"
                                    title="يرجي ادخال إسم الشحن" required>
                            </div>
                            <div class="col">
                                <label>تاريخ العملية</label>
                                <input class="form-control fc-datepicker" name="trans_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" >
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">العملة</label>
                                <select id="currency" name="currency" class="form-control SlectBox" >
                                    <!--placeholder-->
                                   <option value="euro">الأورو</option>
                                   <option value="dollar">الدولار</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المبلغ</label>
                                <input type="number" onchange="amount()" class="form-control" id="inputAmount" name="amount" title="يرجى إدخال المبلغ">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">الباقي</label>
                                <input type="number" class="form-control" id="inputRemaining" name="remaining" title="يرجى إدخال الباقي" readonly>
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
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script>
//      $(document).ready(function() {
//     $('#customer_id','#currency').on('change', function() {
//         var customerId = $('#customer_id').val();
//         var currency = $('#currency').val();
//         if (customerId && currency)  {
//             $.ajax({
//                 url: "{{ URL::to('getremaining') }}/" + customerId ,
//                 type: "GET",
//                 dataType: "json",
//                 success: function(data) {
//                     console.log(data);
//                     if (currency === 'euro') {
//                         $('#inputRemaining').val(data.remaining_euro);
//                     } else if (currency === 'dollar') {
//                         $('#inputRemaining').val(data.remaining_dollar);
//                     }
//                 },
//                 error: function() {
//                     console.log('AJAX request failed');
//                     alert('العميل ليس لديه رصيد ');
//                 }
//             });
//         } else {
//             console.log('Invalid customer ID or currency');
//         }
//     });
// });
$(document).ready(function() {
    var customerId = '';
    var currency = '';
    var originalRemaining = 0;

    $('#customer_code').on('change', function() {
        customerId = $(this).val();
        updateRemaining();
    });

    $('#currency').on('change', function() {
        currency = $(this).val();
        updateRemaining();
    });

    $('#inputAmount').on('change', function() {
        var amount = $(this).val();
        if (amount) {
            var updatedRemaining = originalRemaining - parseFloat(amount);
            if (!isNaN(updatedRemaining)) {
                $('#inputRemaining').val(updatedRemaining);
            } else {
                $('#inputRemaining').val(originalRemaining);
            }
        } else {
            $('#inputRemaining').val(originalRemaining);
        }
    });

    function updateRemaining() {
        if (customerId && currency) {
            $.ajax({
                url: "{{ URL::to('getremaining') }}/" + customerId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if (currency === 'euro') {
                        originalRemaining = data.remaining_euro;
                        $('#inputRemaining').val(originalRemaining);
                    } else if (currency === 'dollar') {
                        originalRemaining = data.remaining_dollar;
                        $('#inputRemaining').val(originalRemaining);
                    }
                },
                error: function() {
                    console.log('AJAX request failed');
                    alert('العميل ليس لديه رصيد ');
                }
            });
        } else {
            console.log('Invalid customer ID or currency');
        }
    }
});


$(document).ready(function() {

$('#customer_code').on('change', function() {
    var customerId = $(this).val();
if (customerId) {
    $.ajax({
        url: "{{ URL::to('customer') }}/" + customerId,
        type: "GET",
        dataType: "json",
        success: function(data) {
                    var customername= data.name;
                    var customer_id = data.id;
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
</script>
<script>
var initialRemaining;
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection
