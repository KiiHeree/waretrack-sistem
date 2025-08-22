@section('title', 'Show Warehouse')

<div>
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">WareTrack - Details Warehouse</h1>
    </div>
    <!-- card -->
    <div class="card shadow  -mt-12 mx-6">
        <!-- card body -->
        <div class="card-body">
            <!-- border -->
            <div class="mb-6">
                <h4 class="mb-1">Details Warehouse information</h4>
            </div>
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" disabled value="{{ $warehouse->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>

                    <div class="col-span-2">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" disabled value="{{ $warehouse->address }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>



                    <div class="col-span-2">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" disabled value="{{ $warehouse->address }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>


                    <div class="col-span-2">
                        <label for="city"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <input type="text" disabled value="{{ $warehouse->city }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>



                    <div class="col-span-2">
                        <label for="phone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input type="text" disabled value="{{ $warehouse->phone }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>

                </div>

                <div class="mb-6">
                    <h4 class="mb-1">Items</h4>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <table class="text-left w-full whitespace-nowrap border border-gray-300">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">#</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">SKU</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Name</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Category</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Image</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Stock</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @foreach ($items as $data)
                                <tr class="border-gray-300 border-b ">
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $loop->iteration }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                        {{ $data->item->sku }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                        {{ $data->item->name }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                        {{ $data->item->category->name }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                        <img src="/storage/{{ $data->item->image_path }}" width="50" height="auto"
                                            alt="">
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                        {{ $data->quantity }} {{ $data->item->unit }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                        <a href="{{ route('stock-transaction', $data->item->id) }}"
                                            class="btn gap-x-z bg-blue-600 border-blue-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-blue-800 hover:border-blue-800 active:bg-blue-800 active:border-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                            <i data-lucide="eye" class="w-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('warehouse') }}"
                    class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Back
                </a>
            </form>
        </div>
    </div>
</div>
