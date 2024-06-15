<!DOCTYPE html>
<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixedlight-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">
<head>
@include('inc._styles')
</head>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('inc.menus.vertical-menu')
        <div class="layout-page">
            @include('inc._nav')

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        @yield('content')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<body>
</body>
@include('inc._scripts')
</html>
