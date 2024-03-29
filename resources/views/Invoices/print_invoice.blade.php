@extends('layouts.master')
@section('css')
<style>
    @media print{
        #print_button{display: none;}
    }
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة الفاتورة</span>
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
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
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
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id="divcontent">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">تفاصيل الفاتورة</h1>
										<div class="billed-from">
											<h6>BootstrapDash, Inc.</h6>
											<p>201 Something St., Something Town, YT 242, Country 6546<br>
											Tel No: 324 445-4544<br>
											Email: youremail@companyname.com</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										{{-- <div class="col-md">
											<label class="tx-gray-600">Billed To</label>
											<div class="billed-to">
												<h6>Juan Dela Cruz</h6>
												<p>4033 Patterson Road, Staten Island, NY 10301<br>
												Tel No: 324 445-4544<br>
												Email: youremail@companyname.com</p>
											</div>
										</div> --}}
										<div class="col-md">
											<label class="tx-gray-600">تفاصيل الفاتورة </label>
											<p class="invoice-info-row"><span> رقم الفاتورة</span> <span>{{ $invoice->invoice_number }}</span></p>
											<p class="invoice-info-row"><span> تاريخ الأصدار</span> <span>{{ $invoice->invoice_Date }}</span></p>
											<p class="invoice-info-row"><span> تاريخ الأستحقاق:</span> <span>{{ $invoice->Due_date }}</span></p>
											<p class="invoice-info-row"><span>القسم :</span> <span>{{ $invoice->section->section_name }}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
                                                    <th class="wd-20p">#</th>
													<th class="wd-20p">المنتج</th>
													<th class="wd-40p"> ملاحظات الفاتورة</th>
													<th class="tx-center">مبلغ التحصيل</th>
													<th class="tx-right"> مبلغ العمولة</th>
													<th class="tx-right">الأجمالى</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td> {{ $invoice->id }}</td>
													<td class="tx-12">{{ $invoice->product }}</td>
													<td class="tx-center">{{ $invoice->note }}</td>
													<td class="tx-right">{{ number_format($invoice->Amount_collection) }}</td>
													<td class="tx-right">{{ number_format($invoice->Amount_Commission) }}</td>
                                                    <td class="tx-right">{{ number_format($invoice->Amount_collection  +   $invoice->Amount_Commission)}}</td>
												</tr>
												<tr>
													<td class="valign-middle" colspan="2" rowspan="4">
														<div class="invoice-notes">
															<label class="main-content-label tx-13">  ملاحظات القسم</label>
															{{-- <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p> --}}
														</div>
                                                        <p>{{ $invoice->section->description }}.</p>
                                                        <!-- invoice-notes -->
													</td>
													<td class="tx-right">الأجمالى</td>
													<td class="tx-right" colspan="2">{{ number_format($invoice->Amount_collection +  $invoice->Amount_Commission)}}</td>
												</tr>
												<tr>
													<td class="tx-right">نسبة الضريبة ({{ $invoice->Rate_VAT }})</td>
													<td class="tx-right" colspan="2">{{ $invoice->Value_VAT }}</td>
												</tr>
												<tr>
													<td class="tx-right">قيمة الخصم</td>
													<td class="tx-right" colspan="2">-{{ $invoice->Discount }}</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse"> الأجمالى شامل الضريبة</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">{{ number_format($invoice->Total) }}</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">
									{{-- <a class="btn btn-purple float-left mt-3 mr-2" href="">
										<i class="mdi mdi-currency-usd ml-1"></i>Pay Now
									</a> --}}
									<a href="#" onclick="printdiv()" id="print_button" class="btn btn-danger float-left mt-3 mr-2">
										<i class="mdi mdi-printer ml-1"></i>Print
									</a>
									{{-- <a href="#" class="btn btn-success float-left mt-3">
										<i class="mdi mdi-telegram ml-1"></i>Send Invoice
									</a> --}}
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
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script  >
    function printdiv(){
        var divcontent = document.getElementById('divcontent').innerHTML ;
        var originalcontent = document.body.innerHTML ;
        document.body.innerHTML = divcontent ;
        window.print();
        document.body.innerHTML = originalcontent ;
        location.reload();
    }
</script>
@endsection
