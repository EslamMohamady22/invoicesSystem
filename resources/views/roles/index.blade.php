@extends('layouts.master')
@section('css')
    @include('layouts.table_css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
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
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mg-b-20">إضافة صلاحية</a>
                    {{-- <a href="{{ url('export') }}" class="btn btn-primary mg-b-20"> تنزيل ملف اكسل</a> --}}
                </div>




                 <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table id="example-delete" class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الأسم </th>
                                    <th>العمليات</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($roles as $role)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                           @can('عرض صلاحية')
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('roles.show', $role->id) }}">عرض</a>
                                        @endcan

                                        @can('تعديل صلاحية')
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                        @endcan

                                        @if ($role->name !== 'owner')
                                            @can('حذف صلاحية')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                $role->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        @endif
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
        $('#modaldemo8').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            // var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            // modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
@endsection
