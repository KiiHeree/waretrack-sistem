<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="/dist/assets/images/favicon/favicon.ico" />

    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="/dist/assets/libs/simplebar/dist/simplebar.min.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/dist/assets/css/theme.min.css">

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Sign In - TailwindCSS HTML Admin Template Free - Dash UI" />
    <title>Login - WareTrack</title>
</head>

<body>
    <!-- start signin page -->
    <div class="flex flex-col items-center justify-center g-0 h-screen px-4">
        <!-- card -->
        <div class="justify-center items-center w-full bg-white rounded-md shadow lg:flex md:mt-0 max-w-md xl:p-0">
            <!-- card body -->
            <div class="p-6 w-full sm:p-8 lg:p-8">
                <div class="mb-4">
                    <a href="index.html"><img src="/dist/assets/images/brand/logo/logo-primary.svg" class="mb-1"
                            alt="WareTrack" /></a>
                    <p class="mb-6">Please enter your user information.</p>
                </div>
                <!-- form -->
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                    <!-- username -->
                    <div class="mb-3">
                        <label for="email" class="inline-block mb-2">Email</label>
                        <input type="email" id="email"
                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                            name="email" placeholder="Email address here" required="" />
                    </div>
                    <!-- password -->
                    <div class="mb-5">
                        <label for="password" class="inline-block mb-2">Password</label>
                        <input type="password" id="password"
                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                            name="password" placeholder="**************" required="" />
                    </div>
                    <!-- checkbox -->
                    <div>
                        <!-- button -->
                        <div class="grid">
                            <button type="submit"
                                class="btn bg-indigo-600 text-white border-indigo-600 hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                Sign in
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of signin page -->

    <!-- Libs JS -->
    <script src="/dist/assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="/dist/assets/js/theme.min.js"></script>

</body>

</html>
