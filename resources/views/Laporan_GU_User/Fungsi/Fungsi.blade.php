<script>
    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawaluser = '1';
            $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });

    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawaluser = '1';
            $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1rekap').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });

    $('body').on('click', '.caribaru', function (e) {
        e.preventDefault();
        var periode = $('#periode').val();
        var akun_pajak = $("#akun_pajak").val();
        var status2 = $("#status2").val();
        var nama_skpd = $("#nama_skpd").val();
        var tampilawaluser = '1';
        $.ajax({
            url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampiluser',
            type: "GET",
            data: 'periode=' + periode + '&akun_pajak=' + akun_pajak + '&status2=' + status2,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $('body').on('click', '.caribarurekapsemuaopd', function (e) {
        e.preventDefault();
        var periode2 = $('#periode2').val();
        var status22 = $("#status22").val();
        // var nama_skpd24 = $("#nama_skpd24").val();
        var tampilawalrekapsemuaopd = '3';
        $.ajax({
            url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawalrekapsemuaopd +'/tampilrekapsemuaopd',
            type: "GET",
            data: 'periode2=' + periode2 + '&status22=' + status22,
                success: function (data) {
                    $('.tampillaporangu1rekapsemuaopd').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $('body').on('click', '.caribarurekap_per_opd', function (e) {
        e.preventDefault();
        var periode3 = $('#periode3').val();
        var status23 = $("#status23").val();
        var nama_skpd24 = $("#nama_skpd24").val();
        var tampilawalrekap = '2';
        $.ajax({
            url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawalrekap +'/tampilrekap',
            type: "GET",
            data: 'nama_skpd24=' + nama_skpd24 + '&periode3=' + periode3 + '&status23=' + status23,
                success: function (data) {
                    $('.tampillaporangu1rekap2').html(data);//menampilkan data ke dalam modal
                }
            });
    });

    $(document).ready(function(){
        $("#cetakpdfls").click(function(e){
            alert('a');
        });
    });

    $('body').on('click', '.resetbaru', function () {
        $('#forminput1a').hide();
        $('#forminput1b').hide(); 
        $('#forminput1c').hide(); 
        $('#forminput1d').hide();
        $('#forminput1e').hide();
        $('#forminput2a').hide(); 
        $('#forminput2b').hide(); 
        $('#forminput2c').hide(); 
        $('#forminput2d').hide(); 
        $('#forminput2e').hide();
        $('#forminput3b').hide();
        $('#forminput3e').hide();
        $('#tcari1').hide(); 
        $('#treset1').hide(); 
        $('#tcari2').hide(); 
        $('#treset2').hide(); 
        $('#treset3').hide(); 
        $('#tcari3').hide();
        $('#periode').val('').trigger('change');
        $('#akun_pajak').val('').trigger('change');
        $('#periode2').val('').trigger('change');
        $('#akun_pajak2').val('').trigger('change');
        $('#nama_skpd').val('').trigger('change');
        $('#status2').val('').trigger('change');
        $('#nama_skpd2').val('').trigger('change');
        $('#status22').val('').trigger('change');
        $('#status23').val('').trigger('change');
        $('#periode3').val('').trigger('change');
        $('#nama_skpd24').val('').trigger('change');
        var tampilawaluser = '1';
        $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawaluser +'/tampilawaluser',
                type: "GET",
                data: 'tampilawaluser=' + tampilawaluser,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
        });
    });

    $('body').on('click', '.resetbaru2', function () {
        $('#forminput1a').hide();
        $('#forminput1b').hide(); 
        $('#forminput1c').hide(); 
        $('#forminput1d').hide();
        $('#forminput1e').hide();
        $('#forminput2a').hide(); 
        $('#forminput2b').show(); 
        $('#forminput2c').hide(); 
        $('#forminput2d').hide(); 
        $('#forminput2e').show();
        $('#forminput3b').hide();
        $('#forminput3e').hide();
        $('#tcari1').hide(); 
        $('#treset1').hide(); 
        $('#tcari2').show(); 
        $('#treset2').show(); 
        $('#treset3').hide(); 
        $('#tcari3').hide();
        $('#periode').val('').trigger('change');
        $('#akun_pajak').val('').trigger('change');
        $('#periode2').val('').trigger('change');
        $('#akun_pajak2').val('').trigger('change');
        $('#nama_skpd').val('').trigger('change');
        $('#status2').val('').trigger('change');
        $('#nama_skpd2').val('').trigger('change');
        $('#status22').val('').trigger('change');
        $('#status23').val('').trigger('change');
        $('#periode3').val('').trigger('change');
        $('#nama_skpd24').val('').trigger('change');
        var tampilawal = '1';
        $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
        });
    });

    $('body').on('click', '.resetbaru3', function () {
        $('#forminput1a').hide();
        $('#forminput1b').hide(); 
        $('#forminput1c').hide(); 
        $('#forminput1d').hide();
        $('#forminput1e').hide();
        $('#forminput2a').hide(); 
        $('#forminput2b').hide(); 
        $('#forminput2c').hide(); 
        $('#forminput2d').show(); 
        $('#forminput2e').hide();
        $('#forminput3b').show();
        $('#forminput3e').show();
        $('#tcari1').hide(); 
        $('#treset1').hide(); 
        $('#tcari2').hide(); 
        $('#treset2').hide(); 
        $('#treset3').show(); 
        $('#tcari3').show();
        $('#periode').val('').trigger('change');
        $('#akun_pajak').val('').trigger('change');
        $('#periode2').val('').trigger('change');
        $('#akun_pajak2').val('').trigger('change');
        $('#nama_skpd').val('').trigger('change');
        $('#status2').val('').trigger('change');
        $('#nama_skpd2').val('').trigger('change');
        $('#status22').val('').trigger('change');
        $('#status23').val('').trigger('change');
        $('#periode3').val('').trigger('change');
        $('#nama_skpd24').val('').trigger('change');
        $('#pilihrekap').val('').trigger('change');
        var tampilawal = '1';
        $.ajax({
                url: "{{ route('laporan.pajakguuser.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampillaporangu1').html(data);//menampilkan data ke dalam modal
                }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '/laporanpajakls/opd',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, opd) {
                    $('#nama_skpd').append(new Option(opd.nama_opd, opd.nama_opd)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    $(document).ready(function() {
        $.ajax({
            url: '/laporanpajakls/opd',
            method: 'GET',
            success: function(data) {
                $.each(data, function(index, opd) {
                    $('#nama_skpd24').append(new Option(opd.nama_opd, opd.nama_opd)); // Ganti 'nama' dengan kolom yang sesuai
                });
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    // var getLastMonths = function(n) {
    // var arr = new Array();

    // arr.push(moment().format('DD-MM-YYYY'));

    // for(var i=1; i< 2; i++){
    //     arr.push(moment().add(1, 'M').format('DD-MM-YYYY'));
    // }

    // return arr;
    // }
    // var appendOptions = function(arr) {
    // var html = '';
    // for(var i=0; i<arr.length; i++) {
    //     html += '<option value="' + arr[i] + '">' + arr[i] + '</option>'
    // }

    // document.getElementById('periode').innerHTML = html;

    // }
    // var months = getLastMonths(4);
    // appendOptions(months);

    // window.onload = function() {
    // var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];;
    // var date = new Date();

    // document.getElementById('periode').innerHTML = months[date.getMonth()] + ' ' + date.getFullYear();
    // };

    $('#forminput1a').hide();
    $('#forminput1b').hide(); 
    $('#forminput1c').hide(); 
    $('#forminput1d').hide();
    $('#forminput1e').hide();
    $('#forminput2a').hide(); 
    $('#forminput2b').hide(); 
    $('#forminput3b').hide();
    $('#forminput2c').hide(); 
    $('#forminput2d').hide(); 
    $('#forminput2e').hide();
    $('#forminput3e').hide();
    $('#tcari1').hide(); 
    $('#treset1').hide(); 
    $('#tcari2').hide(); 
    $('#treset2').hide();
    $('#pilihrekap').hide();
    $('#tcari3').hide(); 
    $('#treset3').hide();



    function text1(x){
        if (x == 0){
            $('#forminput1a').show();
            $('#forminput1b').show(); 
            $('#forminput1c').show();
            $('#forminput1d').show();
            $('#forminput1e').show();
            $('#tcari1').show(); 
            $('#treset1').show();
            $('#forminput2a').hide();
            $('#forminput2b').hide(); 
            $('#forminput2c').hide();
            $('#forminput2d').hide();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            $('#pilihrekap').hide();
            $('#tcari3').hide(); 
            $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
                                
        } 
        if (x == 1){
            $('#forminput2a').hide();
            $('#forminput2b').hide(); 
            $('#forminput2c').hide();
            $('#forminput2d').hide();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            $('#pilihrekap').show();
            $('#tcari3').hide(); 
            $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
        }
    }

    function pilih(x){
        if (x == 0){
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            $('#forminput2a').hide();
            $('#forminput2b').show(); 
            $('#forminput2c').show();
            $('#forminput2d').hide();
            $('#forminput2e').show();
            $('#tcari2').show(); 
            $('#treset2').show();
            $('#pilihrekap').show();
            $('#tcari3').hide(); 
            $('#treset3').hide();
            $('#forminput3e').hide();
            $('#forminput3b').hide();
                                
        } 
        if (x == 1){
            $('#forminput2a').hide();
            $('#forminput2b').hide(); 
            $('#forminput2c').hide();
            $('#forminput2d').show();
            $('#forminput2e').hide();
            $('#tcari2').hide(); 
            $('#treset2').hide();
            $('#forminput1a').hide();
            $('#forminput1b').hide(); 
            $('#forminput1c').hide();
            $('#forminput1d').hide();
            $('#forminput1e').hide();
            $('#tcari1').hide(); 
            $('#treset1').hide();
            $('#pilihrekap').show();
            $('#tcari3').show(); 
            $('#treset3').show();
            $('#forminput3e').show();
            $('#forminput3b').show();
        }
    }

</script>