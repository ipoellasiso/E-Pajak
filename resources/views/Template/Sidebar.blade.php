<div class="page-sidebar">
    <ul class="list-unstyled accordion-menu">
      <li class="sidebar-title">
        HOME
      </li>
      @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Verifikasi')
      <li @if(isset($active_side_home)){{ $active_side_home }} @endif>
        <a href="/home"><i data-feather="home"></i>Dashboard</a>
      </li>
      @endif
      @if(Auth::user()->role == 'User')
      <li>
        <a href="/homeuser"><i data-feather="home"></i>Dashboard</a>
      </li>
      @endif
      @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Verifikasi')
      <li class="sidebar-title">
        PENGATURAN
      </li>
      <li>
        <a href="index.html"><i data-feather="hard-drive"></i>Master Data<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          <li><a href="/tampilopd"><i class="far fa-circle"></i>Data OPD</a></li>
          <li><a href="/tampilakunpajak"><i class="far fa-circle"></i>Data Akun Pajak</a></li>
          <li><a href="/tampiljenispajak"><i class="far fa-circle"></i>Data Jenis Pajak</a></li>
        </ul>
      </li>
      <li>
        <a href="index.html"><i data-feather="user"></i>Kelola User<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          <li><a href="#"><i class="far fa-circle"></i>List User</a></li>
          <li><a href="#"><i class="far fa-circle"></i>Profil</a></li>
        </ul>
      </li>
      <li>
        <a href="index.html"><i data-feather="git-pull-request"></i>Tarik Pajak SIPD RI<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          <li><a href="/tarikpajaksipdri"><i class="far fa-circle"></i>LS</a></li>
          <li><a href="/tarikpajaksipdrigu"><i class="far fa-circle"></i>GU</a></li>
        </ul>
      </li>
      @endif
      <li class="sidebar-title">
        PENATAUSAHAAN
      </li>
      <li @if(isset($active_side_pajakls)){{ $active_side_pajakls }} @endif>
        <a href="index.html"><i data-feather="hard-drive"></i>Data Pajak<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Verifikasi')
          <li @if(isset($active_pajakls)){{ $active_pajakls }} @endif><a href="/tampilpajakls"><i class="far fa-circle"></i>LS</a></li>
          <li @if(isset($active_pajakgu)){{ $active_pajakgu }} @endif><a href="#"><i class="far fa-circle"></i>GU</a></li>
          @endif
          @if(Auth::user()->role == 'User')
          <li @if(isset($active_pajakgu)){{ $active_pajakgu }} @endif><a href="/tampilpajakgu"><i class="far fa-circle"></i>GU</a></li>
          @endif
        </ul>
      </li>
      @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Verifikasi')
      <li>
        <a href="index.html"><i data-feather="user"></i>Data Potongan<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          <li><a href="#"><i class="far fa-circle"></i>BPJS</a></li>
          <li><a href="#"><i class="far fa-circle"></i>TASPEN</a></li>
        </ul>
      </li>
      @endif
      <li class="sidebar-title">
        LAPORAN
      </li>
      <li>
        <a href="index.html"><i data-feather="printer"></i>Laporan Pajak<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Verifikasi')
          <li @if(isset($active_pajakls)){{ $active_pajakls }} @endif><a href="#"><i class="far fa-circle"></i>LS</a></li>
          <li @if(isset($active_pajakgu)){{ $active_pajakgu }} @endif><a href="#"><i class="far fa-circle"></i>GU</a></li>
          @endif
          @if(Auth::user()->role == 'User')
          <li @if(isset($active_pajakgu)){{ $active_pajakgu }} @endif><a href="#"><i class="far fa-circle"></i>GU</a></li>
          @endif
        </ul>
      </li>
      @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Verifikasi')
      <li>
        <a href="index.html"><i data-feather="user"></i>Laporan Potongan<i class="fas fa-chevron-right dropdown-icon"></i></a>
        <ul class="">
          <li><a href="#"><i class="far fa-circle"></i>BPJS</a></li>
          <li><a href="#"><i class="far fa-circle"></i>TASPEN</a></li>
        </ul>
      </li>
      @endif
    </ul>
</div>