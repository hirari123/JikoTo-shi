<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark purple-gradient">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#">JikoToーshi</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">

      @guest
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録
          <span class="sr-only">(current)</span>
        </a>
      </li>
      @endguest

      @guest
      <li class="nav-item">
        <a class="nav-link" href="#">ログイン</a>
      </li>
      @endguest

      @auth
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-pen mr-1"></i>投稿する</a>
      </li>
      @endauth

      @auth
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i></a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button" onclick="location.href=''">
            マイページ
          </button>
          <button form="logout-button" class="dropdown-item" type="submit">
            ログアウト
          </button>
        </div>
      </li>

      <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
      </form>
      <!-- Dropdown -->
      @endauth

    </ul>
    <!-- Links -->

  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->