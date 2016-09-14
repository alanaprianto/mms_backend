<table class="table">
    
    <tbody><tr>
      <th class="sortable">No</th>
      <th class="sortable">Name</th>    
      <th class="sortable">Description</th>
      <th class="sortable">HTML TAG</th>
      <th class="sortable">Options</th>
    </tr>
    @php
      $no = ($fsettings->currentPage()*7)-($fsettings->perPage()-1)
    @endphp
    @foreach ($fsettings as $key=>$fs) 
    <tr>
        <td>{{ $no+$key }}</td>    
        <td>{{ $fs->name }}</td>
        <td>{{ $fs->description }}</td>
        <td>{{ $fs->html_tag }}</td>
        <td>
        <!-- {{ $baseurl = URL::to('form_setting/') }} -->      
        <!-- URL::to('form_setting/edit/$fs->id') -->
        <a href="setting/{!! $fs->id !!}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
        <!-- <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span></button> &nbsp;  -->      
        <a href="setting/{!! $fs->id !!}/delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{ $fs->id }}" data-name="{{ $fs->name }}" data-url="{{ url('crud/form/setting/') }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
        <!-- <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></td> -->
      </tr>
    @endforeach     
    </tbody>
  </table>

  {{ $fsettings->links() }}