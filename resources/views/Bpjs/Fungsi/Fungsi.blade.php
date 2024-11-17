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
    var tabelbpjs = $('#tabelbpjs').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/tampilbpjs",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'akun_potongan', name: 'akun_potongan'},
            {{-- {data: 'jenis_potongan', name: 'jenis_potongan'}, --}}
            {data: 'nilai_pajak', name: 'nilai_pajak'},
            {data: 'ebilling', name: 'ebilling'},
            {data: 'ntpn', name: 'ntpn'},
            {data: 'status1', name: 'status1'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // tambah data
    $('#createBpjs').click(function (){
        $('#saveBtn').val("create-bpjs");
        $('#id').val('');
        $('#userFormbpjs').trigger("reset");
        $('#tambahbpjs').modal('show');
        $('#modal-preview').attr('src', 'https://via/placeholder.com/150');

    });

    $('body').on('click', '.tolakBpjs', function()  {
        var iduser = $(this).data('id');
        $.get("/dtbpjs/tolakbpjs/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#editbpjstolak_modal').modal('show');
            $('#id').val(data.id);
            $('#ntpn').val(data.ntpn);
            $('#ebilling').val(data.ebilling);
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
            url: "/dtbpjs/tolakbpjsupdate/"+id,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormtolak').trigger("reset");
                $('#editbpjstolak_modal').modal('hide');
                $('#saveBtntolak').html('Tolak');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil diTolak"
                })

                tabelbpjs.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtntolak').html('Tolak');
            }
        });
    });

    $('body').on('click', '.terimaBpjs', function()  {
        var iduser = $(this).data('id');
        $.get("/dtbpjs/terimabpjs/"+iduser, function (data) {
            // $('#saveBtn').val("edit-pajakls");
            $('#editbpjsterima_modal').modal('show');
            $('#id1').val(data.id);
            $('#ntpn1').val(data.ntpn);
            $('#ebilling1').val(data.ebilling);
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
            url: "/dtbpjs/terimabpjsupdate/"+id,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormterima').trigger("reset");
                $('#editbpjsterima_modal').modal('hide');
                $('#saveBtnterima').html('Terima');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil diTerima"
                })

                tabelbpjs.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtnterima').html('Terima');
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

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
}

</script>