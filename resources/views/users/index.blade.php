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
                    <a href="{{ route('users.create') }}" class="btn btn-primary mg-b-20">إضافة مستخدم</a>
                    {{-- <a href="{{ url('export') }}" class="btn btn-primary mg-b-20"> تنزيل ملف اكسل</a> --}}
                </div>




                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table id="example-delete" class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الأسم </th>
                                    <th>البريد الألكترونى </th>
                                    <th>حالة المستخدم</th>
                                    <th>نوع المستخدم</th>
                                    <th>العمليات</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($users as $user)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 'مفعل')
                                                <span class="label text-success d-flex">
                                                    <div class="dot-label bg-success ml-1"></div>{{ $user->status }}
                                                </span>
                                            @else
                                                <span class="label text-danger d-flex">
                                                    <div class="dot-label bg-danger ml-1"></div>{{ $user->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('تعديل مستخدم')
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                                    title="تعديل"><i class="las la-pen"></i></a>
                                            @endcan

                                            @can('حذف مستخدم')
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-user_id="{{ $user->id }}" data-username="{{ $user->name }}"
                                                    data-toggle="modal" href="#modaldemo8" title="حذف"><i
                                                        class="las la-trash"></i></a>
                                            @endcan
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
