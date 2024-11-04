<script type="text/javascript">
    $(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      --------------------------------------------
      --------------------------------------------*/
    var table = $('.tabelpajakgusipdri').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilpajakgusipd",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_skpd', name: 'nama_skpd'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'jenis_pajak', name: 'jenis_pajak'},
            {data: 'nilai_pajak', name: 'nilai_pajak'},
            {data: 'ebilling', name: 'ebilling'},
            {data: 'status2', name: 'status2'},
        ]
    });

    // edit data
    $('body').on('click', '.editPajakgusipd', function()  {
        var iduser = $(this).data('id');
        $.get("/pajakgusipd/edit/"+iduser, function (data) {
            $('#saveBtn').val("edit-pajakgu");
            $('#tambahpajakgu').modal('show');
            $('#id5').val(data.id);
            $('#id_potonganls5').val(data.id_potonganls);
            $('#ebillingg').val(data.ebilling);
            $('#jenis_pajak').val(data.jenis_pajak);
            $('#nilai_pajak').val(data.nilai_pajak);
            $('.bd-example-modal-xl').modal('hide');
        })
    });
});

</script>

