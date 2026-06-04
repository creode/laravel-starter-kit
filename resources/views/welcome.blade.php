<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @endif
</head>
<body class="welcome">
    <header class="welcome__header">
        @if (Route::has('login'))
            <nav class="welcome__nav" aria-label="{{ __('Primary') }}">
                @auth
                    <a href="{{ url('/dashboard') }}" class="welcome__nav-link">
                        {{ __('Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="welcome__nav-link welcome__nav-link--primary">
                        {{ __('Log in') }}
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="welcome__nav-link">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="welcome__main">
        <section class="welcome__panel">
            <h1 class="welcome__title">{{ __("Let's get started") }}</h1>
            <p class="welcome__intro">
                {{ __('With so many options available to you, we suggest you start with the following:') }}
            </p>
            <ul class="welcome__steps">
                <li class="welcome__step">
                    <span>
                        {{ __('Read the') }}
                        <a
                            href="https://laravel.com/docs"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="welcome__step-link"
                        >
                            <span>{{ __('Documentation') }}</span>
                        </a>
                    </span>
                </li>
                <li class="welcome__step">
                    <span>
                        {{ __('Watch video tutorials at') }}
                        <a
                            href="https://laracasts.com"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="welcome__step-link"
                        >
                            <span>Laracasts</span>
                        </a>
                    </span>
                </li>
            </ul>
            <div class="welcome__actions">
                <a
                    href="https://cloud.laravel.com"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="welcome__button welcome__button--primary"
                >
                    {{ __('Deploy now') }}
                </a>
            </div>
        </section>

        <div class="welcome__visual" aria-hidden="true">
            <svg class="welcome__logo" viewBox="0 0 438 104" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M78.6643 167.6H103.864V400.2H171.664V105.2H78.6643V167.6Z" fill="#F53003"/>
                <path d="M311.929 400.8C341.929 400.8 366.329 392.8 385.129 376.8C403.929 360.8 413.329 340.4 413.329 315.6C413.329 298 408.129 283.4 397.729 271.8C387.729 260.2 374.129 252 356.929 247.2C371.329 243.2 383.129 236 392.329 225.6C401.529 214.8 406.129 200.8 406.129 183.6C406.129 160 397.329 141 379.729 126.6C362.529 112.2 340.129 105 312.529 105C284.929 105 262.329 113 244.729 129C227.129 144.6 218.329 164.8 218.329 189.6H284.929C284.929 182.8 287.329 177.2 292.129 172.8C297.329 168.4 303.529 166.2 310.729 166.2C318.729 166.2 325.329 168.6 330.529 173.4C335.729 178.2 338.329 184.8 338.329 193.2C338.329 200.4 335.929 206.4 331.129 211.2C326.329 216 320.529 218.4 313.729 218.4H276.529V280.2H313.729C322.529 280.2 329.729 282.8 335.329 288C340.929 293.2 343.729 299.8 343.729 307.8C343.729 316.6 340.529 323.8 334.129 329.4C328.129 335 320.329 337.8 310.729 337.8C300.729 337.8 292.729 335.2 286.729 330C280.729 324.8 277.729 318.2 277.729 310.2H207.529C207.529 337 217.129 358.8 236.329 375.6C255.929 392.4 281.129 400.8 311.929 400.8Z" fill="#F53003"/>
            </svg>
        </div>
    </div>
</body>
</html>
