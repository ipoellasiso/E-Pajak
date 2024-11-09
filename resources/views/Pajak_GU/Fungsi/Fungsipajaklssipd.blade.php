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
    var table = $('.tabelspmsp2dgusipdri').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilspmsp2dgusipd",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'status2', name: 'status2'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            // {data: 'keterangan_sp2d', name: 'keterangan_sp2d'},
            {data: 'nama_skpd', name: 'nama_skpd'},
        ]
    });

    // edit data
    $('body').on('click', '.editPajakgusipd', function()  {
        var iduser = $(this).data('id');
        $.get("/pajakgusipd/edit/"+iduser, function (data) {
            $('#saveBtn').val("edit-pajakgu");
            $('#editpajakgusipdajukantbp').modal('show');
            $('#id5').val(data.id);
            $('#nomor_spm5').val(data.nomor_spm);
            $('#nomor_sp2d5').val(data.nomor_sp2d);
            $('#akun_pajak5').val(data.akun_pajak);
            $('#nama_pajak_potongan5').val(data.nama_pajak_potongan);
            $('#id_billing5').val(data.id_billing);
            $('#nilai_tbp_pajak_potongan5').val(data.nilai_tbp_pajak_potongan);
            $('#npwp5').val(data.npwp);
            $('#nama_npwp5').val(data.nama_npwp);
            $('#nomor_rekening5').val(data.nomor_rekening);
            $('#ntpn5').val(data.ntpn);
            $('.bd-example-modal-xl').modal('hide');
        })
    });
});

</script>

