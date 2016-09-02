<input id="baseUrl" type="hidden" value="">

<script type="text/javascript">
  /*==== PAGINATION ====*/  
  
  $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();

      var page = $(this).attr('href').split('page=')[1];
      var search = getURLParameter('search');      
      getSettings(page, search);
  });


  function getSettings(page, search) {

    var baseUrl = "{{ url('mms/crud/form/')}}{{ $baseUrl }}";
    var searchUrl = "&search=";

    var theUrl = "";
    if (search) {
      theUrl = baseUrl + page + searchUrl + search;
    } else {
      theUrl = baseUrl + page;
    }
    
    console.log(theUrl);
    $.ajax({    
        url: theUrl
    }).done(function(data) {                    
        $('.table').html(data);

        location.hash = page;

    });
  }

  function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
  }  
</script>