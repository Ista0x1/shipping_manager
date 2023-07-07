@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">فاتورة </h1>
                            <div class="billed-from">
                                <h6>cherincargo.</h6>
                                <p>aksaray fatih St., istanbul, turkey<br>
                                    Tel No: 324 445-4544<br>
                                    Email: cherincargo@gmail.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">العميل</label>
                                <div class="billed-to">
                                    <h6>{{$invoices->customer->name}}</h6>
                                    <p>{{$invoices->customer->address}}<br>
                                        Tel No: {{$invoices->customer->phone}}<br>
                                        Email: {{$invoices->customer->email}}</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{ $invoices->name }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                    <span>{{ $invoices->invoice_date }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الاستحقاق</span>
                                    <span>{{ $invoices->due_date }}</span></p>

                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    @if ($isshipping==0)
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">المنتج</th>
                                        <th class="tx-center">ثمن الوحدة</th>
                                        <th class="tx-right">الكمية</th>
                                        <th class="tx-right">الاجمالي</th>
                                    </tr>
                                    @else
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">المسمى</th>
                                        <th class="tx-center">نوع الشحن </th>
                                        <th class="tx-right">من</th>
                                        <th class="tx-right">إلى</th>
                                    </tr>
                                    @endif

                                </thead>
                                <tbody>
                                    @php
                                    $total = $invoices->total;
                                    @endphp
                                    @if ($isshipping ==0)
                                    @foreach ($invoice_details as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="tx-12">{{ $item->product_name }}</td>
                                        <td class="tx-center">{{ number_format($item->priceperitem, 2) }}</td>
                                        <td class="tx-right">{{ number_format($item->quantity, 2) }}</td>
                                        @php
                                        $total = $invoices->total; ;
                                        @endphp
                                        <td class="tx-right">
                                            {{ number_format($total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else

                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{ $shipping->name }}</td>
                                        <td class="tx-center">{{$shipping->method->name}}</td>
                                        <td class="tx-right">{{ $shipping->city_origin}}</td>
                                        <td class="tx-right">{{ $shipping->city_final}}</td>
                                        @php

                                        $total = $shipping->total;
                                        @endphp
                                    </tr>

                                    @endif



                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">#</label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">الاجمالي</td>
                                        <td class="tx-right" colspan="2"> {{$total}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">نسبة الضريبة ()</td>
                                        <td class="tx-right" colspan="2">{{ $invoices->tax->tax_rate}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">قيمة الضريبة</td>
                                        <td class="tx-right" colspan="2"> {{ number_format($invoices->tax_amount, 2) }}</td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format($invoices->total, 2) }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
