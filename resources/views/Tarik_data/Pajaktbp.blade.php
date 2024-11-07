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
                                <div class="card-body">
                                    <div class="d-flex flex-row">
                                        <h4 class="card-title">{{ $title }}</h4>
                                    </div>
                                    <div class="m-t-25">
                            
                                    <form method="POST" action="{{ url('simpanjsontbp') }}">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body flex flex-col p-6">
                                            
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label for="no_spm" class="form-label">Nomor SPM </label>
                                                    <input id="no_spm" name="no_spm" type="text" class="form-control" rows="10"></input>
                                                </div>
                                                <div class="col">
                                                    <label for="tgl_spm" class="form-label">Tanggal SPM </label>
                                                    <input id="tgl_spm" name="tgl_spm" type="date" class="form-control" rows="10"></input>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label for="url" class="form-label">Isi Data Json </label>
                                                    <!-- <textarea name="textarea" rows="5" cols="40">Write something here</textarea> -->
                                                    <textarea id="jsontextareatbp" name="jsontextareatbp" type="text" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>

                                                <div class="modal-footer">
                                                    <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                                        <i class="fa fa-save"></i>  Simpan
                                                    </button>
                                                </div>
                                            
                                        </div>
                                    </div>
                                    </form>
                            
                                    <div class="table-responsive">
                                        <table id="zero-conf" class="datatabletbp display table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nomor TBP</th>
                                                    <th>Tanggal TBP</th>
                                                    <th>Nilai TBP</th>
                                                    <th>Keterangan TBP</th>
                                                    <th>Nomor NPD</th>
                                                    <th>Nomor SPM</th>
                                                    <th>Tanggal SPM</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- datatable ajax --}}
                                            </tbody>
                                        </table>
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
        
        @include('Tarik_data.Modal.Terima')
        @include('Tarik_data.Modal.Tolak')

        {{-- ############################## Batas Modal ################################ --}}

        {{-- ################################# Fungsi ################################### --}}

        @include('Tarik_data.Fungsi.Fungsitbp')

        {{-- ############################## Batas Fungsi ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        

    </body>
</html>