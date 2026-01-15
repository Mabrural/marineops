<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main-panel">
            @include('layouts.navbar')

            @yield('container')

            @include('layouts.footer')
        </div>

        @include('layouts.custom-template')
    </div>
    @include('layouts.script')
</body>

</html>
