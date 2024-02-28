@extends('layouts.master')
@section('css')
    @include('layouts.table_css')
@endsection
@section('title')
    اضافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة مستخدم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('msq.msg')

    @include('msq.msg')


    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputName" class="control-label">اسم المستخدم </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col-md-6">
                                <label> البريد الاليكترونى</label>
                                <input class="form-control fc-datepicker" name="email" placeholder="" type="email"
                                    required>
                            </div>

                            {{-- <div class="col-md-6">
                                <label> كلمة المرور</label>
                                <input class="form-control fc-datepicker" name="password" placeholder="" type="password"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label>تأكيد كلمة المرور </label>
                                <input class="form-control fc-datepicker" name="confirm-password" placeholder=""
                                    type="password" required>
                            </div> --}}
                        </div>
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>كلمة المرور: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="password" required="" type="password">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                    name="confirm-password" required="" type="password">
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col-md-8">
                                <label for="status" class="control-label"> حالة المستخدم</label>
                                {{-- <input type="text" class="form-control" id="status" name="status"> --}}
                                <select name="status" id="status" class="form-control nice-select  custom-select" >
                                    <!--placeholder-->
                                        <option value="" selected disabled>حدد  حالة المستخدم</option>
                                        <option value="مفعل" selected >مفعل </option>
                                        <option value="غير مفعل" selected >غير مفعل </option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <label for="roles">صلاحيات المستخدم</label>
                                <textarea class="form-control" id="roles" name="roles" rows="3"></textarea>
                            </div>
                        </div> --}}
                        <div class="row mg-b-20">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label"> صلاحية المستخدم</label>
                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                    </div>
                        <br>








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
    @include('layouts.table_js')

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
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
@endsection
