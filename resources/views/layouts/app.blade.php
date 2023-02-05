<!DOCTYPE html>
<html lang="en">

<head>
    <title>Departemen - @yield('judul')</title>
    {{-- @include('name') --}}
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!--sidebar-->
        {{-- @include('layout.sidebar') --}}
        <!--end of sidebar-->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.topbar')
                <!-- End of Topbar -->

                <div class="container-fluid">
                    {{-- @yield('content') --}}
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->

    </div>
</body>

</html>
