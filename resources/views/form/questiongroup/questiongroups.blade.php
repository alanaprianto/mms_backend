  <table class="table">
  
    <tbody><tr>
      <th>No</th> 
      <th>Name</th>    
      <th>Description</th>
      <th>Options</th>
    </tr>    
    @php
      $no = ($fqgroups->currentPage()*7)-($fqgroups->perPage()-1)
    @endphp
    @foreach ($fqgroups as $key=>$fqg) 
    <tr>    
        <td>{{ $no+$key }}</td>
        <td>{{ $fqg->name }}</td>
        <td>{{ $fqg->description }}</td>      
        <td>
        
        <a href="question_group/{!! $fqg->id !!}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
        
        <a href="question_group/{!! $fqg->id !!}/delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{ $fqg->id }}" data-name="{{ $fqg->name }}" data-url="{{ url('crud/form/question_group/') }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
        
      </tr>
    @endforeach   
    
    </tbody>
  </table>

  {{ $fqgroups->links() }}