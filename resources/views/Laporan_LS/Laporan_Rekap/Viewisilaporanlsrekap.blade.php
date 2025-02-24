<!DOCTYPE html>
<html lang="en">
    <head>
    </head>

    <body style="background-color: white;">

        <style>
            .line-title{
                border: 0;
                border-style: inset;
                border-top: 1px solid #dee117;
            }
        
            .table-borderless td,
            .table-borderless th {
                border: 0;
            }
        </style>
    
        {{-- <div class="page-container"> --}}
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}
            
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                    </div>
                    <div class="col-2">
                        <button id="cetakpdfls" target="blank" type="button" class="btn btn-outline-primary m-b-xs text-center" style="text-align: center">
                            <i class="fa fa-enter"></i>PDF  
                        </button>
                        <button id="cetakexcells" target="blank" type="button" class="btn btn-outline-info m-b-xs">
                            <i class="fa fa-enter"></i>Excel
                        </button>
                    </div>
                </div>
            
                <br>
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered" border="1" cellpadding="10" align="center" cellspacing="20" style="width: 80%">
                                        <tr>
                                            <td colspan="" style="width: 5%;"><center><img src="/theme/assets/images/13.png" width="100" height="100"></center></td>
                                            <td colspan="6" style="width: 55%;">
                                                <font style="font-size: 20pt;font-weight: bold;"><center>PEMERINTAH KOTA PALU</center></font>
                                                <font style="font-size: 13pt;font-weight: bold;"><center>BADAN PENGELOLA KEUANGAN DAN ASET DAERAH KOTA PALU</center></font>
                                                {{-- <font style="font-size: 13pt;font-weight: bold;"><center>KOTA PALU</center></font> --}}
                                                <font style="font-size: 11pt;font-weight:13"><center>Alamat : Jl. Baruga No. 2 No.Tlp : 0451-9384 Kode Pos : 94362</center></font>
                                            </td>
                                            {{-- <td colspan="1" style="border: 0px;width: 25%;"> --}}
                                                {{-- <font style="font-size: 12pt;font-weight: bold;">No Barang Masuk :  </font> <br/>
                                                <font style="font-size: 12pt;font-weight: bold;">Tanggal Masuk  </font> --}}
                                            {{-- </td> --}}
                                        </tr>
            
                                        <!-- DATA SUPPLIER -->
                                        <tr style="border: 10;">
                                            <td colspan="6"></td>
                                        </tr>
            
                                        <!-- DATA BARANG -->
            
                                        <tr style="border: 10;">
                                            <td colspan="6"></td>
                                        </tr>
            
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor SP2D</th>
                                            <th>Nilai SP2D</th>
                                            <th>Jenis Potongan</th>
                                        </tr>
                                        @php $no=1; @endphp
                                        @foreach ($datapajaklsrekap as $row)
                                        <tr>
                                            <td style="width: 2%">{{ $no++ }}</td>
                                            <td style="width: 25%">{{ $row->nomor_sp2d }}</td>
                                            <td style="width: 20%">Rp. {{ number_format($row->nilai_sp2d) }}</td>
                                            <td style="width: 20%">{{ $row->jenis_pajak }}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="border: 10;" align="left">
                                            <td colspan="5" align="right"><b>TOTAL</b></td>
                                            {{-- <td><b>Rp. {{ number_format($datapajaklsrekap->nilai_pajak) }}</b></td> --}}
                                        </tr>
            
                                        <tr>
                                            <td colspan="6" style="border-bottom: 0;"></td>
                                        </tr>
                                        
                                        <tr style="border: 10;">
                                            <td style="border: 0;" colspan="3"><center><b></b></center></td>
                                            <td style="border: 0;" colspan="3"><center><b>{{ $bulanrekap->jabatan_bud_kbud }}</b></center></td>
                                        </tr>
                                        
                                        <tr style="border: 10;">
                                            <td style="border: 0;" colspan="3" align="center">
                                                <br/><br/><br/>
                                            </td>
                                            <td style="border: 0;" colspan="3" align="center">
                                                <br/><br/><br/>
                                            </td>
                                        </tr>
            
                                        <tr>
                                            <td style="border: 0;" colspan="3"><center><u><b></b></u></center></td>
                                            <td style="border: 0;" colspan="3">
                                            <center>
                                                <u><b>{{ $bulanrekap->nama_bud_kbud }}</b></u><br>
                                                <b>NIP. {{ $bulanrekap->nip_bud_kbud }}</b>
                                            </center></td>
                                        </tr>
                                    </table>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        {{-- ################################# Modal ################################### --}}
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}
        <script>
        $(document).ready(function(){
                $("#cetakpdfls").click(function(e){
                    var periode = $('#periode').val();
                    var akun_pajak = $("#akun_pajak").val();
                    var status2 = $("#status2").val();
                    var nama_skpd = $("#nama_skpd").val();
                    // alert( nama_skpd + "" + periode + "" + akun_pajak + "" + status2);
                    params = "?page=laporan&nama_skpd=" + nama_skpd + "&periode=" + periode + "&akun_pajak=" + akun_pajak + "&status2=" + status2
                    window.open("/laporanpajakls-cetak"+params,"_blank");
                });
            });

        $(document).ready(function(){
            $("#cetakexcells").click(function(e){
                var periode = $('#periode').val();
                var akun_pajak = $("#akun_pajak").val();
                var status2 = $("#status2").val();
                var nama_skpd = $("#nama_skpd").val();
                // alert( nama_skpd + "" + periode + "" + akun_pajak + "" + status2);
                params = "?page=downloadexcel&nama_skpd=" + nama_skpd + "&periode=" + periode + "&akun_pajak=" + akun_pajak + "&status2=" + status2
                window.open("/laporan.downloadlaporanexcel"+params,"_blank");
            });
        });
        </script>
        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        {{-- @include('Template.Script') --}}

        

    </body>
</html>
