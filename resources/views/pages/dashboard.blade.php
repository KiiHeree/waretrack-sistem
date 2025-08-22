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
                    <h2 class="text-xl font-bold">{{ $warehouse }}</h2>
                    <div>
                        <span class="text-gray-500">Place</span>
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
                    <h4>Delivery Order</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="list"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">{{ $order }}</h2>
                    <div>
                        <span>{{ $order_complete }}</span>
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
                    <h4>Drivers</h4>
                    <div
                        class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                        <i data-feather="users"></i>
                    </div>
                </div>
                <div class="mt-4 flex flex-col gap-0 text-base">
                    <h2 class="text-xl font-bold">{{ $driver }}</h2>
                    <div>
                        <span>{{ $driver_active }}</span>
                        <span class="text-gray-500">Active</span>
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
                    <h2 class="text-xl font-bold">{{ $item }}</h2>
                    <div>
                        <span class="text-gray-500">Item</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mt-4 mx-6">
        <div class="card-body">
            <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center mb-4">
                <h4>New Orders</h4>
            </div>

            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap border border-gray-300"">
                    <thead class="bg-gray-200 text-gray-700 ">
                        <tr class="border-gray-300 border-b ">
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">#</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Order Number</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Destination Address</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Driver</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Total Items</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Status</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y ">
                        @foreach ($new_order['data'] as $data)
                            <tr>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $data['order_number'] }}
                                </td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    {{ $data['destination_address'] }}</td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    {{ $data['driver->name'] ?? 'Belum di Assign' }}</td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $data['total_items'] }}
                                </td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $data['status'] }}</td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    <a href="{{ route('order-show', $data['id']) }}"
                                        class="btn gap-x-z bg-blue-600 border-blue-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-blue-800 hover:border-blue-800 active:bg-blue-800 active:border-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                        <i data-lucide="eye" class="w-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
