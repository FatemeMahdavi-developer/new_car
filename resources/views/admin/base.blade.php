<!DOCTYPE html>
<html lang="en">
<head>
    @include("admin.layout.head")
    <title> پنل مدیریت |@yield("title")</title>
    @livewireStyles

    @yield("head")
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include("admin.layout.navbar")
        @include("admin.layout.sidebar")
        <div class="main-content">
            @yield("content")
        </div>
    </div>
</div>

@include("admin.layout.footer")
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@yield("footer")

</body>
</html>
