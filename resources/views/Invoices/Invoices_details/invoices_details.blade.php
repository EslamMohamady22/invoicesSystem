@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة </span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('msq.msg')
    @include('msq.msg')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style3">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{ $invoice->section->section_name }}
                    </div>
                    <p class="mg-b-20">تفاصيل الفاتورة الخاصة ب {{ $invoice->section->section_name }}</p>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-3">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class=""><a href="#tab11" class="active" data-toggle="tab"><i
                                                        class="fa fa-laptop"></i> تفاصيل الفاتورة</a></li>
                                            <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cogs"></i> حالات الدفع
                                                </a></li>
                                            <li><a href="#tab13" data-toggle="tab"><i class="fa fa-cube"></i> مرفقات
                                                    الفاتورة</a></li>
                                            {{-- <li><a href="#tab14" data-toggle="tab"><i class="fa fa-tasks"></i> Tab Style
                                                    04</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div style="background-color: white" class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane row mg-t-20 active" id="tab11">
                                            <div class="col-md">
                                                <label class="tx-gray-600">تفاصيل فاتورة خاصة ب </label>
                                                <div class="billed-to">
                                                    <h6>{{ $invoice->section->section_name }}</h6>
                                                    {{-- <p>4033 Patterson Road, Staten Island, NY 10301<br> --}}
                                                    {{-- Tel No: 324 445-4544<br> --}}
                                                    {{-- Email: youremail@companyname.com</p> --}}
                                                </div>
                                            </div>
                                            <div style="box-sizing: border-box;" class="col-md ">
                                                <label class="tx-gray-600">معلومات عن الفاتورة </label>
                                                <p class="invoice-info-row"><span> رقم الفاتورة</span>
                                                    <span>{{ $invoice->invoice_number }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span>تاريخ الفاتورة </span>
                                                    <span>{{ $invoice->invoice_Date }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span>تاريخ الأستحقاق :</span>
                                                    <span>{{ $invoice->Due_date }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span>اسم المنتج :</span>
                                                    <span>{{ $invoice->product }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span> قيمة الخصم</span>
                                                    <span>{{ $invoice->Discount }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span> نسبة الضريبة</span>
                                                    <span>{{ $invoice->Rate_VAT }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span> قيمة الضريبة:</span>
                                                    <span>{{ $invoice->Value_VAT }}</span>
                                                </p>
                                                <p class="invoice-info-row"><span>ملاحظات :</span>
                                                    <span>{{ $invoice->note }}</span>
                                                </p>
                                                <p class="tx-right tx-uppercase tx-bold tx-inverse"> الأجمالى</p>
                                                <p class="tx-right" colspan="2">
                                                <h4 class="tx-primary tx-bold">{{ $invoice->Total }} جنيه مصرى</h4>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane row mg-t-20 " id="tab12">
                                            <div class="col-md">
                                                <label class="tx-gray-600">تفاصيل فاتورة خاصة ب </label>
                                                <div class="billed-to">
                                                    <h6>{{ $invoice->section->section_name }}</h6>
                                                    {{-- <p>4033 Patterson Road, Staten Island, NY 10301<br> --}}
                                                    {{-- Tel No: 324 445-4544<br> --}}
                                                    {{-- Email: youremail@companyname.com</p> --}}
                                                    <label class="tx-gray-600">معلومات عن الفاتورة </label>
                                                </div>
                                            </div>
                                            <div style=" padding: 10px;">
                                                @foreach ($invoice_details as $invoice_details)
                                                    <div class="col-md "
                                                        style="background-color: rgba(221, 255, 255, 0.2) ; padding: 20px 20px 20px 20px; margin: 0px 0px 40px 0px;">

                                                        <p class="invoice-info-row"><span> القائم بتسجيل الفاتورة</span>
                                                            <span>{{ $invoice_details->user }}</span>
                                                        </p>
                                                        @if ($invoice_details->value_status == 1)
                                                            <p class="invoice-info-row "><span> حالة الدفع </span> <span
                                                                    class=" badge badge-bill badge-success">{{ $invoice_details->status }}</span>
                                                            </p>
                                                            <p class="invoice-info-row"><span>تاريخ الدفع :</span>
                                                            <span>{{ $invoice_details->Payment_Date }}</span>
                                                        </p>
                                                        @elseif ($invoice_details->value_status == 2)
                                                            <p class="invoice-info-row "><span> حالة الدفع </span> <span
                                                                    class=" badge badge-bill badge-danger">{{ $invoice_details->status }}</span>
                                                            </p>
                                                        @else
                                                            <p class="invoice-info-row "><span> حالة الدفع </span> <span
                                                                    class=" badge badge-bill badge-warning">{{ $invoice_details->status }}</span>
                                                            </p>
                                                            <p class="invoice-info-row"><span>تاريخ الدفع :</span>
                                                            <span>{{ $invoice_details->Payment_Date }}</span>
                                                        </p>
                                                        @endif

                                                    </div>
                                                    <br class="mg-b-80">
                                                @endforeach
                                            </div>
                                        </div>



                                        <div class="tab-pane row mg-t-20 " id="tab13">
                                            <div class="col-md">
                                                {{-- <label class="tx-gray-600">تفاصيل فاتورة خاصة ب </label> --}}
                                                <div class="billed-to">
                                                    <h2> مرفقات الفاتورة رقم {{ $invoice->invoice_number }}</h2>
                                                    {{-- <p>4033 Patterson Road, Staten Island, NY 10301<br> --}}
                                                    {{-- Tel No: 324 445-4544<br> --}}
                                                    {{-- Email: youremail@companyname.com</p> --}}
                                                    {{-- <label class="tx-gray-600">معلومات عن الفاتورة </label> --}}
                                                </div>
                                            </div>
                                            <div class="col" style=" max-width: 95%; background-color: #e1e6f1;  border: 2px  ;border-radius: 25px;  margin: 20px 20px 10px 20px ; ">
                                                <div class="col-md" style="  padding: 20px 20px 10px 20px ;">
                                                    <p class="invoice-info-row"><span>  تحميل مرفق جديد </span>
                                                        <span>
                                                            </span>
                                                    </p>
                                                    <span class="invoice-info-row">
                                                        <form action="{{ route('invoice_attachments.store') }}" method="POST" enctype="multipart/form-data" >
                                                            @csrf
                                                            <input  class="btn btn-success float-left mt-2 mr-2" type="file" name="file">
                                                            <input  class="btn btn-success float-left mt-2 mr-2" type="hidden" value="{{ $invoice->invoice_number}} " name="invo_num" >
                                                            <input  class="btn btn-success float-left mt-2 mr-2" type="hidden" value="{{ $invoice->id }}" name="invo_id">
                                                            <button class="btn btn-success float-left mt-2 mr-2"
                                                                type="submit">
                                                                <i class="far fa-arrow-alt-circle-down ml-1"></i>
                                                                اضافة
                                                            </button>
                                                        </form>
                                                    </span>
                                                </div>
                                            </div>

                                            @foreach ($invoice_attachment as $invoice_attachment)
                                                <div class="col" style=" max-width: 95%; background-color: rgba(221, 255, 255, 0.8);  border: 2px  ;border-radius: 25px;  margin: 20px 20px 10px 20px ; ">
                                                    <div class="col-md" style="  padding: 20px 20px 10px 20px ;">
                                                        <p class="invoice-info-row"><span> اسم الملف</span>
                                                            <span>{{ $invoice_attachment->file_name }}</span>
                                                        </p>
                                                        <p class="invoice-info-row"><span>تاريخ الأضافة </span>
                                                            <span>{{ $invoice_attachment->created_at }}</span>
                                                        </p>
                                                        <p class="invoice-info-row"><span>قام بالأضافة :</span>
                                                            <span>{{ $invoice_attachment->Created_by }}</span>
                                                        </p>

                                                    </div>
                                                    <div class="row" style="padding: 10px 20px 20px 20px">
                                                        <input type="hidden" name="file"
                                                            value="{{ $invoice_attachment->file_name }}">
                                                        <input type="hidden" name="invo_num"
                                                            value="{{ $invoice_attachment->invoice_number }}">
                                                        <a data-effect="effect-scale" data-toggle="modal"
                                                            href="#modaldemo9"
                                                            data-invoice_num="{{ $invoice_attachment->invoice_number }}"
                                                            data-invo_id="{{ $invoice_attachment->id }}"
                                                            data-file_name="{{ $invoice_attachment->file_name }}"
                                                            class="btn btn-danger float-left mt-2 mr-2" type="submit">
                                                            <i class="mdi mdi-telegram ml-1"></i>حذف المرفق
                                                        </a>
                                                        <form action="{{ url('/downloadfile') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="file"
                                                                value="{{ $invoice_attachment->file_name }}">
                                                            <input type="hidden" name="invo_num"
                                                                value="{{ $invoice_attachment->invoice_number }}">
                                                            <button class="btn btn-success float-left mt-2 mr-2"
                                                                type="submit">
                                                                <i class="far fa-arrow-alt-circle-down ml-1"></i>تحميل
                                                                المرفق
                                                            </button>
                                                        </form>
                                                        <form action="{{ url('viewfile/') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="file"
                                                                value="{{ $invoice_attachment->file_name }}">
                                                            <input type="hidden" name="invo_num"
                                                                value="{{ $invoice_attachment->invoice_number }}">
                                                            <button class="btn btn-purple float-left mt-2 mr-2"
                                                                type="submit">
                                                                <i class=" ml-1 far fa-eye"></i>عرض المرفق
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                                <br class="mg-b-80">
                                            @endforeach

                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---Prism Pre code-->
                    </div>
                    <!-- /div -->
                </div>
                <!-- delete -->
                <div class="modal" id="modaldemo9">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ url('/deletefile') }}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                    <input type="hidden" name="invo_id" id="invo_id" value="">
                                    <input type="text" name="file" id="file_name" value="">
                                    <input class="form-control" name="invo_num" id="invoice_num" type="text"
                                        readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@section('js')
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invo_id = button.data('invo_id')
            var invoice_num = button.data('invoice_num')
            var file = button.data('file_name')
            // var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #invo_id').val(invo_id);
            modal.find('.modal-body #invoice_num').val(invoice_num);
            modal.find('.modal-body #file_name ').val(file);
            // modal.find('.modal-body #description').val(description);
        })
    </script>
@endsection
