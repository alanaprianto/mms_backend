<table class="table">
  
    <tbody><tr>
      <th>No</th> 
      <th>Answer</th>            
      <th>Description</th>
      <th>Question</th>
      <th>Options Type</th>
      <th>Options</th>
    </tr>
    @php
      $no = ($fanswers->currentPage()*7)-($fanswers->perPage()-1)
    @endphp    
    @foreach ($fanswers as $key=>$fa) 
    <tr>    
        <td>{{ $no+$key }}</td>
        <td>{{ $fa->answer }}</td>
        <td>{{ $fa->description }}</td>     
        <td>{{ $fa->question->question }}</td>
        <td>{{ isset($fa->opt_type->name) ? $fa->opt_type->name : '-' }}</td>
        <td>
        
        <a href="answer/{!! $fa->id !!}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
        
        <a href="answer/{!! $fa->id !!}/delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{ $fa->id }}" data-name="{{ $fa->answer }}" data-url="{{ url('crud/form/answer/') }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>
        
      </tr>
    @endforeach   
    
    </tbody>
  </table>

  {{ $fanswers->links() }}