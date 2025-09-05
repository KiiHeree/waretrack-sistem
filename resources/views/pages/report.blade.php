@section('title', 'Report')

<div>
    @if (Session::has('success'))
        <div aria-live="assertive" aria-atomic="true"
            class="toast fade show border border-green-300 flex flex-col absolute top-5 right-5 w-full max-w-xs text-green-500 bg-white rounded-lg "
            role="alert">
            <div class="flex items-center w-full border-b border-green-300 p-3">
                <h4 class="text-green-500">Success</h4>
                <button type="button"
                    class="btn-close ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 "
                    data-bs-dismiss="toast" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div class="p-3">
                <p>{{ Session::get('success') }}</p>
            </div>
        </div>
    @endif
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">WareTrack - Report</h1>
    </div>
    <div class="card shadow -mt-12 mx-6">
        <div class="card-body">
            <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center mb-4">
                <h4>Report</h4>
            </div>
            <form wire:submit.prevent="getReport">
                <div class="flex flex-row gap-4 mb-4 items-end">
                    <div class="w-full">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Start Date
                        </label>
                        <input type="date" wire:model="start_date" id="start_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 w-full text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="w-full">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            End Date
                        </label>
                        <input type="date" wire:model="end_date" id="end_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 w-full text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Export
                        </label>
                        <button wire:click="export" @if ($btn_export) @else disabled @endif
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-800">
                            Download Report
                        </button>
                    </div>

                </div>
                <button type="submit"
                    class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Submit
                </button>
            </form>

            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap border border-gray-300"">
                    <thead class="bg-gray-200 text-gray-700 ">
                        <tr class="border-gray-300 border-b ">
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">#</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Order Number</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Destination Address
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Driver</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Total Items</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Status</th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 ">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y ">
                        @foreach ($reports as $data)
                            <tr>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $loop->iteration }}
                                </td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    {{ $data->order_number }}
                                </td>
                                <td class="py-3 px-6 text-left border-r border-gray-300">
                                    {{ $data->destination_address }}</td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    {{ $data->driver->name ?? 'Belum di Assign' }}</td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    {{ $data->total_items }}
                                </td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">{{ $data->status }}
                                </td>
                                <td class="py-3 px-6 text-left border-r border-gray-300 ">
                                    <a href="{{ route('order-show', $data->id) }}"
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
