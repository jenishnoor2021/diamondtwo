<nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
        <i class="icon-menu menu-icon"></i>
      </a>
    </li>
  </ul>

  <div>
    <form method="GET" action="{{ route('dimond.detail') }}" class="mx-auto">
      @csrf
      <input type="text" id="inputField" name="inputField" placeholder="Search barcode / diamond name" value="{{request()->inputField}}" style="color:white;background-color:transparent;" required>
    </form>
  </div>

  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
      @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
      </div>
      @endif
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="{{asset('/images/user-icone.png')}}" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-item user-details">
          <a href="javaScript:void();">
            <div class="media">
              <div class="avatar"><img class="align-self-start mr-3" src="{{asset('/images/user-icone.png')}}" alt="user avatar"></div>
              <div class="media-body">
                <h6 class="mt-2 user-title">{{Session::get('user')['name']}}</h6>
                <p class="user-subtitle">{{Session::get('user')['email']}}</p>
              </div>
            </div>
          </a>
        </li>
        <a href="/profile/{{Session::get('user')['id']}}">
          <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        </a>
        <li class="dropdown-divider"></li>
        <a href="/logout">
          <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
        </a>
      </ul>
    </li>
  </ul>
</nav>