@section('title', 'Show Order')

<div>
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">WareTrack - Details Orders</h1>
    </div>
    <!-- card -->
    <div class="card shadow  -mt-12 mx-6">
        <!-- card body -->
        <div class="card-body">
            <!-- border -->
            <div class="mb-6">
                <h4 class="mb-1">Order information</h4>
            </div>
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="customer_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                            Name</label>
                        <input type="text" disabled value="{{ $orders->customer_name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="customer_phone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                            Number</label>
                        <input type="number" disabled value="{{ $orders->customer_phone }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination
                            Address</label>
                        <input type="text" value="{{ $orders->destination_address }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <input type="text" value="{{ $orders->status }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Driver</label>
                        <input type="text" value="{{ $orders->driver->name ?? 'Null' }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created By</label>
                        <input type="text" value="{{ $orders->creator->name ?? 'Null' }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approved By</label>
                        <input type="text" value="{{ $orders->approver->name ?? 'Null' }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Items</label>
                        <input type="text" value="{{ $orders->total_items }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Warehouse</label>
                        <input type="text" value="{{ $orders->warehouse->name }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="mb-1">Order Items information</h4>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <table class="text-left w-full whitespace-nowrap border border-gray-300">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">#</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Item Name</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Qty</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @foreach ($items as $item)
                                <tr class="border-gray-300 border-b ">
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $loop->iteration }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $item->item->name }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $item->qty }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ url()->previous() }}"
                    class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Back
                </a>
            </form>
        </div>
    </div>
</div>
