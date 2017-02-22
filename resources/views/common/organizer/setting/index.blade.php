@extends('common.app')

@section('active-organizer')
    active
@stop
@section('active-organizer-setting')
    active
@stop

@section('content')
<div class="col-lg-10">
    <h2>Organizer Setting</h2>
    <ol class="breadcrumb">
        <li>
            <a>Admin</a>
        </li>
        <li>
            <a>Organizer</a>
        </li>
        <li class="active">
            <strong>Setting</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">
    <div class="title-action">
        <a href='setting/create' class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Data</a>
    </div>
</div>
@stop

@section('iframe')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Organizer Setting</h5>
                    <div class="ibox-tools"><!-- any link icon --></div>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="setting-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Short Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-warning modal-icon"></i>
                <h4 class="modal-title">Warning!</h4>
            </div>
            <div class="modal-body">
                <p>This record will be deleted permanently.</p>
                <p>Are you sure to delete record <span class="recordname"></span></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" id="id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="submit_delete" type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var url = "{{ url('admin/organizer/setting_/') }}";
        $('#setting-table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 3, "asc" ]],
            ajax: "{{ url('admin/ajax/organizer/setting-/')}}",
            columns: [
                { "data" : "title" },
                { "data" : "short_title" },
                { "data" : "description" },
                { "data" : "status" },
                { "data" : "id"}
            ],
            "columnDefs": [
                {
                    "render": function ( data, type, row ) {
                        return "<div class='pull-right'>"+
                            "<a href='setting_/"+row.id+"/edit' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i> Edit </a>&nbsp;"+
                            "<a class='btn btn-xs btn-danger' data-toggle='modal' data-target='#myModal' data-id='"+row.id+"' data-name='"+row.title+"' data-url='setting_' title='Delete Item'><i class='fa fa-trash'></i> Delete </a>&nbsp;"+
                            "</div>";
                    },
                    "targets": 4
                },
            ]
        });
    });

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        url = button.data('url');
        id = button.data('id');
        name = button.data('name');

        var modal = $(this);
        modal.find('.recordname').text('"' + name + '"?').css('font-weight', 'bold');
        modal.find('.modal-footer .form-control').val(id);

    });

    $('#submit_delete').on('click', function (event) {
        $.ajax({
            url: url+"/"+id,
            type: "post",
            data: {
                _method: 'DELETE',
                _token: "{{ csrf_token() }}",
            }
        }).done(function(data) {
            console.log(data);

            $('#myModal').modal('hide');

            if (data.success) {
                toastr.success(data.msg);
            } else {
                toastr.error(data.msg);
            }

            var ref = $('#setting-table').DataTable();
            ref.ajax.reload(null, false);
        });
    });

</script>
@endpush