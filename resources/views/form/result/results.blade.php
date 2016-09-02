<table class="table">
  
  <tbody><tr>
    <th>No</th> 
    <th>Question</th>            
    <th>Answer Type</th>    
    <th>Answer Value</th>    
    <th>User</th>    
    <th>Options</th>
  </tr>
  @php
      $no = ($fresults->currentPage()*7)-($fresults->perPage()-1)
  @endphp
  @foreach ($fresults as $key=>$fr)
	<tr>    
      <td>{{ $no+$key }}</td>
	    <td>{{ isset($fr->question->question) ? $fr->question->question : '-' }}</td>
	    <td>{{ isset($fr->question->type->name) ? $fr->question->type->name : '-' }}</td>      
      <td>{{ isset($fr->answer_value) ? $fr->answer_value : '-' }}</td>  
      <td>{{ isset($fr->user->username) ? $fr->user->username : '-' }}</td>      
      <td>{{ $fr->description }}</td>       
	    <td>
      
      <a href="result/{!! $fr->id !!}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
      
      <a href="result/{!! $fr->id !!}/delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{ $fr->id }}" data-name="{{ $key+1 }}" data-url="{{ url('crud/form/result/') }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>      
      </td>
  </tr>
  @endforeach   
  
  </tbody>
</table>

{{ $fresults->links() }}