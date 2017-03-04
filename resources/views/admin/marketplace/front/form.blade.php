<table class="table" id="theTable">
    <tr>
        <td><strong>Type Tampilan</strong></td>
        <td>:</td>
        <td>
            <select id="type" class="form-control" name="type" onchange="setType(this.value)">
                <option value='' selected>-- Pilih Type Tampilan--</option>
                <option value='category'>Category</option>
                <option value='custom'>Custom</option>
            </select>
        </td>
    </tr>
    <tr id="category_field" hidden>
        <td><strong>Kategori Produk 1</strong></td>
        <td>:</td>
        <td>
            <select id="cat_id" class="form-control" name="cat_id" onchange="setAnswerType(this.value, 1)">
                <option value='' selected>-- Pilih Kategori Produk --</option>
                @foreach ($parent_cat as $key=>$cat)
                    <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td><strong>Nama Tampilan</strong></td>
        <td>:</td>
        <td><input type="text" name="name" id="name" class="form-control"></td>
    </tr>
    <tr>
        <td><strong>Posisi</strong></td>
        <td>:</td>
        <td><input type="text" name="position" id="position" class="form-control"></td>
    </tr>
    <tr>
        <td><strong>Deskripsi</strong></td>
        <td>:</td>
        <td><textarea name="description" id="description" class="form-control"></textarea></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td align="right">
            <input class="btn btn-primary" id="btnSubmit" type="submit" value="{{ $submitButtonText }}">
        </td>
    </tr>
</table>

<script>
    function setType(value) {
        if (value.indexOf('category') !== -1) {
            document.getElementById("category_field").hidden = false;
        } else {
            document.getElementById("category_field").hidden = true;
            document.getElementById("cat_id").selectedIndex = -1;
        }

        asd = document.getElementById("cat_id").value;
        console.log(asd);
    }

    function setAnswerType(id, index) {
        var stRow = index+1;
        var edRow = index+1;
        var ttRow = index+6;

        if (id!=0) {
            $.ajax({
                url: "{{ url('api/marketplace/category/') }}" + "/" + id
            }).done(function(data) {
                if (data.length === 0) {

                } else {
                    var options = "<option value='"+id+"'>-- Pilih Kategori --</option>";
                    for (i = 0; i < data.length; i++) {
                        var answer = data[i];
                        options += "<option value='"+answer.id+"'>"+answer.title+"</option>";
                    }

                    var table = document.getElementById("theTable");
                    var crRow = table.rows.length;

                    if (crRow<ttRow) {

                    } else if (crRow>ttRow) {
                        table.deleteRow(stRow);
                        table.deleteRow(edRow);

                        console.log('lebih');
                        console.log('deleting row '+stRow+' & '+edRow);
                    } else if (crRow=ttRow) {
                        table.deleteRow(stRow);

                        console.log('sama');
                    }

                    var count = index+1;
                    var row = table.insertRow(stRow);

                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    cell1.innerHTML = "<strong>Kategori Produk "+count+"</strong>";
                    cell2.innerHTML = ":";
                    cell3.innerHTML =
                        "<select id='cat_id' class='form-control required' name='cat_id' onchange='setAnswerType(this.value, "+count+")'>"+
                        options+
                        "</select>";
                }
            });
        }
    }
</script>