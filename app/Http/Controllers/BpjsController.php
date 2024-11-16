<?php

namespace App\Http\Controllers;

use App\Models\AkunpajakModel;
use App\Models\BpjsModel;
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

class BpjsController extends Controller
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
            'title'                => 'Data Potongan BPJS',
            'active_side_potbpjs'  => 'active',
            'active_potbpjs'       => 'active',
            'page_title'           => 'Penatausahaan',
            'breadcumd1'           => 'Data Potongan',
            'breadcumd2'           => 'BPJS',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    // ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('nama_opd', auth()->user()->nama_opd)
                                    ->first(),
            'total_4'              => BpjsModel::join('potongan2',  'potongan2.id', 'tb_bpjs.id_bpjs')->where('tb_bpjs.akun_potongan', '800001')->sum('potongan2.nilai_pajak'),
            'total_1'              => BpjsModel::join('potongan2',  'potongan2.id', 'tb_bpjs.id_bpjs')->where('tb_bpjs.akun_potongan', '800002')->sum('potongan2.nilai_pajak'),
            'total_potongan'       => BpjsModel::join('potongan2',  'potongan2.id', 'tb_bpjs.id_bpjs')->sum('potongan2.nilai_pajak'),
        );

        if ($request->ajax()) {

            $databpjs = DB::table('tb_bpjs')
                        ->select('tb_bpjs.id_bpjs', 'tb_bpjs.ebilling', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'tb_bpjs.nomor_npwp', 'tb_bpjs.akun_potongan', 'tb_bpjs.ntpn', 'tb_bpjs.jenis_potongan', 'potongan2.nilai_pajak','tb_bpjs.rek_belanja','tb_bpjs.nama_npwp', 'tb_bpjs.id_potonganls', 'tb_bpjs.id', 'potongan2.status1', 'tb_bpjs.status2', 'tb_bpjs.created_at', 'tb_bpjs.bukti_pemby', 'sp2d.nilai_sp2d', 'tb_bpjs.nilai_potongan', 'potongan2.id_pajakkpp')
                        // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                        // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                        ->join('potongan2',  'potongan2.id', 'tb_bpjs.id_bpjs')
                        ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                        // ->where('pajakkpp.status2', ['Terima'])
                        // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-12-31'])
                        ->get();

            return Datatables::of($databpjs)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status1 == 'Terima')
                        {
                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="lihatBpjs dropdown-item" data-id="'.$row->id.'" href="/bpjs/lihat/'.$row->id.'">Lihat</a></li>
                                            </ul>
                                        </div>
                                ';
                        }else{

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" data-id="'.$row->id.'" href="/bpjs/edit/'.$row->id.'">Ubah</a></li>
                                                <li><a class="deleteBbpjs dropdown-item" data-id="'.$row->id.'" href="javascript:void(0)">Delete</a></li>
                                            </ul>
                                        </div>
                                ';
                        }

                        return $btn;
                    })
                    ->addColumn('status1', function($row){
                        if($row->status1 == 'Tolak')
                        {
                            $btn1 = '
                                    
                                  <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="terimaBpjs btn btn-outline-danger m-b-xs"><i class="fas fa-thumbs-down"></i> Tolak
                                    </a>
                                  ';
                        }else {
                            $btn1 = '
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" data-ebilling="'.$row->ebilling.'" data-ntpn="'.$row->ntpn.'" class="tolakBpjs btn btn-outline-primary m-b-xs"> <i class="fas fa-thumbs-up"></i> Terima
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
                    ->rawColumns(['action', 'status1', 'nilai_pajak', 'nilai_sp2d'])
                    ->make(true);
                    
        }  

        return view('Bpjs.Bpjs', $data);
    }

    public function pilihbpjssipd(Request $request)
    {

        if ($request->ajax()) {

            $databpjssipd = DB::table('potongan2')
                            ->select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak')
                            ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                            ->whereIn('potongan2.jenis_pajak', ['Askes', 'Iuran Jaminan Kesehatan 4%', 'Belanja Iuran Jaminan Kesehatan PPPK', 'Belanja Iuran Jaminan Kesehatan PNS', 'Iuran Wajib Pegawai 1%'])
                            ->where('potongan2.status1',['0'])
                            ->where('sp2d.jenis',['LS'])
                            ->get();

            return Datatables::of($databpjssipd)
                    ->addIndexColumn()
                    ->addColumn('status1', function($row){
                        $btn1 = '
                                    <button href="javascript:void(0)" id="add_cart" 
                                    data-id="'.$row->id.'" 
                                    data-tanggal_sp2d="'.$row->tanggal_sp2d.'" 
                                    data-nomor_sp2d="'.$row->nomor_sp2d.'" 
                                    data-nilai_sp2d="'.$row->nilai_sp2d.'" 
                                    data-jenis_pajak="'.$row->jenis_pajak.'" 
                                    data-nilai_pajak="'.$row->nilai_pajak.'" 
                                    
                                    class="editpotcartsipd btn btn-outline-info m-b-xs btn-sm">Pilih
                                    </button>
                                ';

                        return $btn1;
                    })
                    ->addColumn('nilai_pajak1', function($row) {
                        return number_format($row->nilai_pajak);
                    })
                    ->addColumn('nilai_sp2d1', function($row1) {
                        return number_format($row1->nilai_sp2d);
                    })
                    ->rawColumns(['status1', 'nilai_pajak1', 'nilai_sp2d1'])
                    ->make(true);
        }

        return view('Bpjs.Bpjs');
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[$request->id] = [
            "id"                => $request->id,
            "tanggal_sp2d"      => $request->tanggal_sp2d,
            "nomor_sp2d"        => $request->nomor_sp2d,
            "nilai_sp2d"        => number_format($request->nilai_sp2d),
            "jenis_pajak"       => $request->jenis_pajak,
            "nilai_pajak"       => number_format($request->nilai_pajak),
        ];

        session()->put('cart', $cart);
        echo $this->load_cart($request);
    }

    public function load_cart(Request $request)
    {
		if ($request->ajax()) {

            $cart = session()->get('cart', []);
            
            return Datatables::of($cart)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                   $btn = '
                            <center>
                                <button type="button" id="'.$row['id'].'" class="hapus_cart btn btn-outline-danger m-b-xs">
                                <i class="fa fa-trash"></i> Hapus
                                </button>
                            </center>
                          ';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function deleteCart(Request $request, $id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            echo $this->load_cart($request);
        }
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart');
        
        $nomorsp2d     = $request->nomor_sp2d;
        $dts = "1";
        // $nomorsp2d = BpjsModel::where('id', $id)->first();

        foreach($cart as $g){

            $id_bpjs = $g['id'];

        }

        $noid_bpjs = BpjsModel::where('id_bpjs', $id_bpjs)->where('id', '!=', $id_bpjs)->first();
        // $noid_bpjs = BpjsModel::select('id_bpjs')
        //                         // ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
        //                         // ->where('sp2d', $nomorsp2d)
        //                         ->where('id', $id_bpjs)
        //                         ->first();

        if($noid_bpjs)
        {
            return redirect()->back()->with(['error'=>'Potongan BPJS sudah ada']);
        }
        else
        {   
            foreach($cart as $rows){
                PotonganModel::where('id', $rows)
                            ->update([
                                'status1' => '1',
                                // 'id_pajakkpp' => $request->id_potonganls,
                                // 'ebilling' => $request->ebilling,
                            ]);
            }
            

            foreach($cart as $items){
    
                BpjsModel::create([
                    'id_bpjs'           => $items['id'],
                    'ebilling'          => $request->ebilling,
                    // 'jenis_potongan'    => $request->jenis_pajak,
                    'akun_potongan'     => $request->akun_potongan,
                    // 'nilai_potongan'    => $request->nilai_pajak,
                    'nama_npwp'         => $request->nama_npwp,
                    'nomor_npwp'        => $request->nomor_npwp,
                    'ntpn'              => $request->ntpn,
                    // 'id_potonganls'     => $request->id_potonganls,
                    'rek_belanja'       => $request->rek_belanja,

                ]);
                
            }
            session()->forget('cart');
            return redirect('/tampilbpjs')->with('success', 'Data Disimpan');
        }
    }

    public function editpotcartsipd($id)
    {
        
        $where = array('id' => $id);
        $pajaklssipd = PotonganModel::select('potongan2.ebilling', 'potongan2.id', 'potongan2.status1', 'sp2d.tanggal_sp2d', 'sp2d.nomor_sp2d', 'sp2d.nilai_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'sp2d.npwp_pihak_ketiga', 'sp2d.no_rek_pihak_ketiga', 'potongan2.jenis_pajak', 'potongan2.nilai_pajak', 'potongan2.id_potongan')
                                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                                    ->whereIn('potongan2.jenis_pajak', ['Askes', 'Iuran Jaminan Kesehatan 4%', 'Belanja Iuran Jaminan Kesehatan PPPK', 'Belanja Iuran Jaminan Kesehatan PNS', 'Iuran Wajib Pegawai 1%'])
                                    ->where('potongan2.status1',['0'])
                                    ->where('sp2d.jenis',['LS'])
                                    ->where($where)
                                    ->first();

        return response()->json($pajaklssipd);
    }

}