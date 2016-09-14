<table class="table table-bordered" id="users-table">
  <thead>
    <tr>
      <th>Name</th>    
      <th>Description</th>
      <th>HTML TAG</th>
      <th>Options</th>
    </tr>        
  </thead>
</table>

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('mms/crud/form/ajax/')}}{{ $baseUrl }}"       
    });
});
</script>
@endpush