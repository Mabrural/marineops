<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    <div class="app-shell">
        @include('layouts.sidebar')

        <div class="app-main">
            @include('layouts.navbar')

            <main class="app-content" id="main-content">
                @yield('container')
            </main>

            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.script')
    @stack('scripts')
</body>
</html>
