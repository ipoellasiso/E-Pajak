<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>

        <div class="page-container">
            
            {{-- ######################### Isi Tampil Pajak LS ########################## --}}

            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-8">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-outline-primary m-b-xs text-center" style="text-align: center">
                        <i class="fa fa-enter"></i>PDF  
                    </button>
                    <button type="submit" class="btn btn-outline-info m-b-xs">
                        <i class="fa fa-enter"></i>Excel
                    </button>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-1 text-center">
                    <img src="{{ URL::asset('app/assets/images/Palu.png')}}" style="margin-top: 15px; text-align: center; width: 70px; right: 50px;" alt="" />
                </div>
                <div class="col-10 align-middle fw-bold text-center text-uppercase" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                    PEMERINTAH KOTA PALU <br>
                    REKAPITULASI PENYETORAN PAJAK <br>
                    TAHUN ANGGARAN 2025<br>
                </div>
                <div class="col-1">
                </div>
            </div>


            <div class="">
                <form method="get" target="blank" action="{{ route('cetaklaporanls') }}">
                @csrf
                    <div class="">
                        <div class="row">
                            
                            <div class="col">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="" class="display table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama OPD</th>
                                                    <th>Nomor SPM</th>
                                                    <th>Tanggal SP2D</th>
                                                    <th>Nomor SP2D</th>
                                                    <th>Nilai SP2D</th>
                                                    <th>Akun Pajak</th>
                                                    <th>Jenis Pajak</th>
                                                    <th>Nilai Pajak</th>
                                                    <th>E-Biling</th>
                                                    <th>NTPN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = 0; @endphp
                                                @php $no = 1; @endphp
                                                @foreach ($datapajakls as $d )
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $d->nama_skpd }}</td>
                                                        <td>{{ $d->nomor_spm }}</td>
                                                        <td>{{ $d->tanggal_sp2d }}</td>
                                                        <td>{{ $d->nomor_sp2d }}</td>
                                                        <td>{{ number_format($d->nilai_sp2d) }}</td>
                                                        <td>{{ $d->akun_pajak }}</td>
                                                        <td>{{ $d->jenis_pajak }}</td>
                                                        <td>{{ number_format($d->nilai_pajak) }}</td>
                                                        <td>{{ $d->ebilling }}</td>
                                                        <td>{{ $d->ntpn }}</td>
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="8" style="text-align: right">Total Pajak</th>
                                        
                                                    <td style="text-align: right"> {{ number_format($total = $datapajakls->sum('nilai_pajak'), 0) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <br><br>
                                        <div class="row">
                                            <div class="col-2 text-center">
                                            </div>
                                            <div class="col-6">
                                            </div>
                                            <div class="col-4 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                                                Palu, {{ now()->format('d M Y') }}<br>
                                                {{ $bulan->jabatan_bud_kbud }}<br><br><br><br><br><br>
                                                {{ $bulan->nama_bud_kbud }}<br>
                                                {{ $bulan->nip_bud_kbud }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}
        

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        {{-- @include('Template.Script') --}}

        

    </body>
</html>
