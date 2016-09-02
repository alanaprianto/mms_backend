  <table class="table">
  
    <tbody><tr>
      <th>No</th> 
      <th>Question</th>    
      <th>Group Question</th>
      <th>Answer Type</th>
      <th>Description</th>
      <th>Options</th>
    </tr>
    @php
      $no = ($fquestions->currentPage()*7)-($fquestions->perPage()-1)
    @endphp
    @foreach ($fquestions as $key=>$fq) 
    <tr>    
        <td>{{ $no+$key }}</td>
        <td>{{ $fq->question }}</td>
        <td>{{ $fq->group->name }}</td>     
        <td>{{ $fq->type->name }}</td>     
        <td>{{ $fq->description }}</td>     
        <td>
        
        <a href="question/{!! $fq->id !!}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
        
        <a href="question/{!! $fq->id !!}/delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{ $fq->id }}" data-name="{{ $fq->question }}" data-url="{{ url('crud/form/question/') }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
        
      </tr>
    @endforeach   
  
    </tbody>
  </table>

  {{ $fquestions->links() }}