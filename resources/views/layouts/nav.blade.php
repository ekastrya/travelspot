<nav>
    <div class="hidden-md-up">
        {{-- <a id="js-go-download-app1" href="/">
            <div class="top-banner">
                <div class="row">
                    <div class="col-xs-10">
                        <img class="top-banner__icon" src="{ {asset('img/logo-white.png')} }" alt="Logo white" height="25" />
                        <div class="top-banner__title">Download the app and book your destination on the go!</div>
                    </div>
                    { {-- <div class="col-xs-2">
                        <div class="top-banner__get pull-right">GET</div>
                    </div> --} }
                </div>
            </div>
        </a> --}}
        <div class="nav">
            <label class="nav-trigger__label" for="nav-trigger">
                <div class="burger">
                    <div class="burger-item"></div>
                    <div class="burger-item"></div>
                    <div class="burger-item"></div>
                </div>
            </label>
            <div class="logo1" style="padding-top: 12px"><a href="/"><img class="logo1" src="{{asset('img/logo.jpeg')}}" alt="Logo" height="25" /></a></div>
        </div>
    </div>
    <div class="hidden-sm-down">
        <div class="nav-large">
            <div class="logo-large"><a href="/"><img src="{{asset('img/logo.jpeg')}}" alt="Logo" /></a></div>
            <div class="nav-links"><a class="nav-link active" href="{{url('/')}}">HOME</a></div>
            <div class="auth-links">
                @if(\Auth::check() && \Auth::user()->role->slug == 'client')
                <a class="auth-link" href="{{route('client.home')}}">{{\Auth::user()->client->fullname}}</a>
                <a class="auth-link" href="{{route('logout')}}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                @elseif(\Auth::check() && \Auth::user()->role->slug == 'photographer')
                <a class="auth-link" href="{{route('photographer.home')}}">{{\Auth::user()->photographer->fullname}}</a>
                @elseif(\Auth::check() && \Auth::user()->role->slug == 'admin')
                <a class="auth-link" href="{{route('admin.dashboard')}}">Go to Admin Dashboard</a>
                @else
                <a class="auth-link" href="/register">Sign Up</a>
                <div class="login-trigger">
                    <a class="auth-link login-link" onclick="event.preventDefault();" href="#">Log In</a>
                    <div class="login-box">
                        <div class="login-form">
                            <form action="/login" accept-charset="UTF-8" method="post">
                                {{csrf_field()}}<input placeholder="Email" class="input margin" type="email" name="email" id="user_email" /><input placeholder="Password" autocomplete="off" class="input margin" type="password" name="password" id="user_password" />
                                <div class="login-form__checkbox"><input name="user[remember_me]" type="hidden" value="0" /><input class="login-form__checkbox-input" id="login" type="checkbox" value="1" name="user[remember_me]" /><label class="login-form__checkbox-label" for="login">Remember me</label></div>
                                <div class="login-form__forgot-password"><a href="{{route('password.request')}}">Forgot Password?</a></div>
                                <input type="submit" name="commit" value="Log In" class="submit" data-disable-with="Log In" />
                            </form>
                            <hr class="separator" />
                            <div class="login-form__social-media"></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</nav>