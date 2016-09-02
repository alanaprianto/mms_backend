<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

<input id="baseUrl" type="hidden" value="{{ url('mms/crud/form/')}}{{ $baseUrl }}">

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        Delete Record No 
      </div>
      <div class="modal-footer">        
        <input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submit_delete" type="submit" class="btn btn-danger">Delete</button>    
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var url, id, name;

  $('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal    
    url = button.data('url');
    id = button.data('id');
    name = button.data('name');

    var modal = $(this);
    modal.find('.modal-body').text('Delete Record ' + name + ' ?');
    modal.find('.modal-footer .form-control').val(id);
  })

  $('#submit_delete').on('click', function (event) {
    console.log("submit clicked");
    console.log(url+"/"+id);    

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

        var pageval = window.location.hash.substr(1);
      
        var search = getURLParameter('search');                  
        populateTable(pageval, search);
    });
  });
  
  function populateTable(pageval, search) {    

    var baseUrl = "{{ url('mms/crud/form/')}}{{ $baseUrl }}";
    var page = "?page="
    var searchUrl = "&search=";

    var theUrl = "";
    if (search) {
      theUrl = baseUrl + page + pageval + searchUrl + search;
    } else {
      theUrl = baseUrl + page + pageval;
    }

    console.log(theUrl);
    $.ajax({    
        url: theUrl
    }).done(function(data) {                    
        $('.table').html(data);

        location.hash = pageval;
    });
  }

  function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
  }  
</script>