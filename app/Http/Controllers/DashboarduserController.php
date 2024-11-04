<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboarduserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    $userId = Auth::guard('web')->user()->id;
    $data = array(
            'title'                => 'Home User',
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

        return view('Dashboard', $data);
    }
}
