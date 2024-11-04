<?php

namespace App\Http\Controllers;

use App\Models\PajaklsModel;
use App\Models\Sp2dModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    $userId = Auth::guard('web')->user()->id;
    $data = array(
            'title'                => 'Home Admin',
            'active_side_home'     => 'active',
            'active_home'          => 'active',
            'page_title'           => 'Main',
            'breadcumd1'           => 'Dashboard',
            'breadcumd2'           => 'Dashboard',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar',]),
            'opd'                  => DB::table('users')
                                    ->join('opd',  'opd.id', 'users.id_opd')
                                    // ->select('fullname','nama_opd')
                                    ->where('id_opd', auth()->user()->id_opd)
                                    ->first(),
        );

        $total_Ppn = PajaklsModel::sum('nilai_pajak');

        // $total_kas_masjid = $kas_masjid_masuk - $kas_masjid_keluar;
      
        return view('Dashboard', $data, ['total_Ppn'=>$total_Ppn]);

        // return view('Dashboard', $data);
    }
}
