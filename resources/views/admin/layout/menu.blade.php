{{-- @if ($user->role == '1') --}}
@if (auth()->user()->role == '1')

<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">Home</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-layout-dashboard"></i>
    </span>
    <span class="hide-menu">Dashboard</span>
  </a>
</li>
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Data Master</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('ebook.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-book-upload"></i>
    </span>
    <span class="hide-menu">E-Book</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-category"></i>
      </span>
      <span class="hide-menu">Kategori</span>
    </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('laporanjmlhpembaca.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-report"></i>
    </span>
    <span class="hide-menu">Laporan Jumlah Pembaca</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('laporanulasan.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-file-description"></i>
    </span>
    <span class="hide-menu">Laporan Ulasan</span>
    </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('banner.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-slideshow"></i>
    </span>
    <span class="hide-menu">Banner</span>
  </a>
</li>
<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">AUTH</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('datapembaca.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-user"></i>
    </span>
    <span class="hide-menu">Data Pembaca</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('dataadmin.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-user-plus"></i>
    </span>
    <span class="hide-menu">Data Admin</span>
  </a>
</li>
<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">EXTRA</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('log.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-clock"></i>
    </span>
    <span class="hide-menu">Log Aktivitas</span>
  </a>
</li>

{{-- @elseif ($user->role == '2') --}}
@elseif (auth()->user()->role == '2')

<li class="nav-small-cap">
  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
  <span class="hide-menu">Home</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-layout-dashboard"></i>
    </span>
    <span class="hide-menu">Dashboard</span>
  </a>
</li>
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Data Master</span>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('ebook.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-book-upload"></i>
    </span>
    <span class="hide-menu">E-Book</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-category"></i>
      </span>
      <span class="hide-menu">Kategori</span>
    </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('laporanjmlhpembaca.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-report"></i>
    </span>
    <span class="hide-menu">Laporan Jumlah Pembaca</span>
  </a>
</li>
<li class="sidebar-item">
  <a class="sidebar-link" href="{{ route('laporanulasan.index') }}" aria-expanded="false">
    <span>
      <i class="ti ti-file-description"></i>
    </span>
    <span class="hide-menu">Laporan Ulasan</span>
    </a>
</li>

@endif