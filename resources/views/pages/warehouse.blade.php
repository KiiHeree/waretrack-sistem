@section('title', 'Warehouse')
<div>
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">WareTrack - Warehouse</h1>
    </div>
    <div class="card shadow -mt-12 mx-6">
        <div class="card-body">
            <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center mb-4">
                <h4>Data Warehouse</h4>
            </div>
            <button type="button" wire:click="openModal('create')"
                class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                Create
            </button>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap">
                    <thead class="bg-gray-200 text-gray-700 ">
                        <tr class="border-gray-300 border-b ">
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Address</th>
                            <th scope="col" class="px-6 py-3">City</th>
                            <th scope="col" class="px-6 py-3">Phone</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y ">
                        @foreach ($warehouses as $data)
                            <tr class="border-gray-300 border-b ">
                                <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6 text-left">{{ $data->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $data->address }}</td>
                                <td class="py-3 px-6 text-left">{{ $data->city }}</td>
                                <td class="py-3 px-6 text-left">{{ $data->phone }}</td>
                                <td class="py-3 px-6 text-left">
                                    <button type="button" wire:click="openModal('edit',{{ $data->id }})"
                                        class="btn gap-x-z bg-yellow-600 border-yellow-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-800 hover:border-yellow-800 active:bg-yellow-800 active:border-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                                        <i data-lucide="pencil" class="w-4"></i>
                                    </button>
                                    <button type="button" wire:click="openModal('show',{{ $data->id }})"
                                        class="btn gap-x-z bg-blue-600 border-blue-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-blue-800 hover:border-blue-800 active:bg-blue-800 active:border-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                        <i data-lucide="eye" class="w-4"></i>
                                    </button>
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
    @if ($showModal)
        <div id="crud-modal" tabindex="-1"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex"
            aria-modal="true" role="dialog">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $mode }} Warehouse
                        </h3>
                        <button type="button" wire:click="closeModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" wire:submit.prevent="{{ $mode == 'create' ? 'store' : 'update' }}">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" wire:model="name" id="name" {{ $mode == 'show' ? 'disabled' : ''}}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                <input type="text" wire:model="address" id="address" {{ $mode == 'show' ? 'disabled' : ''}}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="city"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                <input type="text" wire:model="city" id="city" {{ $mode == 'show' ? 'disabled' : ''}}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                <input type="text" wire:model="phone" id="phone" {{ $mode == 'show' ? 'disabled' : ''}}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                        </div>
                        @if ($mode != 'show')
                            <button type="submit" {{ $mode == 'show' ? 'disabled' : ''}}
                                class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                {{ $mode == 'create' ? 'Submit' : 'Update' }}
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
