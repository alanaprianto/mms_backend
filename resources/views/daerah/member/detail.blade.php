@extends('daerah.app')

@section('sidebar')
  @include('daerah.member.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Member Detail</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
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
                    <h5>{{ $member->name }} </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- identitas user -->
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Username</label>
                              <div class="col-lg-10">
                                <p class="form-control-static">{{ $member->username }}</p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Tracking Code</label>
                              <div class="col-lg-10">
                                <p class="form-control-static"><?php echo @$detail[0]['trackingcode'];?></p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Submitted At</label>
                              <div class="col-lg-10">
                                <p class="form-control-static">{{ $member->created_at }}</p>
                              </div>
                            </div>
                            <div class="hr-line-dashed"></div>                                          
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-9 col-lg-offset-1">
                          @if ($detail)
                                <?php $i=1;?>       
                                <table class="table">
                                  <tr>
                                    <td><strong>Status</strong></td>
                                    <td>:</td>
                                    <td>
                                @if ( $detail[0]['id_user'] )
                                  <span class="label label-primary">Registered</span>
                                @else
                                  <span class="label label-danger">Not Yet Registered</span>
                                @endif                
                              </td>
                                  </tr>
                                  @foreach ($detail as $row)
                                  <tr>
                                    <td><strong>{{ $row->question }}</strong></td>
                                    <td>:</td>
                                    <td>{{ $row->answer }}</td>
                                  </tr>
                                  @endforeach
                                  <tr>
                                    <td><strong>Submitted At</strong></td>
                                    <td>:</td>
                                    <td>{{ $detail[0]['created_at'] }}</td>
                                  </tr>
                                </table>
                          @endif
                        </div>
                      </div>
                    <!-- <table class="table table-bordered" id="list-table" width=100%>
						<thead>
					       <tr>
                                <th>Question</th>
                                <th>Answer Value</th>
							    <th>User</th>
							    <th>Tracking Code</th>      
							    <th>Submitted At</th>
							</tr>      
                        </thead>
                    </table> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Payment History </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">                    
                </div>
            </div>
        </div>
    </div>
    <br>    
@stop

@push('scripts')
	<!-- ChartJS-->	
    <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <script type="text/javascript">    			  
		$(function() {
		  $('#list-table').DataTable({
		    processing: true,
		    serverSide: true,
		    iDisplayLength: 100,
		    ajax: "{{ url('/dashboard/daerah/ajax/members/')}}/{{ $member->id }}",
		    columns: [       
		    	{ "data" : "question" },        
		        { "data" : "answer" },        
		        { "data" : "name"},        
		        { "data" : "trackingcode"},      
		        { "data" : "created_at"},      
		    ],		    
		  });
		});
    </script>
@endpush