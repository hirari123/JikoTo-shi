<!-- ナビゲーションバー -->

<nav class="navbar navbar-expand navbar-dark peach-gradient">

  <a class="navbar-brand" href="/"><i class="fas fa-user-clock"></i>JikoTo-shi</a>

  <ul class="navbar-nav ml-auto">

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{route('register')}}"><i class="fas fa-user-tag"></i>ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i>ログイン</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <input type="hidden"  name="email" value="登録したデータ">
      <input type="hidden"  name="password" value="登録したデータ">
      <a class="nav-link" href="{{ route('login.guest') }}"><i class="fas fa-user-shield"></i>かんたんログイン</a>
    </li>
    @endguest

    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{route('articles.create')}}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{route("users.show", ["name" => Auth::user()->name])}}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{route('logout')}}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth

  </ul>

</nav>