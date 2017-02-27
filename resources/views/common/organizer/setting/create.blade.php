@extends('common.app')

@section('active-organizer')
    active
@stop
@section('active-organizer-setting')
    active
@stop

@section('content')
    @php
        if (Auth::user()->role==1) {
        $url = url('admin/organizer/');
      } else if (Auth::user()->role==2) {
        $url = url('member/organizer/');
      } else if (Auth::user()->role==3) {
        $url = url('pusat/organizer/');
      } else if (Auth::user()->role==4) {
        $url = url('provinsi/organizer/');
      } else if (Auth::user()->role==5) {
        $url = url('daerah/organizer/');
      } else if (Auth::user()->role==6) {
        $url = url('alb/organizer/');
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