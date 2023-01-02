<div class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="/images/logo-1.png" alt="Melpit" style="height: 39px">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form action="{{ route('top') }}" method="get" class="form-inline">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="category" class="custom-select">
                                <option value="">全て</option>
                                @foreach ($categories as $category)
                                    <option value="primary:{{ $category->id }}" class="font-weight-bold" {{ $defaults['category'] == "primary:" . $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @foreach ($category->secondaryCategories  as $secondary)
                                        <option value="secondary:{{ $secondary->id }}" {{ $defaults['category'] == "secondary:" . $secondary->id ? 'selected' : '' }}>{{ $secondary->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <input type="text" name="keyword" class="form-control" value="{{ $defaults['keyword'] }}" aria-label="Text input with dropdown button" placeholder="キーワード検索">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-online-dark">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                @guest
                    {{-- 非ログイン --}}
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-secondary ml-3" role="button">会員登録</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-info ml-2" role="button">ログイン</a>
                    </li>
                @else
                    {{-- ログイン済み --}}
                    <li class="nav-item dropdown ml-2">
                        {{-- ログイン情報 --}}
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false" v-pre>
                            @if (!empty($user->avatar_file_name))
                                <img src="/storage/avatars/{{ $user->avatar_file_name }}" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px">
                            @else    
                                <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px">
                            @endif
                            {{ $user->name }} <span class="caret"></span>
                        </a>

                        {{-- ドロップダウンメニュー --}}
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="dropdown-item-text">
                                <div class="row no-gutters">
                                    <div class="col">売上金</div>
                                    <div class="col-auto">
                                        <i class="fas fa-yen-sign"></i>
                                        <span class="ml-1">{{ number_format($user->sales) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item-text">
                                <div class="row no-gutters">
                                    <div class="col">出品数</div>
                                    <div class="col-auto">{{ number_format($user->soldItems->count()) }} 個</div>
                                </div>
                            </div>
                            <div class="dropdown-driver"></div>
                            <a href="{{ route('sell') }}" class="dropdown-item">
                                <i class="fas fa-camera text-left" style="width: 30px"></i>商品を出品する
                            </a>

                            <a href="{{ route('mypage.sold-items') }}" class="dropdown-item">
                                <i class="fas fa-store-alt text-left" style="width: 30px"></i>出品した商品
                            </a>
                            
                            <a href="{{ route('mypage.bought-items') }}" class="dropdown-item">
                                <i class="fas fa-shopping-bag text-left" style="width: 30px"></i>購入した商品
                            </a>
                            
                            <a href="{{ route('mypage.edit-profile') }}" class="dropdown-item">
                                <i class="far fa-address-card text-left" style="width: 30px"></i>プロフィール編集
                            </a>
                            
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt text-left" style="width: 30px"></i>ログアウト
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>