<?php

namespace App\Http\Controllers;

use App\Models\AkunpajakModel;
use App\Models\PajakguModel;
use App\Models\PajaklsModel;
use App\Models\Potongan2Model;
use App\Models\PotonganModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PajakguController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Get data
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Data Pajak GU',
            'active_side_pajakls'    => 'active',
            'active_pajakgu'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('id_opd', auth()->user()->id_opd)
                                    ->first(),
        );

        if ($request->ajax()) {

            $datapajakgu = DB::table('pajakkppgu')
                        ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'potongan2.nilai_pajak','pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'potongan2.status1', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'potongan2.id_pajakkpp', 'pajakkppgu.id_opd', 'opd.nama_opd')
                        // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                        // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                        ->join('potongan2',  'potongan2.id', 'pajakkppgu.id_potonganls')
                        ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                        ->join('opd', 'opd.id', 'pajakkppgu.id_opd')

                        ->where('id_opd', auth()->user()->id_opd)
                        // ->where('pajakkpp.status2', ['Terima'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                        ->get();

            return Datatables::of($datapajakgu)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status2 == 'Terima')
                        {
                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="lihatPajakgu dropdown-item" data-id="'.$row->id.'" href="/pajakgu/lihat/'.$row->id.'">Lihat</a></li>
                                            </ul>
                                        </div>
                                ';
                        }else{

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" data-id="'.$row->id.'" href="/pajakgu/edit/'.$row->id.'">Ubah</a></li>
                                                <li><a class="deletePajakgu dropdown-item" data-id="'.$row->id.'" href="javascript:void(0)">Delete</a></li>
                                            </ul>
                                        </div>
                                ';
                        }

                        return $btn;
                    // })
                    // ->addColumn('status1', function($row1){
                    //     $status = '';
                    //     if($row1->status1 == '1') {
                    //         $status = '<div class="badge bg-success">'.$row1->status1.'</div>';
                    //     }else {
                    //         $status = '<div class="badge bg-danger">'.$row1->status1.'</div>';
                    //     }
                    //     return $status;
                    })
                    // <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" class="aktifPajakls btn btn-danger btn-sm">Tolak
                    // </a>
                    // <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" class="tolakPajakls btn btn-secondary btn-sm">Terima
                    // </a>
                    ->addColumn('status2', function($row){
                        if($row->status2 == 'Tolak')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="terimaPajakgu btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="tolakPajakgu btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
                                    </a>
                                  ';
                        }
                        return $btn1;
                    })
                    ->addColumn('nilai_pajak', function($row) {
                        return number_format($row->nilai_pajak);
                    })
                    ->addColumn('nilai_sp2d', function($row) {
                        return number_format($row->nilai_sp2d);
                    })
                    // ->addColumn('totalnilai', function($row) {
                    //     $total = PajaklsModel::sum('nilai_pajak');
                    //     return number_format($total);
                    // })
                    ->rawColumns(['action', 'status2', 'nilai_pajak', 'nilai_sp2d'])
                    ->make(true);
                    
        }  

        return view('Pajak_GU.Tampilpajakgu', $data);
    }

    public function totalpajakgu()
    {
        // $data = array(
        //     'totalnilai' => PajaklsModel::sum('nilai_pajak')->first(),
        // );

        $total = PajaklsModel::sum('nilai_pajak'); 
        // return response()->json(['total' => number_format($total)]);
        return view('Pajak_GU.Modal.Datapajakls', $total);
    }

    public function pilihpajakgusipd(Request $request)
    {

        if ($request->ajax()) {

            $datapajaklssipdgu = DB::table('potongan2')
                            ->select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak', 'sp2d.nama_skpd')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->whereIn('potongan2.jenis_pajak', ['Pajak Pertambahan Nilai','Pajak Penghasilan Ps 22','Pajak Penghasilan Ps 23','PPh 21','Pajak Penghasilan Ps 4 (2)', 'Pajak Penghasilan PS 24'])
                            ->where('potongan2.status1',['0'])
                            ->where('sp2d.nama_skpd', auth()->user()->nama_opd)
                            ->get();

            return Datatables::of($datapajaklssipdgu)
                    ->addIndexColumn()
                    ->addColumn('status2', function($row){
                        $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="editPajakgusipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </a>
                                ';

                        return $btn1;
                    })
                    ->rawColumns(['status2'])
                    ->make(true);
        }

        return view('Pajak_GU.Tampilpajakgu');
    }

    public function store(Request $request)
    {
        $dtidopd = DB::table('opd')
            ->select ('id')
            ->where('id', auth()->user()->id_opd)
            ->get();
            

            foreach ($dtidopd as $row1){
                $id_opd = $row1->id;
            }

        request()->validate([
            'bukti_pemby' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        ]);

        // $nomoracak = Str::random(10);
        $pajakguId = $request->id;
        // $pajaklsId_potonganls = $request->id_potonganls;
        // $pajaklsebilling = $request->ebilling;

        $cek_ebilling = PajakguModel::where('ebilling', $request->ebilling)->where('id', '!=', $request->id)->first();
        $cek_ntppn = PajakguModel::where('ntpn', $request->ntpn)->where('id', '!=', $request->id)->first();

        if($cek_ebilling)
        {
            return response()->json(['error'=>'Ebilling sudah ada']);
        }
        elseif($cek_ntppn)
        {
            return response()->json(['error'=>'NTPN sudah ada']);
        }
        else
        {
            $detailspotongan2 = [
                'status1' => '1',
                'id_pajakkpp' => $request->id,
                'ebilling' => $request->ebilling,
                // 'jenis_pajak' => $request->jenis_pajak,
                // 'nilai_pajak' =>str_replace('.','', $request->nilai_pajak),
            ];

            $detailspajakgu = [
                'ebilling' => $request->ebilling, 
                'ntpn' => $request->ntpn, 
                'akun_pajak' => $request->akun_pajak,
                'jenis_pajak' => $request->jenis_pajak,
                'nilai_pajak' =>str_replace('.','', $request->nilai_pajak),
                'rek_belanja' => $request->rek_belanja,
                'nama_npwp' => $request->nama_npwp,
                'nomor_npwp' => $request->nomor_npwp,
                'id_opd' => $id_opd,
                // 'bukti_pemby' => $request->bukti_pemby,
                'status2' => 'Terima',
                // 'id_potonganls' => $request->id_potonganls,
                // 'id_potonganls' => $request->id,
                'id_potonganls' => $request->id,
            ];

            if ($files = $request->file('bukti_pemby')){
                $destinationPath = 'app/assets/images/bukti_pemby_pajak/';
                $profileImage = " Simelajang " . " - " .date('YmdHis')." - " .$files->getClientOriginalName();
                $files->move($destinationPath, $profileImage);
                $detailspajakgu['bukti_pemby'] = "$profileImage";
            }
        }

            PajakguModel::updateOrCreate(['id' => $pajakguId], $detailspajakgu);
            PotonganModel::updateOrCreate(['id' => $pajakguId], $detailspotongan2);
            // PotonganModel::updateOrCreate(['id' => $pajaklsId_potonganls], $detailspotongan);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'bukti_pemby' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',
        ]);

        $updatepajakgu = PajakguModel::where('id', $id)->first();
        // $updatepajakls = Pajakkpp::where('id', $id)->first();

        $cek_ebilling = PajakguModel::where('ebilling', $request->ebilling)->where('id', '!=', $request->id)->first();
        $cek_ntppn = PajakguModel::where('ntpn', $request->ntpn)->where('id', '!=', $request->id)->first();

        if($cek_ebilling)
        {
            return redirect('tampilpajakgu')->with(['error'=>'Ebilling sudah ada']);
        }
        elseif($cek_ntppn)
        {
            return redirect('tampilpajakgu')->with(['error'=>'NTPN sudah ada']);
        }
        else
        {
            PotonganModel::where('id_pajakkpp',$request->get('id_potonganls'))
                        ->update([
                            'status1' => '1',
                            'id_pajakkpp' => $request->id_potonganls,
                            'ebilling' => $request->ebilling,
                        ]);

            $updatepajakgu->id_potonganls = $request->get('id_potonganls');
            $updatepajakgu->akun_pajak = $request->get('akun_pajak');
            $updatepajakgu->ebilling = $request->get('ebilling');
            $updatepajakgu->ntpn = $request->get('ntpn');
            $updatepajakgu->nama_npwp = $request->get('nama_npwp');
            $updatepajakgu->nomor_npwp = $request->get('nomor_npwp');
            $updatepajakgu->jenis_pajak = $request->get('jenis_pajak');
            $updatepajakgu->rek_belanja = $request->get('rek_belanja');
            $updatepajakgu->id_opd = $request->get('id_opd');
            $updatepajakgu->nilai_pajak = str_replace('.','', $request->get('nilai_pajak'));
            $updatepajakgu->status2 = 'Terima';
            
            

            if ($request->file('bukti_pemby')) {
                if ($updatepajakgu->bukti_pemby){
                    File::delete('app/assets/images/bukti_pemby_pajak/'.$updatepajakgu->bukti_pemby);
                }
                $file = $request->file('bukti_pemby');
                $nama_file = " Simelajang " . " - " .date('YmdHis')." - " .$file->getClientOriginalName();
                $file->move('app/assets/images/bukti_pemby_pajak/', $nama_file);
                $updatepajakgu->bukti_pemby = $nama_file;
            }
            
        }
            $updatepajakgu->save();
            return redirect('/tampilpajakgu')->with(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Edit Data Pajak GU',
            'active_dtpajakguedit'       => 'active',
            'active_pajakguedit'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => ' Edit Data Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('id_opd', auth()->user()->id_opd)
                                    ->first(),
            'dtpajakgu'            => DB::table('pajakkppgu')
                                    ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'potongan2.nilai_pajak','pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'potongan2.status1', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'potongan2.id_pajakkpp', 'pajakkppgu.id_opd')
                                    // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                                    // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                                    ->join('potongan2',  'potongan2.id', 'pajakkppgu.id_potonganls')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->where('id_opd', auth()->user()->id_opd)
                                    // ->where('pajakkpp.status2', ['Terima'])
                                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                                    ->where('pajakkppgu.id', $id)
                                    ->first(),
        );
        // return response()->json($pajakls);
        return view('Pajak_GU.Modal.Ubahdata',$data);
    }

    public function lihat($id)
    {

        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Preview Data Pajak GU',
            'active_dtpajakgulihat'       => 'active',
            'active_pajakgulihat'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => ' Preview Data Pajak',
            'breadcumd2'           => 'GU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('id_opd', auth()->user()->id_opd)
                                    ->first(),
            'lihatpajakgu'            => DB::table('pajakkppgu')
                                        ->select('pajakkppgu.ebilling', 'sp2d.tanggal_sp2d', 'pajakkppgu.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkppgu.nomor_npwp', 'pajakkppgu.akun_pajak', 'pajakkppgu.ntpn', 'pajakkppgu.jenis_pajak', 'potongan2.nilai_pajak','pajakkppgu.rek_belanja','pajakkppgu.nama_npwp', 'pajakkppgu.id_potonganls', 'pajakkppgu.id', 'potongan2.status1', 'pajakkppgu.status2', 'pajakkppgu.created_at', 'pajakkppgu.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkppgu.nilai_pajak', 'potongan2.id_pajakkpp')
                                        // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                                        // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                                        ->join('potongan2',  'potongan2.id', 'pajakkppgu.id_potonganls')
                                        ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                        ->where('id_opd', auth()->user()->id_opd)
                                        // ->where('pajakkpp.status2', ['Terima'])
                                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-03-31'])
                                        ->where('pajakkppgu.id', $id)
                                        ->first(),
        );
        // return response()->json($pajakls);
        return view('Pajak_GU.Modal.Lihat',$data);
    }

    public function editpajakgu($id)
    {
        $where = array('id' => $id);
        $pajakgu = PajakguModel::where($where)->first();

        return response()->json($pajakgu);
    }

    public function editpajakgusipd($id)
    {
        $where = array('id' => $id);
        $pajaklssipdgu = PotonganModel::where($where)->first();

        return response()->json($pajaklssipdgu);
    }

    public function getDataakunpajak()
    {
        $akunpajak = DB::table('tb_akun_pajak')
        ->select('id', 'akun_pajak')
        ->get();
        return response()->json($akunpajak);
        // return view('Penatausahaan.Pajakls.Pajakls', compact('akunpajak'));
    }

    public function getDatajenispajak()
    {
        $jenispajak = DB::table('tb_jenis_pajak')
        ->select('id', 'jenis_pajak')
        ->get();
        return response()->json($jenispajak);
        // return view('Penatausahaan.Pajakls.Pajakls', compact('akunpajak'));
    }

    public function tolakgu($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PajakguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function tolakguupdate(Request $request, string $id)
    {

        PotonganModel::where('ebilling',$request->get('ebilling'))
        ->update([
            'status1' => '0',
        ]);

        PajakguModel::where('ebilling',$request->get('ebilling'))
        ->update([
            'status2' => 'Tolak',
        ]);

            return redirect('tampilpajakgu')->with('success','Data Berhasil Ditolak');
    }

    public function terimagu($id)
    {
        $where = array('id' => $id);
        $pajaklssipd = PajakguModel::where($where)->first();

        return response()->json($pajaklssipd);
    }

    public function terimaguupdate(Request $request, string $id)
    {

        PotonganModel::where('ebilling',$request->get('ebilling'))
        ->update([
            'status1' => '1',
        ]);

        PajakguModel::where('ebilling',$request->get('ebilling'))
        ->update([
            'status2' => 'Terima',
        ]);

            return redirect('tampilpajakgu')->with('success','Data Berhasil Ditolak');
    }
        

    public function terima(Request $request, $id)
    {
        // $where = array('id_pajakkpp' => $id);

        $pajakgudt = PajakguModel::findOrFail($id);
        
        $pajakgudt->update([
            'status2' => 'Terima',
        ]);

        // $pajaklsdt = PotonganModel::findOrFail($id);
        // $pajaklsdt->update([
        //     'status1' => '1',
        // ]);

        // $pajaklsdt = PotonganModel::where('id_pajakkpp',$request->id_potonganls);
        // $pajaklsdt->update([
        //     'status1' => '1',
        // ]);
        // dd($pajaklsdt);

        // PajaklsModel::where('ebilling',$request->get('ebilling'))
        // ->update([
        //     'status2' => 'Terima',
        //     // 'ebilling' => $request->get('ebilling'),
        //     // 'jenis_pajak' => $request->get('jenis_pajak'),
        // ]);

        // PotonganModel::where('ebilling',$request->get('ebilling'))
        // ->update([
        //     'status1' => '0',
        //     // 'ebilling' => $request->get('ebilling'),
        //     // 'jenis_pajak' => $request->get('jenis_pajak'),
        // ]);

        return response()->json(['success'=>'Data Berhasil Terima']);
    }

    public function destroy($id)
    {
        $data = PajakguModel::where('id',$id)->first(['bukti_pemby']);
        unlink("app/assets/images/bukti_pemby_pajak/".$data->bukti_pemby);

        PajakguModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

}
