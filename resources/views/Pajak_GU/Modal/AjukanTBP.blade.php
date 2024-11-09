<div class="modal fade bd-example-modal-xl" id="editpajakgusipdajukantbp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">{{ $title }}</h5>
                
                {{-- <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close" data-toggle="modal" data-target=".bd-example-modal-xl"></i>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="card">
                    {{-- <div class="card-body"> --}}
                        {{-- <div class="d-flex flex-row"> --}}
                            {{-- <h4 class="card-title">{{ $title }}</h4> --}}
                            {{-- <a class="btn btn-secondary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createPajakls" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                                <i class="fas fa-pencil-alt"></i>
                            </a> --}}
                        {{-- </div> --}}
                        <!-- <div class="m-t-25"> -->
                            
                        <form method="POST" action="{{ url('simpanjsontbp') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body flex flex-col p-6">
                                
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="no_spm" class="form-label">Nomor SPM </label>
                                        <input id="no_spm" name="no_spm" type="text" class="form-control" required></input>
                                    </div>
                                    <div class="col">
                                        <label for="tgl_spm" class="form-label">Tanggal SPM </label>
                                        <input id="tgl_spm" name="tgl_spm" type="date" class="form-control" required></input>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="url" class="form-label">Isi Data Json </label>
                                        <!-- <textarea name="textarea" rows="5" cols="40">Write something here</textarea> -->
                                        <textarea id="jsontextareatbp" name="jsontextareatbp" type="text" class="form-control" rows="30" required></textarea>
                                    </div>
                                    <div class="col">

                                        <label for="akun_pajak">Akun Pajak</label>
                                            <select class="form-select mb-4" id="akun_pajak" name="akun_pajak">
                                                    <option value=""></option> 
                                            </select>

                                        <label for="tgl_spm" class="form-label">Tanggal SPM </label>
                                        <input id="tgl_spm" name="tgl_spm" type="date" class="form-control" required></input>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger m-b-xs" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#tambahpajakls">
                                <i class="fas fa-arrow-alt-circle-left"></i> Close
                            </button>
                            <button type="submit" id="saveBtn" value="create" class="btn btn-outline-primary m-b-xs">
                                <i class="fa fa-save"></i>  Simpan
                            </button>
                        </div>
                        </form>
                        
                
                        <!-- <div class="table-responsive">
                            <table id="zero-confa" class="datatabletbp display table table-hover" style="width:100%">
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
                        </div> -->
                
                        <!-- </div> -->
                    {{-- </div> --}}
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark m-b-xs" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#tambahpajakls">
                    <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                </button>
                {{-- <button type="submit" id="saveBtn" value="create" class="btn btn-secondary">
                    <i class="fa fa-save"></i>  Simpan
                </button> --}}

            </div> -->
        </div>
    </div>
</div>