@section('title', 'Dashboard')
<div>
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">Dashboard WereTrack</h1>
    </div>
    <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 xl:grid-cols-4">
        <!-- card -->
        <div class="card shadow">
            <!-- card body -->
            <div class="card-body">
                <!-- content -->
                <div class="flex justify-between items-center">
                    <h4>Warehouse</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="briefcase"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">18</h2>
                    <div>
                        <span>2</span>
                        <span class="text-gray-500">Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
        <div class="card shadow">
            <!-- card boduy -->
            <div class="card-body">
                <!-- content -->
                <div class="flex justify-between items-center">
                    <h4>Active Delivery</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="list"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">132</h2>
                    <div>
                        <span>28</span>
                        <span class="text-gray-500">Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
        <div class="card shadow">
            <!-- card body -->
            <div class="card-body">
                <!-- content -->
                <div class="flex justify-between items-center">
                    <h4>Driver Active</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="users"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">12</h2>
                    <div>
                        <span>1</span>
                        <span class="text-gray-500">Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
        <div class="card shadow">
            <!-- card body -->
            <div class="card-body">
                <!-- content -->
                <div class="flex justify-between items-center">
                    <h4>Items</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="target"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">76%</h2>
                    <div>
                        <span class="text-green-600">5%</span>
                        <span class="text-gray-500">Completed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
