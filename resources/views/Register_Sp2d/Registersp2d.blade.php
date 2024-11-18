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
                                    </div>

                                    <table id="zero-conf" class="registersp2d display table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor SPM</th>
                                                <th>Tanggal SP2D</th>
                                                <th>Nomor SP2D</th>
                                                <th>Unit SKPD</th>
                                                <th>Nama Penerima</th>
                                                <th>Keterangan</th>
                                                <th>Jenis SP2D</th>
                                                <th>Nilai SP2D</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="row invoice-last">
                                <div class="col-9">
                                  <!-- {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut ante id elit molestie<br>dapibus id sollicitudin vel, luctus sit amet justo</p> --}} -->
                                </div>
                                <div class="col-3">
                                    <div class="invoice-info">
                                        {{-- @foreach ($total as $d) --}}
                                            <p>Total SP2D Januari ( {{ $totalcount1 }} ) <span>Senilai  Rp. {{ number_format($total_1,2) }}</span></p>
                                            <p>Total SP2D Februari ( {{ $totalcount2 }} ) <span>Senilai  Rp.{{ number_format($total_2,2) }}</span></p>
                                            <p>Total SP2D Maret ( {{ $totalcount3 }} ) <span>Senilai  Rp. {{ number_format($total_3,2) }}</span></p>
                                            <p>Total SP2D April ( {{ $totalcount4 }} ) <span>Senilai  Rp. {{ number_format($total_4,2) }}</span></p>
                                            <p>Total SP2D Mei ( {{ $totalcount5 }} ) <span>Senilai  Rp. {{ number_format($total_5,2) }}</span></p>
                                            <p>Total SP2D Juni ( {{ $totalcount6 }} ) <span>Senilai  Rp. {{ number_format($total_6,2) }}</span></p>
                                            <p>Total SP2D Juli ( {{ $totalcount7 }} ) <span>Senilai  Rp. {{ number_format($total_7,2) }}</span></p>
                                            <p>Total SP2D Agustus ( {{ $totalcount8 }} ) <span>Senilai  Rp. {{ number_format($total_8,2) }}</span></p>
                                            <p>Total SP2D September ( {{ $totalcount9 }} ) <span>Senilai  Rp. {{ number_format($total_9,2) }}</span></p>
                                            <p>Total SP2D Oktober ( {{ $totalcount10 }} ) <span>Senilai  Rp. {{ number_format($total_10,2) }}</span></p>
                                            <p>Total SP2D November ( {{ $totalcount11 }} ) <span>Senilai  Rp. {{ number_format($total_11,2) }}</span></p>
                                            <p>Total SP2D Desember ( {{ $totalcount12 }} ) <span>Senilai  Rp. {{ number_format($total_12,2) }}</span></p>
                                            <p class="bold">TOTAL SP2D ( {{ $totalcount13 }} ) <span>Senilai  Rp. {{ number_format($totalsp2d,2) }}</span></p>
                                        {{-- @endforeach --}}
                                        <div class="d-grid gap-2">
                                          {{-- <button class="btn btn-danger m-t-xs" type="button">Print Invoice</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ######################### Batas Isi Tampil Pajak LS ########################## --}}

        </div>

            {{-- ################################# Modal ################################### --}}
            
            

            {{-- ############################## Batas Modal ################################ --}}
            

            {{-- ################################# Fungsi ################################### --}}

            @include('Register_Sp2d.Fungsi.Fungsi')

            {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>