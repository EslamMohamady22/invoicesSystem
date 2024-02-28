@extends('layouts.master')
@section('css')
@include('layouts.table_css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير مدفوعة جزئيا</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">

					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @include('msq.msg')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <a href="{{ route('invoices.create') }}" class="btn btn-primary mg-b-20">إضافة فاتورة</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive hoverable-table">
                                    <table id="example-delete" class="table text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم الفاتورة</th>
                                                <th>تاريخ الفاتورة</th>
                                                <th>تاريخ الأستحقاق</th>
                                                <th>المنتج</th>
                                                <th>القسم</th>
                                                <th>الخصم </th>
                                                <th>نسبة الضريبة </th>
                                                <th>قيمة الضريبة </th>
                                                <th>الأجمالى</th>
                                                <th>الحالة</th>
                                                <th>ملاحظات</th>
                                                <th>العمليات</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0 ;
                                            @endphp
                                            @foreach ($invoices as $invoice )
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $invoice->invoice_number }}</td>
                                                <td>{{ $invoice->invoice_Date }}</td>
                                                <td>{{ $invoice->Due_date }}</td>
                                                <td>{{ $invoice->product }}</td>
                                                <td>
                                                    <a href="{{ url('invoices_details/'.$invoice->id) }}" >
                                                        {{ $invoice->section->section_name }}
                                                    </a>
                                                </td>
                                                <td>{{ $invoice->Discount }}</td>
                                                <td>{{ $invoice->Rate_VAT }}</td>
                                                <td>{{ $invoice->Value_VAT }}</td>
                                                <td>{{ $invoice->Total }}</td>
                                                @if ($invoice->Value_Status == 1)
                                                    <td class="badge badge-bill badge-success mt-2" >{{ $invoice->Status }}</td>
                                                @elseif ($invoice->Value_Status == 2)
                                                    <td class="badge badge-bill badge-danger mt-2" >{{ $invoice->Status }}</td>
                                                @else
                                                    <td class="badge badge-bill badge-warning mt-2">{{ $invoice->Status }}</td>
                                                @endif
                                                <td>{{ $invoice->note }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                                        data-toggle="dropdown" id="dropdownMenuButton" type="button"> العمليات <i class="fas fa-caret-down ml-1"></i></button>
                                                        <div  class="dropdown-menu tx-13">

                                                            <a class="dropdown-item" href="{{ url('edit_invoice/'.$invoice->id) }}">  تعديل الفاتورة</a>
                                                            <a class="dropdown-item" data-effect="effect-scale"
                                                       data-id="{{ $invoice->id }}" data-toggle="modal"
                                                       href="#modaldemo9">  حذف الفاتورة</a>
                                                            {{-- <form action="{{ url('change_status_invoice') }}" method="post" >
                                                                @csrf
                                                                <input name="id" value="{{ $invoice->id }}" type="hidden" />
                                                                <button class="dropdown-item" >  تغير حالة الدفع </button>
                                                            </form> --}}
                                                            <a class="dropdown-item" href="{{ url('change_status_invoice/'.$invoice->id) }}">  تغير حالة الدفع </a>
                                                            <a class="dropdown-item" href="{{ url('archive_invoice/'.$invoice->id) }}">  نقل إلى الأرشيف   </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            {{-- <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr> --}}
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
                 <!-- delete -->
                    <div class="modal" id="modaldemo9">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                    type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ url('delete_invoice/'.$invoice->id) }}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        {{-- <input class="form-control" name="section_name" id="section_name" type="text" readonly> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@include('layouts.table_js')
<script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            // var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            // modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
@endsection
