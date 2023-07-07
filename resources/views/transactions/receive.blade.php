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
                    <form action="{{ route('receive.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">العميل</label>
                                <select name="customer_id" onchange="gettrans()"  class="form-control SlectBox" >
                                    <!--placeholder-->

                                    <option value="" selected disabled>إختر العميل</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"> {{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">العملية</label>
                                <select id="trans" name="trans" onchange="getremaining()" class="form-control SlectBox" >
                                    @foreach ($trans as $item)
                                        <option value="{{$item->id}}">{{$item->transaction_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">المدينة </label>
                                <input type="text" class="form-control" id="inputName" name="city"
                                    title="يرجي ادخال إسم الشحن" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>تاريخ العملية</label>
                                <input class="form-control fc-datepicker" name="trans_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" >
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
       function  gettrans() {
    // Bind the change event outside the function
    $('select[name="customer_id"]').on('change', function() {
        // Move the function inside the event handler

            var customerId = $(this).val();
            if (customerId) {
                $.ajax({
                    url: "{{ URL::to('gettrans') }}/" + customerId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#trans').empty();
                        $.each(data, function(key, value) {
                            $('#trans').append('<option value="' + value + '">' + key + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }      // Call the function inside the event handler
    });
}
</script>
<script>
 var initialRemaining;

$(document).ready(function() {
    // Function to retrieve the initial remaining value via AJAX
    function getInitialRemaining(transId) {
        if (transId) {
            $.ajax({
                url: "{{ URL::to('getremaining') }}/" + transId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var re = data[0];
                    initialRemaining = parseFloat(re);
                    console.log(initialRemaining);
                    updateRemaining();
                },
                error: function() {
                    console.log('AJAX request failed');
                }
            });
        } else {
            // Clear and disable the tax dropdown
        }
    }

    // Function to update the remaining value
    function updateRemaining() {
        var totalAmount = 0;
        var remaining = initialRemaining;

        // Calculate the accumulated amount from all 'inputAmount' elements
        $('input[name="amount"]').each(function() {
            var amount = parseFloat($(this).val());

            if (!isNaN(amount)) {
                totalAmount += amount;
            }
        });

        if (!isNaN(remaining)) {
            var newRemaining = initialRemaining - totalAmount;
            $('#inputRemaining').val(newRemaining);
        }
    }

    // Retrieve the initial remaining value when the transaction select changes
    $('select[name="trans"]').on('change', function() {
        var transId = $(this).val();
        getInitialRemaining(transId);
    });

    // Update the remaining value when the amount input changes
    $('input[name="amount"]').on('change', function() {
        updateRemaining();
    });
});
</script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection
