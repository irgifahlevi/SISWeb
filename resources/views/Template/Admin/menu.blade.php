<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    {{-- route admin --}}
    <a href="{{route('admin.index')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg
          width="25"
          viewBox="0 0 25 42"
          version="1.1"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
        >
          <defs>
            <path
              d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
              id="path-1"
            ></path>
            <path
              d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
              id="path-3"
            ></path>
            <path
              d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
              id="path-4"
            ></path>
            <path
              d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
              id="path-5"
            ></path>
          </defs>
          <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
              <g id="Icon" transform="translate(27.000000, 15.000000)">
                <g id="Mask" transform="translate(0.000000, 8.000000)">
                  <mask id="mask-2" fill="white">
                    <use xlink:href="#path-1"></use>
                  </mask>
                  <use fill="#696cff" xlink:href="#path-1"></use>
                  <g id="Path-3" mask="url(#mask-2)">
                    <use fill="#696cff" xlink:href="#path-3"></use>
                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                  </g>
                  <g id="Path-4" mask="url(#mask-2)">
                    <use fill="#696cff" xlink:href="#path-4"></use>
                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                  </g>
                </g>
                <g
                  id="Triangle"
                  transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                >
                  <use fill="#696cff" xlink:href="#path-5"></use>
                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">SISWEB</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{\Route::is('admin.index') ? 'active' : ''}}">
      <a href="{{route('admin.index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('registrasi.index', 'account_siswa.index') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-user-account"></i>
        <div data-i18n="User interface">Akun</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('registrasi.index', 'account_siswa.index') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('registrasi.index') ? 'active' : ''}}">
          <a href="{{route('registrasi.index')}}" class="menu-link">
            <div data-i18n="Accordion">Akun request</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('account_siswa.index') ? 'active' : ''}}">
          <a href="{{route('account_siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Akun siswa</div>
          </a>
        </li>
      </ul>
    </li>


    <li class="menu-item {{ request()->routeIs('profile-siswa.index', 'wali-siswa.index') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-group"></i>
        <div data-i18n="User interface">Data siswa & wali</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('profile-siswa.index', 'wali-siswa.index') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('profile-siswa.index') ? 'active' : ''}}">
          <a href="{{route('profile-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Siswa</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('wali-siswa.index') ? 'active' : ''}}">
          <a href="{{route('wali-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Wali</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('tagihan-siswa.index', 'transaki-tagihan.index') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
        <div data-i18n="User interface">Tagihan siswa</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('tagihan-siswa.index', 'transaki-tagihan.index') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('tagihan-siswa.index') ? 'active' : ''}}">
          <a href="{{route('tagihan-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Daftar tagihan</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('transaki-tagihan.index') ? 'active' : ''}}">
          <a href="{{route('transaki-tagihan.index')}}" class="menu-link">
            <div data-i18n="Accordion">Transaksi tagihan</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('transaki-pendaftaran.index', 'data-pendaftaran-siswa.index', 'dokumen-pendaftaran-siswa.index', 'info-sleksi-calon-siswa.index') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-columns"></i>
        <div data-i18n="User interface">Data pendaftaran</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('transaki-pendaftaran.index', 'data-pendaftaran-siswa.index', 'dokumen-pendaftaran-siswa.index', 'info-sleksi-calon-siswa.index') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('transaki-pendaftaran.index') ? 'active' : ''}}">
          <a href="{{route('transaki-pendaftaran.index')}}" class="menu-link">
            <div data-i18n="Accordion">Pendaftar</div>
          </a>
        </li>
        <li class="menu-item {{\Route::is('data-pendaftaran-siswa.index') ? 'active' : ''}}">
          <a href="{{route('data-pendaftaran-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Calon siswa</div>
          </a>
        </li>
        <li class="menu-item {{\Route::is('dokumen-pendaftaran-siswa.index') ? 'active' : ''}}">
          <a href="{{route('dokumen-pendaftaran-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Dokumen Pendaftar</div>
          </a>
        </li>
        <li class="menu-item {{\Route::is('info-sleksi-calon-siswa.index') ? 'active' : ''}}">
          <a href="{{route('info-sleksi-calon-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Seleksi Pendaftar</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('request.generate.token') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-chart"></i>
        <div data-i18n="User interface">Request token</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('request.generate.token') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('request.generate.token') ? 'active' : ''}}">
          <a href="{{route('request.generate.token')}}" class="menu-link">
            <div data-i18n="Accordion">Request generate token</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('info-pendaftaran.index', 'biaya-pendaftaran.index', 'kelas-siswa.index') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="User interface">Master data</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('info-pendaftaran.index', 'biaya-pendaftaran.index', 'kelas-siswa.index') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('info-pendaftaran.index') ? 'active' : ''}}">
          <a href="{{route('info-pendaftaran.index')}}" class="menu-link">
            <div data-i18n="Accordion">Info pendaftaran</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('biaya-pendaftaran.index') ? 'active' : ''}}">
          <a href="{{route('biaya-pendaftaran.index')}}" class="menu-link">
            <div data-i18n="Accordion">Biaya pendaftaran</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('kelas-siswa.index') ? 'active' : ''}}">
          <a href="{{route('kelas-siswa.index')}}" class="menu-link">
            <div data-i18n="Accordion">Kelas siswa</div>
          </a>
        </li>

      </ul>
    </li>
    <li class="menu-item {{ request()->routeIs('slider-content.index', 'ekskul-content.index', 'konten-berita.index', 'galeri-content.index', 'fasilitas.index', 'visimisi.index', 'sejarah.index', 'pengantarKepsek.index', 'tenaga-pendidik.index', 'kurikulum-sekolah.index', 'prestasi-sekolah.index') ? 'active' : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-book-content"></i>
        <div data-i18n="User interface">Kelola content</div>
      </a>
      <ul class="menu-sub" {{ request()->routeIs('slider-content.index', 'ekskul-content.index', 'konten-berita.index', 'galeri-content.index', 'fasilitas.index', 'visimisi.index', 'sejarah.index', 'pengantarKepsek.index', 'tenaga-pendidik.index', 'kurikulum-sekolah.index', 'prestasi-sekolah.index') ? 'style=display:block' : '' }} >
        <li class="menu-item {{\Route::is('slider-content.index') ? 'active' : ''}}">
          <a href="{{route('slider-content.index')}}" class="menu-link">
            <div data-i18n="Accordion">Slider</div>
          </a>
        </li>
        <li class="menu-item {{\Route::is('ekskul-content.index') ? 'active' : ''}}">
          <a href="{{route('ekskul-content.index')}}" class="menu-link">
            <div data-i18n="Alerts">Ekstrakurikuler</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('konten-berita.index') ? 'active' : ''}}">
          <a href="{{route('konten-berita.index')}}" class="menu-link">
            <div data-i18n="Alerts">Berita</div>
          </a>
        </li>

        <li class="menu-item {{\Route::is('galeri-content.index')? 'active' : ''}}">
          <a href="{{route('galeri-content.index')}}" class="menu-link">
            <div data-i18n="Buttons">Galeri</div>
          </a>
        </li>
        <li class="menu-item {{\Route::is('fasilitas.index')? 'active' : ''}}">
          <a href="{{route('fasilitas.index')}}" class="menu-link">
            <div data-i18n="Carousel">Fasilitas</div>
          </a>
        </li>
        <li class="menu-item {{ \Route::is('visimisi.index')? 'active' : '' }}">
          <a href="{{ Route('visimisi.index') }}" class="menu-link">
            <div data-i18n="Collapse">Visi Misi</div>
          </a>
        </li>
        <li class="menu-item {{ \Route::is('sejarah.index')? 'active' : '' }}">
          <a href="{{ Route('sejarah.index') }}" class="menu-link">
            <div data-i18n="Dropdowns">Sejarah</div>
          </a>
        </li>
        <li class="menu-item {{ \Route::is('pengantarKepsek.index')? 'active' : '' }}">
          <a href="{{ Route('pengantarKepsek.index') }}" class="menu-link">
            <div data-i18n="Footer">Pengantar Kepsek</div>
          </a>
        </li>
        <li class="menu-item {{ \Route::is('tenaga-pendidik.index')? 'active' : '' }}">
          <a href="{{ Route('tenaga-pendidik.index') }}" class="menu-link">
            <div data-i18n="Footer">Tenaga pendidik</div>
          </a>
        </li>
        <li class="menu-item {{ \Route::is('kurikulum-sekolah.index')? 'active' : '' }}">
          <a href="{{ Route('kurikulum-sekolah.index') }}" class="menu-link">
            <div data-i18n="Footer">Kurikulum sekolah</div>
          </a>
        </li>
        <li class="menu-item {{ \Route::is('prestasi-sekolah.index')? 'active' : '' }}">
          <a href="{{ Route('prestasi-sekolah.index') }}" class="menu-link">
            <div data-i18n="Footer">Prestasi sekolah</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
