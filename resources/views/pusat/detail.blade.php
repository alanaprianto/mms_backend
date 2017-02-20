@extends('pusat.app')

@section('content') 
<div class="col-lg-10">
  <h2>Member Detail</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Indonesia</a>
      </li>      
      <li class="active">
        <strong>Member Detail</strong>        
      </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">
  </div>
</div>
@stop

@section('iframe')  
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>{{ $member->kta->first()->kta }} </h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-lg-12">
            <!-- identitas user -->
            <div class="form-group no-padding">
              <label class="col-lg-2 control-label no-padding">Username</label>
              <div class="col-lg-10">
                <p class="form-control-static no-padding">{{ $member->username }}</p>
              </div>
            </div>
            <div class="form-group no-padding">
              <label class="col-lg-2 control-label no-padding">Tracking Code</label>
              <div class="col-lg-10">
                <p class="form-control-static no-padding">{{ $trackingcode }}</p>
              </div>
            </div>
            <div class="form-group no-padding">
              <label class="col-lg-2 control-label no-padding">Submitted At</label>
              <div class="col-lg-10">
                <p class="form-control-static no-padding">{{ $member->created_at }}</p>
              </div>
            </div>
            <div class="form-group no-padding">
              <label class="col-lg-2 control-label no-padding">Territory</label>
              <div class="col-lg-10">
                <p class="form-control-static no-padding">{{ $member->territory_name }}</p>
              </div>
            </div>            
          </div>
        </div>                
      </div>
    </div>
  </div>
</div>

<div class="ibox float-e-margins">
  <div class="ibox-title">    
    <h5>Pendaftaran</h5>    
    <div class="ibox-tools">      
      <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content" style="display: block;">    
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1">
        @if ($detail1->count()>=1)            
          <table class="table">            
            @foreach ($detail1 as $row)
              @if ($row->correction||$row->commentary)
                <tr bgcolor="#F6CECE">
              @else 
                <tr>
              @endif
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
                <td>
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
                    <i class="fa fa-edit fa-fw"></i>
                  </a>
                </td>
              </tr>
            @endforeach            
          </table>
        @else
          <div class="text-center">
            No Data
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Profile Tahap 2</h5>
    <div class="ibox-tools">      
      <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
      </a>                       
    </div>
  </div>
  <div class="ibox-content" style="display: block;">      
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1">
        @if ($detail2->count()>=1)
          <table class="table">              
            @foreach ($detail2 as $row)
              @if ($row->correction||$row->commentary)
                <tr bgcolor="#F6CECE">
              @else 
                <tr>
              @endif
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
                <td>
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
                    <i class="fa fa-edit fa-fw"></i>
                  </a>
                </td>
              </tr>
            @endforeach              
          </table>
        @else
          <div class="text-center">
            No Data
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Profile Tahap 3</h5>
    <div class="ibox-tools">      
      <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
      </a>                        
    </div>
  </div>
  <div class="ibox-content" style="display: block;">
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1">
        @if ($detail3->count()>=1)
          <table class="table">              
            @foreach ($detail3 as $row)
              @if ($row->correction||$row->commentary)
                <tr bgcolor="#F6CECE">
              @else 
                <tr>
              @endif
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
                <td>
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
                    <i class="fa fa-edit fa-fw"></i>
                  </a>
                </td>
              </tr>
            @endforeach              
          </table>
        @else
          <div class="text-center">
            No Data
          </div>
        @endif
      </div>
    </div>
  </div>    
</div>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Documents Uploaded</h5>
    <div class="ibox-tools">      
      <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
      </a>                        
    </div>
  </div>
  <div class="ibox-content" style="display: block;">
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1">
        @if ($docs->count()>=1)
          <table class="table">              
            @foreach ($docs as $row)
              @if ($row->correction||$row->commentary)
                <tr bgcolor="#F6CECE">
              @else 
                <tr>
              @endif
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
                <td>
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valImgModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
                    <i class="fa fa-edit fa-fw"></i>
                  </a>
                </td>
              </tr>
            @endforeach              
          </table>
        @else
          <div class="text-center">
            No Data
          </div>
        @endif
      </div>
    </div>
  </div>    
</div>
@stop

@push('scripts')    
@endpush