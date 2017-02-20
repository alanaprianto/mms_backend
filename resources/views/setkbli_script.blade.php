<script type="text/javascript">
    var id = 0;
		$('#kbliModal').on('show.bs.modal', function (event) {  
          var button = $(event.relatedTarget) // Button that triggered the modal
          id = button.data('id');            
          console.log(id);
          setKbli("pilKbli1", "1", "0");
        });

        function setKbli(id, type, parent) {
          // if(type==1) {
          //   frmTemp.pilKbli2.value='=== KBLI 2 ===';
          //   frmTemp.pilKbli3.value='=== KBLI 3 ===';
          //   frmTemp.pilKbli4.value='=== KBLI 4 ===';
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // } else if(type==2) {
          //   frmTemp.pilKbli3.value='=== KBLI 3 ===';
          //   frmTemp.pilKbli4.value='=== KBLI 4 ===';
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // } else if(type==3) {
          //   frmTemp.pilKbli4.value='=== KBLI 4 ===';
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // } else if(type==4) {
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // }

          $.ajax({
            url: "{{ url('kbli/list') }}",
            type: "post",
            data: {
              _token: "{{ csrf_token() }}",
              type: type,
              parent: parent,
            }
          }).done(function(datas) {
            clearElement(id);               
            var element = document.getElementById(id);
            for (u = 0; u < datas.length; u++) {
              $(  "<option value='"+datas[u].id+"'>"+
                    datas[u].id+
                    " # "+
                    datas[u].limited_name+
                  "</option>")
              .appendTo(element);
            }
          });

          setKblitxt(parent);
        }        

        function setKblitxt(txt) {
          $("#thekbli").val(txt);
        }

        $('#btnKbli').on('click', function (event) {
          $('#kbliModal').modal('hide');

          var kbli = $("#thekbli").val();                    
          $('input[name='+id+']').val(kbli);
        });
	</script>