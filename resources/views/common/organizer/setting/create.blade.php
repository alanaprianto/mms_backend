@extends('common.app')

@section('active-organizer')
    active
@stop

@section('content')
    @php
        if (Auth::user()->role==1) {
          $url = url('admin/organizer/');
        } else {
          $url = url('admin/organizer/');
        }
    @endphp

    <div class="col-lg-10">
        <h2>Organizer</h2>
        <ol class="breadcrumb">
            <li>
                <a>Admin</a>
            </li>
            <li>
                <a>Organizer</a>
            </li>
            <li class="active">
                <strong>Create</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <div class="title-action">
        </div>
    </div>
@stop

@section('iframe')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <strong>Create New Setting</strong>
        </div>
        <div class="ibox-content">
            @include('errors.error_list')

            {!! Form::open(['action' => ['OrganizerSettingController@index'], 'class' => 'form-horizontal']) !!}
                @include('common.organizer.setting.form', ['submitButtonText' => 'Add Setting'])
            {!! Form::close() !!}
        </div>
    </div>
    <br/><br/>
@stop

@push('scripts')

@endpush