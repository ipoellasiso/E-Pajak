<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
        
    </head>
    <body>
        {{-- <div class='loader'> --}}
            {{-- @include('Template.Loading') --}}
        {{-- </div> --}}

        <div class="page-container">
            @include('Template.Navbar')
            @include('Template.Sidebar')
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}
            <div class="page-content">
                <div class="main-wrapper">

                    <div class="row">
                        <nav class="breadcrumb breadcrumb-dash">
                            <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ $page_title }}</a>
                            <a class="breadcrumb-item" href="#">{{ $breadcumd1 }}</a>
                            <span class="breadcrumb-item active">{{ $breadcumd2 }}</span>
                        </nav>
                        
                        <div class="col">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <h5 class="card-title">{{ $title }}</h5>
                                        </div>
                                        <div class="col-4">
                                        </div>
                                    </div>

                                    {{-- isi --}}
                                    <div class="modal-body">
                                        <form method="get" action="">
                                        {{-- @method('get') --}}
                                        @csrf
                                            <div class="row">
                                                <div class="row mb-4" id="formcheck">
                                                    <div class="col-4">
                                                        <label>Filter Berdasarkan</label>
                                                        
                                                            <div class="form-check">
                                                                <br>
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="text1(0)">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                Rincian Penyetoran Pajak
                                                                </label>
                                                            </div>
                                                            <br>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="text1(1)">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                Rekapitulasi Penyetoran Pajak
                                                                </label>
                                                            </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-center" id="forminput1a">
                                                            <label>Cari Berdasarkan Rincian Penyetoran Pajak</label>
                                                        </div>
                                                        {{-- === form input rekapitulasi penyetoran pajak === --}}
                                                        <div class="text-center" id="forminput2a">
                                                            <label>Cari Berdasarkan Rekapitulasi Penyetoran Pajak</label>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1d">
                                                            <label>Pilih OPD</label>
                                                            <select class="form-select" name="nama_skpd" id="nama_skpd" value="" required>
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput2d">
                                                            <label>Pilih OPD2</label>
                                                            <select class="form-select" name="nama_skpd4" id="nama_skpd24" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="411211">411211</option>
                                                                <option value="411121">411121</option>
                                                                <option value="411122">411122</option>
                                                                <option value="411124">411124</option>
                                                                <option value="411128">411128</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1b">
                                                            <label>Pilih Bulan</label>
                                                            <select class="form-select" name="periode" id="periode" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Januari">Januari</option>
                                                                <option value="Februari">Februari</option>
                                                                <option value="Maret">Maret</option>
                                                                <option value="April">April</option>
                                                                <option value="Mei">Mei</option>
                                                                <option value="Juni">Juni</option>
                                                                <option value="Juli">Juli</option>
                                                                <option value="Agustus">Agustus</option>
                                                                <option value="September">September</option>
                                                                <option value="Oktober">Oktober</option>
                                                                <option value="November">November</option>
                                                                <option value="Desember">Desember</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput2b">
                                                            <label>Pilih Bulan 2</label>
                                                            <select class="form-select" name="periode" id="periode2" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Januari">Januari</option>
                                                                <option value="Februari">Februari</option>
                                                                <option value="Maret">Maret</option>
                                                                <option value="April">April</option>
                                                                <option value="Mei">Mei</option>
                                                                <option value="Juni">Juni</option>
                                                                <option value="Juli">Juli</option>
                                                                <option value="Agustus">Agustus</option>
                                                                <option value="September">September</option>
                                                                <option value="Oktober">Oktober</option>
                                                                <option value="November">November</option>
                                                                <option value="Desember">Desember</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1c">
                                                            <label>Pilih Akun Pajak</label>
                                                            <select class="form-select" name="akun_pajak" id="akun_pajak" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="411211">411211</option>
                                                                <option value="411121">411121</option>
                                                                <option value="411122">411122</option>
                                                                <option value="411124">411124</option>
                                                                <option value="411128">411128</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput2c">
                                                            <label>Pilih Akun Pajak 2</label>
                                                            <select class="form-select" name="akun_pajak" id="akun_pajak2" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="411211">411211</option>
                                                                <option value="411121">411121</option>
                                                                <option value="411122">411122</option>
                                                                <option value="411124">411124</option>
                                                                <option value="411128">411128</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div id="forminput1e">
                                                            <label>Pilih Status</label>
                                                            <select class="form-select" name="status2" id="status2" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Terima">Terima</option>
                                                                <option value="Tolak">Tolak</option>
                                                            </select>
                                                        </div>
                                                        <div id="forminput2e">
                                                            <label>Pilih Status</label>
                                                            <select class="form-select" name="status2" id="status22" value="" required>
                                                                <option value=""></option>
                                                                <option value="">Pilih Semua</option>
                                                                <option value="Terima">Terima</option>
                                                                <option value="Tolak">Tolak</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-2">
                                                    </div>
                                                    
                                                </div>

                                                <div class="row mb-4" id="formbutton">
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <button type="submit" id="tcari1" class="btn btn-outline-primary m-b-xs caribaru">
                                                            <i class="fa fa-enter"></i>Cari
                                                        </button>
                                                        <button type="submit" id="tcari2" class="btn btn-outline-primary m-b-xs caribaru">
                                                            <i class="fa fa-enter"></i>Cari 2
                                                        </button>
                                                        <button type="submit" id="treset1" class="btn btn-outline-danger m-b-xs resetbaru">
                                                            <i class="fa fa-enter"></i>Reset
                                                        </button>
                                                        <button type="submit" id="treset2" class="btn btn-outline-danger m-b-xs resetbaru">
                                                            <i class="fa fa-enter"></i>Reset 2
                                                        </button>
                                                    </div>
                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body tampillaporanls1">
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
    

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        <script>
            $(document).ready(function(){
                $(document).ready(function () {
                    var tampilawal = '1';
                    $.ajax({
                        url: "{{ route('laporan.pajakls.index') }}" +'/' + tampilawal +'/tampilawal',
                        type: "GET",
                        data: 'tampilawal=' + tampilawal,
                        success: function (data) {
                            $('.tampillaporanls1').html(data);//menampilkan data ke dalam modal
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
                var tampilawal = '1';
                $.ajax({
                    url: "{{ route('laporan.pajakls.index') }}" +'/' + tampilawal +'/tampil',
                    type: "GET",
                    data: 'nama_skpd=' + nama_skpd + '&periode=' + periode + '&akun_pajak=' + akun_pajak + '&status2=' + status2,
                        success: function (data) {
                            $('.tampillaporanls1').html(data);//menampilkan data ke dalam modal
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
                $('#tcari1').hide(); 
                $('#treset1').hide(); 
                $('#tcari2').hide(); 
                $('#treset2').hide(); 
                $('#periode').val('').trigger('change');
                $('#akun_pajak').val('').trigger('change');
                $('#periode2').val('').trigger('change');
                $('#akun_pajak2').val('').trigger('change');
                $('#nama_skpd').val('').trigger('change');
                $('#status2').val('').trigger('change');
                $('#nama_skpd2').val('').trigger('change');
                $('#status22').val('').trigger('change');
                var tampilawal = '1';
                $.ajax({
                        url: "{{ route('laporan.pajakls.index') }}" +'/' + tampilawal +'/tampilawal',
                        type: "GET",
                        data: 'tampilawal=' + tampilawal,
                        success: function (data) {
                            $('.tampillaporanls1').html(data);//menampilkan data ke dalam modal
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
        </script>

        <script>

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
            $('#tcari1').hide(); 
            $('#treset1').hide(); 
            $('#tcari2').hide(); 
            $('#treset2').hide(); 
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
                } 
                if (x == 1){
                    $('#forminput2a').show();
                    $('#forminput2b').show(); 
                    $('#forminput2c').show();
                    $('#forminput2d').show();
                    $('#forminput2e').show();
                    $('#tcari2').show(); 
                    $('#treset2').show();
                    $('#forminput1a').hide();
                    $('#forminput1b').hide(); 
                    $('#forminput1c').hide();
                    $('#forminput1d').hide();
                    $('#forminput1e').hide();
                    $('#tcari1').hide(); 
                    $('#treset1').hide();
                }
            }
        </script>



    </body>
</html>