@php use App\Models\User;use Illuminate\Support\Facades\Auth; @endphp
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo"> Dashboard </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-planet"></i>
                        <span class="notification">5</span>
                        <span class="d-lg-none">Notification</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="#">Notification 1</a>
                        <a class="dropdown-item" href="#">Notification 2</a>
                        <a class="dropdown-item" href="#">Notification 3</a>
                        <a class="dropdown-item" href="#">Notification 4</a>
                        <a class="dropdown-item" href="#">Another notification</a>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nc-icon nc-zoom-split"></i>
                        <span class="d-lg-block">&nbsp;Search</span>
                    </a>
                </li>
                <li class="nav-item">
                    <select class="form-control mb-3" name="countries" id="countries"
                            style="width: 100%; padding-right: 15px"
                            onchange="location = this.value;">
                        @if(session('locale') == 'vi' || session('locale') == null)
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'kr')
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'jp')
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'cn')
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                        @endif
                    </select>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @php
                    $user = User::find(Auth::user()->id);
                @endphp
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="no-icon">{{$user->name}}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="{{route('cart.index')}}">Cart</a>
                        <a class="dropdown-item" href="#">Something</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="divider"></div>
                        <div class=""></div>
                        <a onclick="logout();" id="btn-logout" class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
                <li class="nav-item" hidden>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button id="btn-logout-hidden" type="submit" class="nav-link">
                            <span class="no-icon">Log out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function logout() {
        document.getElementById('btn-logout-hidden').click();
    }
</script>
<!-- End Navbar -->
