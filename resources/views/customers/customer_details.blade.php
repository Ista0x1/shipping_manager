@extends('layouts.master')
@section('css')


    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل العميل
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إدارة العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل العميل</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    العميل</a></li>
                                          <li><a href="#tab7" class="nav-link" data-toggle="tab">الفواتير </a></li>
                                          <li><a href="#tab8" class="nav-link" data-toggle="tab">الشحن</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">التحويلات</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">المسمى</th>
                                                            <td>{{ $customer->name }}</td>
                                                            <th scope="row">الهاتف</th>
                                                            <td>{{ $customer->phone }}</td>
                                                            <th scope="row">البريد الإلكتروني</th>
                                                            <td>{{ $customer->email }}</td>
                                                            <th scope="row">رقم العميل</th>
                                                            <td>{{ $customer->id ?? 'غير معروف' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">الدولة</th>
                                                            <td>{{ $customer->country }}</td>
                                                            <th scope="row">المدينة</th>
                                                            <td>{{ $customer->city }}</td>
                                                            <th scope="row">العنوان</th>
                                                            <td>{{ $customer->adress }}</td>
                                                            {{-- <th scope="row">الحالة الحالية</th>
                                                            @if ($customer->status_value == 1)
                                                                <td><span class="badge badge-pill badge-success">{{ $customer->status }}</span></td>
                                                            @elseif ($customer->status_value == 2)
                                                                <td><span class="badge badge-pill badge-danger">{{ $customer->status }}</span></td>
                                                            @else
                                                                <td><span class="badge badge-pill badge-warning">{{ $customer->status }}</span></td>
                                                            @endif --}}
                                                        </tr>
                                                        {{-- <tr>
                                                            <th scope="row">ملاحظات</th>
                                                            <td>{{ $customer->note }}</td>
                                                        </tr> --}}
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <h4>المجموع</h4>
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>مجموع الأورو</th>
                                                            <th>الباقي</th>
                                                            <th>مجموع الدولار</th>
                                                            <th>الباقي</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                @if ($total)
                                                                    <td>{{ $total->total_euro }}</td>
                                                                    <td>{{$total->remaining_euro}}</td>
                                                                    <td>{{ $total->total_dollar}}</td>
                                                                    <td>{{ $total->remaining_dollar}}</td>
                                                                @endif

                                                            </tr>
                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="table-responsive mt-15">
                                                <h4>أرسل</h4>
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم العميل</th>
                                                            <th>المدينة</th>
                                                            <th>التاريخ</th>
                                                            <th>العملة</th>
                                                            <th>المبلغ</th>
                                                            <th>مبلغ الدينار</th>
                                                            <th>ثمن الشراء</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($trans as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $customer->id }}</td>
                                                                <td>{{$x->city}}</td>
                                                                <td>{{ $x->date}}</td>
                                                                <td>{{ $x->currency}}</td>
                                                                <td>{{$x->amount}}</td>
                                                                <td>{{ $x->dinar_amount }}</td>
                                                                <td>{{ $x->exchange}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="table-responsive mt-15">
                                                <h4>سحب</h4>
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>إسم الساحب</th>
                                                            <th>المدينة</th>
                                                            <th>التاريخ</th>
                                                            <th> المبلغ المسحوب</th>
                                                            <th>العملة</th>
                                                            <th>بواسطة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($receivs as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->recipient_name }}</td>
                                                                <td>{{$x->city}}</td>
                                                                <td>{{ $x->date}}</td>
                                                                <td>{{$x->amount_taken}}</td>
                                                                <td>{{$x->currency}}</td>
                                                                <td>{{$x->Created_by}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab7">
                                            <div class="table-responsive mt-15">
                                                <h4>الفواتير الخاصة بلعميل</h4>
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>إسم الفاتورة</th>
                                                            <th>الوصف</th>

                                                            <th>تاريخ الفاتورة </th>
                                                            <th>تاريخ الإستحقاق</th>
                                                            <th>قيمة الضريبة</th>
                                                            <th>الإجمالي</th>
                                                            <th>الحالة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($invoices as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->name }}</td>
                                                                <td>{{$x->description}}</td>
                                                                <td>{{$x->invoice_date}}</td>
                                                                <td>{{ $x->due_date }}</td>
                                                                <td>{{ $x->tax_amount }}</td>
                                                                <td>{{ $x->total }}</td>

                                                                    <td>
                                                                        @if ($x->status_value == 1)
                                                                            <span class="text-success">{{ $x->status }}</span>
                                                                        @elseif($x->status_value == 2)
                                                                            <span class="text-danger">{{ $x->status }}</span>
                                                                        @else
                                                                            <span class="text-warning">{{ $x->status }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button aria-expanded="false" aria-haspopup="true"
                                                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                                type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                            <div class="dropdown-menu tx-13">

                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('invoices.edit',$x->id)}}">تعديل
                                                                                        الفاتورة</a>



                                                                                    <a class="dropdown-item" href="#" data-invoice_id="{{ $x->id }}"
                                                                                        data-toggle="modal" data-target="#delete_invoice"><i
                                                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                                        الفاتورة</a>



                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('Status_show', $x->id) }}"><i
                                                                                            class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                                                        حالة
                                                                                        الدفع</a>



                                                                                    <a class="dropdown-item" href="#" data-invoice_id="{{ $x->id }}"
                                                                                        data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                                            class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                                                        الارشيف</a>



                                                                                    <a class="dropdown-item" href="Print_invoice/{{$x->id}}"><i
                                                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                                                        الفاتورة
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
                                        <div class="tab-pane" id="tab8">
                                            <div class="table-responsive mt-15">

                                                 <h4>الشحن الخاص بلعميل</h4>
                                                 <table class="table center-aligned-table mb-0 table-hover"
                                                 style="text-align:center">
                                                 <thead>
                                                     <tr class="text-dark">
                                                         <th>#</th>
                                                         <th>المسمى</th>
                                                         <th>الوصف</th>
                                                         <th>الإجمالي</th>
                                                         <th>الحالة</th>
                                                         <th>من</th>
                                                         <th>إلى</th>
                                                         <th>تاريخ الشحن </th>
                                                         <th>تاريخ الوصول</th>
                                                         <th>المزيد من المعلومات</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <?php $i = 0; ?>
                                                     @foreach ($shippings as $x)
                                                         <?php $i++; ?>
                                                         <tr>
                                                             <td><a href="{{route('shippings.show',$x->id)}}">{{ $loop->iteration }}</a></td>
                                                             <td>{{ $x->name }}</td>
                                                             <td>{{$x->description}}</td>
                                                             <td>{{ $x->total}}</td>
                                                             @if ($x->status_value == 1)
                                                             <td><span class="badge badge-pill badge-success">{{ $x->status }}</span></td>
                                                         @elseif ($x->status_value == 2)
                                                             <td><span class="badge badge-pill badge-danger">{{ $x->status }}</span></td>
                                                         @else
                                                             <td><span class="badge badge-pill badge-warning">{{ $x->status }}</span></td>
                                                         @endif
                                                         <td>{{$x->city_origin}}</td>
                                                         <td>{{$x->city_final}}</td>
                                                             <td>{{$x->date_origin}}</td>
                                                             <td>{{ $x->date_final }}</td>
                                                            <td><a href="{{route('shippings.show',$x->id)}}"></a></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button aria-expanded="false" aria-haspopup="true"
                                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                        type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                    <div class="dropdown-menu tx-13">

                                                                            <a class="dropdown-item"
                                                                                href="{{ route('shippings.edit',$x->id)}}">تعديل
                                                                            الشحن</a>



                                                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $x->id }}"
                                                                                data-toggle="modal" data-target="#delete_invoice"><i
                                                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                                الشحن</a>



                                                                            <a class="dropdown-item"
                                                                                href="{{ route('Status_shipping', $x->id) }}"><i
                                                                                    class=" text-success fas fa-pen"></i>&nbsp;&nbsp;تغير
                                                                                حالة
                                                                                الشحن</a>



                                                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $x->id }}"
                                                                                data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                                    class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                                                الارشيف</a>



                                                                            <a class="dropdown-item" href="print_shipping/{{$x->id}}"><i
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
                                            <div class="table-responsive mt-15">

                                                <h4>الطرود التي تم شحنها</h4>
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>إسم المنتج</th>
                                                        <th>الوصف</th>
                                                        <th>الحجم</th>
                                                        <th>الكمية</th>
                                                        <th>الماركة</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($products as $x)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td><a href="{{route('shippings.show',$x->id)}}">{{ $loop->iteration }}</a></td>
                                                            <td>{{ $x->product_name }}</td>
                                                            <td>{{$x->description}}</td>
                                                            <td>{{ $x->volume}}</td>
                                                            <td>{{ $x->quantity }}</td>
                                                        <td>{{$x->brand}}</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                           </div>
                                        </div>

                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">

                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{ route('customerattachments.store') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                    <input type="hidden" id="customer_name" name="customer_name"
                                                                    value="{{ $customer->name }}">
                                                                <input type="hidden" id="invoice_id" name="customer_id"
                                                                    value="{{ $customer->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>

                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($customer_attachments as $attachment)
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $attachment->file_name }}</td>
                                                                    <td>{{ $attachment->Created_by }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                        href="{{ url('view_file') }}/{{ $customer->name }}/{{ $attachment->file_name }}"
                                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                        عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download')  }}/{{ $customer->name }}/{{ $attachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>


                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $attachment->file_name }}"
                                                             data-invoice_id="{{ $attachment->customer_id }}"
                                                             data-id_file="{{ $attachment->id }}"
                                                             data-target="#delete_file">حذف</button>
                                                     </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                 </tbody>
                           </table>
                      </div>
                  </div>
              </div>
         </div>
      </div>
    </div>
  </div>
 </div>
</div>
</div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->

    <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form action="{{ url('invoicedetails/destroy') }}" method="delete">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_id" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_id = button.data('invoice_id')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>

    <script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>

@endsection
