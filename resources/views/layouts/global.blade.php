<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-param" content="authenticity_token" />
        <meta name="csrf-token" content="{{csrf_token()}}" />
        <title>Travelspot</title>
        <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}">
        <!--[if IE]><link rel="shortcut icon" href="{{asset('favicon.ico')}}"><![endif]-->
        <link rel="icon" href="{{asset('favicon.ico')}}">
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="#ffffff" name="theme-color" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet" />
        @section('headscriptbefore')
        @show
        <style type="text/css">@font-face {
            font-family: 'May Wilde';
            font-style: normal;
            font-weight: normal;
            src: url(https://di1q6rmvbrdka.cloudfront.net/misc/fonts/6116ddce-0b38-4e55-afc7-549abd7032ce.otf) format('truetype');
            }
            /* latin */
            @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(/assets/dashboard/DXI1ORHCpsQm3Vp6mXoaTRampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
            }
            /* latin */
            @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(/assets/dashboard/cJZKeOuBrn4kERxqtaUH3ZBw1xU1rKptJj_0jans920.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
            }
            /* latin */
            @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            src: local('Open Sans Semibold'), local('OpenSans-Semibold'), url(/assets/dashboard/MTP_ySUJH_bn48VBG8sNShampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
            }
            /* latin */
            @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(/assets/dashboard/k3k702ZOKiLJc3WVjuplzBampu5_7CjHW5spxoeN3Vs.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
            }
        </style>
        <style>
        .snappr-day-availability--morning .snappr-ui-state-default:before, .snappr-ui-widget-content .snappr-day-availability--morning .snappr-ui-state-default:before, .snappr-ui-widget-header .snappr-day-availability--morning .snappr-ui-state-default:before{
        border-right: 8px solid #6BA0FF!important;
        }
        .snappr-day-availability--afternoon .snappr-ui-state-default:after, .snappr-ui-widget-content .snappr-day-availability--afternoon .snappr-ui-state-default:after, .snappr-ui-widget-header .snappr-day-availability--afternoon .snappr-ui-state-default:after {
        border-right:8px solid #6BA0FF!important;
        }
        .snappr-select-list .snappr-select-list__item--selected, .snappr-checkbox.snappr-big-check--radio input:checked~.snappr-big-check-indicator {
        background-color: #6BA0FF!important;
        }
        .snappr-checkbox.snappr-big-check--radio input:checked~.snappr-big-check-indicator{
        border: 2px solid #fff;
        background-size: 100% 100%;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiP…MyLjMsMSwxLDIuMywxLDRzMS4zLDMsMywzczMtMS4zLDMtM1M1LjcsMSw0LDF6Ii8+PC9zdmc+);
        }
        .snappr-btn-success  {
        background-color: #1f6fff!important;
        }
        .snappr-select-list .snappr-select-list__item-desc {
        color:#6BA0FF!important;
        }
        .snappr-btn {
        box-shadow:none!important;
        }
        .snappr-btn:hover {
        box-shadow: 0 8px 16px 4px rgba(0, 0, 0, .3)!important;
        color: #fff;
        opacity: 1!important;
        }
        .snappr-forward:hover {
        background-color: #0b4fc9!important;
        }
        .snappr-modal-footer {
        background: white!important;
        border: none!important;
        }
        .snappr-breadcrumb li+li:before {
        content:"» ";
        }
        </style>
        <link rel="stylesheet" media="all" href="/css/application-f14593bf0fe46e6a9ecb01a27baad8f94a512fecabd06329c78f87f245c1ca93.css" />
        @section('headscript')
        @show
    </head>
    <body>
        <div class="sweetescape production ">
            <div class="ask-and-it-will-be-given-to-you-seek-and-you-will-find-knock-and-the-door-will-be-opened-to-you"></div>
            
            @include('layouts.nav')

            <input class="nav-trigger" id="nav-trigger" type="checkbox" />
            <label class="nav-trigger__full" for="nav-trigger">
                <div class="nav-trigger__full-filler"></div>
            </label>
            <div class="site">
                <div class="side-menu hidden-md-up">
                    <div class="side-menu__guest">
                        <p class="side-menu__guest-title">TravelSpot</p>
                        @if(\Auth::check())
                            @if(\Auth::user()->role->slug == 'client')
                            <span class="side-menu__guest-text">Kamu login sebagai {{\Auth::user()->client->fullname}}</span>
                            @elseif(\Auth::user()->role->slug == 'photographer')
                            <span class="side-menu__guest-text">Kamu login sebagai {{\Auth::user()->photographer->fullname}}</span>
                            @endif


                            <a  class="side-menu__sign-up-link" 
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <div class="side-menu__sign-up-button">Log Out</div>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                        <span class="side-menu__guest-text">Daftar sekarang dan dapatkan info travel terkini</span>
                        <a class="side-menu__sign-up-link" href="/register">
                            <div class="side-menu__sign-up-button">Daftar</div>
                        </a>
                        <span class="side-menu__guest-text">Sudah punya akun? <a class="side-menu__guest-text-link" href="/login">Log In di sini</a></span>
                        @endif
                    </div>
                </div>
                
                @yield('content')
            </div>

            @include('layouts.footer')

            <script src="/js/application-f338a7c1ba270ed5f3a1304b1733d41ad7a375563b2d8abe3e41ade68828e8b2.js"></script><script>
                window.sweetescape = window.sweetescape || {}
                window.sweetescape.variables = window.sweetescape.variables || {}
                
            </script>
            <script>
                if (window['sweetescape']) {
                  if (window['sweetescape'].init) {
                    window['sweetescape'].init();
                  }
                
                if (window['sweetescape']['application']) {
                  if (window['sweetescape']['application'].init) {
                    window['sweetescape']['application'].init();
                  }
                
                if (window['sweetescape']['application']['home'] && window['sweetescape']['application']['home'].init) {
                  window['sweetescape']['application']['home'].init();
                }
                
                if (window['sweetescape']['application']['home'] && window['sweetescape']['application']['home'].index) {
                  window['sweetescape']['application']['home'].index();
                }
                }}
            </script>
            <!--Start of Zendesk Chat Script-->
            <script type="text/javascript">
                window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
                d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
                _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
                $.src="https://v2.zopim.com/?4pPs6OukzHO5crgyx70eSDgo4pDF9zQz";z.t=+new Date;$.
                type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
            </script>
            <!--End of Zendesk Chat Script-->
        </div>
        @section('scripts')
        @show
    </body>
</html>