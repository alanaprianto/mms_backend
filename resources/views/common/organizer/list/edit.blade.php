@extends('common.app')

@section('active-organizer')
    active
@stop
@section('active-organizer-list')
    active
@stop

@section('content')
    <div class="col-lg-10">
        <h2>Edit Organizer</h2>
        <ol class="breadcrumb">
            <li>
                <a>Admin</a>
            </li>
            <li>
                <a>Organizer</a>
            </li>
            <li class="active">
                <strong>Edit</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <div class="title-action">
            <a href='/' class="btn btn-primary" onclick="goBack()">
                <span class="fa fa-arrow-left fa-fw"></span>
                &nbsp;&nbsp;Back
            </a>
        </div>
    </div>
@stop

@section('iframe')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Item</h5>
                        <div class="ibox-tools"><!-- any link icon --></div>
                    </div>
                    <div class="ibox-content">
                        @include('errors.error_list')

                        {!! Form::model($pengurus, ['method' => 'PATCH', 'action' => ['OrganizerListController@update', $pengurus->id], 'class' => 'form-horizontal']) !!}
                            @include('common.organizer.list.form', ['submitButtonText' => 'Update Organizer'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endpush