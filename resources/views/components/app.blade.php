<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description"
        content="Dash UI - TailwindCSS HTML Admin Template Free and open-source Github, provides developers with everything need to create Web Application & Kick start project" />
    <link rel="shortcut icon" type="image/x-icon" href="/dist/assets/images/favicon/favicon.ico" />

    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="/dist/assets/libs/simplebar/dist/simplebar.min.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/dist/assets/css/theme.min.css">

    <link rel="stylesheet" href="/dist/assets/libs/apexcharts/dist/apexcharts.css" />

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    <title>WareTrack - @yield('title')</title>
</head>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <!-- start navbar -->
            @include('components.sidebar')
            <!--end of navbar-->

            <!-- app layout content -->
            <div id="app-layout-content"
                class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <!-- start navbar -->
                @include('components.header')
                <!-- end of navbar -->

                {{ $slot }}

                @include('components.footer')

            </div>
        </div>
        <!-- end of project -->
    </main>

    <!-- jQuery (wajib) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script src="/dist/assets/libs/apexcharts/dist/apexcharts.min.js"></script>

    <!-- Libs JS -->
    <script src="/dist/assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="/dist/assets/js/theme.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>


    <!-- DataTables core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            lucide.createIcons();
            $('#table').DataTable();

            
                
            Livewire.on('reinitComponents', () => {
                // inisialisasi ulang setelah update DOM
                setTimeout(() => {
                    lucide.createIcons();
                }, 100);
            });

            Livewire.on('reinitDataTable', () => {
                // destroy datatable kalo udah di-init sebelumnya
                // if ($.fn.DataTable.isDataTable('#table')) {
                //     $('#table').DataTable().destroy();
                // }

                // inisialisasi ulang setelah update DOM
                setTimeout(() => {
                    $('#table').DataTable();
                }, 100);
            });
        });
    </script>

    @stack('js')

</body>

</html>
