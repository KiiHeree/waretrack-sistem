@section('title', 'Orders')

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
        <h1 class="text-xl text-white">WareTrack - Orders</h1>
    </div>
    <div class="card shadow -mt-12 mx-6">
        <div class="card-body">
            <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center mb-4">
                <h4>Data Orders</h4>
            </div>
            <a href="{{ route('order-create') }}"
                class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                Create
            </a>
            <div class="relative overflow-x-auto">
                <table class="text-left whitespace-nowrap border border-gray-300" id="table">
                    <thead class="bg-gray-200 text-gray-700 ">
                        <tr class="border-gray-300 border-b ">
                            <th scope="col">#</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Destination Address</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Total Items</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y ">
                        @foreach ($orders as $data)
                            <tr>
                                <td class="text-left">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $data->order_number }}</td>
                                <td class="text-left">{{ $data->destination_address }}</td>
                                <td class="text-left">{{ $data->driver->name ?? 'Belum di Assign' }}</td>
                                <td class="text-left">{{ $data->total_items }}</td>
                                <td class="text-left">{{ $data->status }}</td>
                                <td class="text-left">
                                    <button type="button" wire:click="openModal({{ $data->id }})"
                                        class="btn gap-x-z bg-yellow-600 border-yellow-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-800 hover:border-yellow-800 active:bg-yellow-800 active:border-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                                        <i data-lucide="pencil" class="w-4"></i>
                                    </button>
                                    <a href="{{ route('order-show', $data->id) }}"
                                        class="btn gap-x-z bg-blue-600 border-blue-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-blue-800 hover:border-blue-800 active:bg-blue-800 active:border-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                        <i data-lucide="eye" class="w-4"></i>
                                    </a>
                                    <button type="button" wire:click="delete({{ $data->id }})"
                                        class="btn gap-x-z bg-red-600 border-red-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-red-800 hover:border-red-800 active:bg-red-800 active:border-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">
                                        <i data-lucide="trash-2" class="w-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- component Modal-->

    <div id="crud-modal" tabindex="-1"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full {{ $showModal ? 'flex' : 'hidden' }}"
        aria-modal="true" role="dialog">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Update Status Orders
                    </h3>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" wire:submit.prevent="updateStatus" enctype="multipart/form-data">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for=""
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select wire:model="status" id="status_selected"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Status</option>
                                <option value="assigned">Assigned</option>
                                <option value="picked_up">Picked Up</option>
                                <option value="in_transit">In Transit</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-span-2" id="driver_wrapper" style="display: none">
                            <label for=""
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Driver</label>
                            <select wire:model="driver_id" id=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Driver</option>
                                @foreach ($drivers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                        Submit
                    </button>

                </form>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        const status_selected = document.getElementById('status_selected');
        const driver_wrapper = document.getElementById('driver_wrapper');


        // on change handler
        status_selected.addEventListener('change', function() {
            if (this.value === 'assigned') {
                driver_wrapper.style.display = 'block';
            } else {
                driver_wrapper.style.display = 'none';
            }
        });
    </script>
@endpush
