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
    var table = $('.datatabletbp').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbp",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            {data: 'no_npd', name: 'no_npd'},
            // {data: 'no_spm', name: 'no_spm'},
            // {data: 'tgl_spm', name: 'tgl_spm'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    $('body').on('click', '.deletepengajuantbp', function () {

        var id = $(this).data("id");

        Swal.fire({
            title: 'Warning ?',
            text: "Hapus Data Ini ?"  +id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/tariktbp/destroy/"+id,
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: data.success
                        })
                        table.draw();
                    },
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Data Gagal Dihapus"
                })
            }
        })
    });

    var table = $('.datatabletbptolak').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbptolak",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            {data: 'no_npd', name: 'no_npd'},
            // {data: 'no_spm', name: 'no_spm'},
            // {data: 'tgl_spm', name: 'tgl_spm'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    var table = $('.datatabletbpbelumverifikasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tarikpajaksipdritbpbelumverifikasi",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_tbp', name: 'nomor_tbp'},
            {data: 'tanggal_tbp', name: 'tanggal_tbp'},
            {data: 'nilai_tbp', name: 'nilai_tbp'},
            {data: 'keterangan_tbp', name: 'keterangan_tbp'},
            {data: 'no_npd', name: 'no_npd'},
            // {data: 'no_spm', name: 'no_spm'},
            // {data: 'tgl_spm', name: 'tgl_spm'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
        ]
    });

    $('body').on('click', '.tolaktbp', function()  {
        var iduser = $(this).data('id');
        $.get("/tariktbp/tolak/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#edittolak_modal').modal('show');
            $('#id').val(data.id);
            $('#ebilling').val(data.nomor_tbp);
        })
    });

    $('body').on('submit', '#userFormtolak', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType = $('#saveBtntolak').val();
        $('#saveBtntolak').html('Sabar Ya Gaes.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/tariktbp/tolakupdate/"+id,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            // processing: true,
            success: (data) => {

                $('#userFormtolak').trigger("reset");
                $('#edittolak_modal').modal('hide');
                $('#saveBtntolak').html('Tolak');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil diTolak"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtntolak').html('Tolak');
            }
        });
    });

    $('body').on('click', '.terimatbp', function()  {
        var iduser = $(this).data('id');
        $.get("/tariktbp/terima/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#editterima_modal').modal('show');
            $('#id1').val(data.id);
            $('#ebilling1').val(data.nomor_tbp);
        })
    });

    $('body').on('submit', '#userFormterima', function(e){
        e.preventDefault();

        var id = $(this).data("id");
        var actionType = $('#saveBtnterima').val();
        $('#saveBtnterima').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/tariktbp/terimaupdate/"+id,
            data: formData,
            cacha: false,
            contentType: false,
            processData: true,
            success: (data) => {

                $('#userFormterima').trigger("reset");
                $('#editterima_modal').modal('hide');
                $('#saveBtnterima').html('Terima');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil diTerima"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtnterima').html('Terima');
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '/tariktbp/akun_pajak',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, akunpajak) {
                    $('#akun_pajak').append(new Option(akunpajak.akun_pajak, akunpajak.akun_pajak)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

});

function readURL(input, id) {
    id = id || '#modal-preview';
    if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#modal-preview').removeClass('hidden');
        $('#start').hide();
    }
}


</script>