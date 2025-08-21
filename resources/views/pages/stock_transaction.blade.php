@section('title', 'Show Item')

<div>
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">WareTrack - Details Item</h1>
    </div>
    <!-- card -->
    <div class="card shadow  -mt-12 mx-6">
        <!-- card body -->
        <div class="card-body">
            <!-- border -->
            <div class="mb-6">
                <h4 class="mb-1">Details Item information</h4>
            </div>
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="customer_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input type="text" disabled value="{{ $item->sku }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="customer_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item
                            Name</label>
                        <input type="text" disabled value="{{ $item->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="customer_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item
                            Category</label>
                        <input type="text" disabled value="{{ $item->category->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" value="{{ $item->description }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Warehouse</label>
                        <input type="text" value="{{ $item->stocks->warehouse->name }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Item</label>
                       <img src="/storage/{{$item->image_path}}" width="150" height="auto" alt="">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Stock</label>
                        <input type="text" value="{{ $item->stocks->quantity }}" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>

                </div>

                <div class="mb-6">
                    <h4 class="mb-1">Stock Transakction</h4>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <table class="text-left w-full whitespace-nowrap border border-gray-300" >
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">#</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Staff</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Qty</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Type</th>
                                <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Note</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @foreach ($stock_transaction as $item)
                                <tr class="border-gray-300 border-b ">
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $loop->iteration }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $item->user->name }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $item->qty }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $item->type }}
                                    </td>
                                    <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $item->note }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('item') }}"
                    class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Back
                </a>
            </form>
        </div>
    </div>
</div>
