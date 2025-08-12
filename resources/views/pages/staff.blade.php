@section('title', 'Staff')

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
        <h1 class="text-xl text-white">WareTrack - Staffs</h1>
    </div>
    <div class="card shadow -mt-12 mx-6">
        <div class="card-body">
            <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center mb-4">
                <h4>Data Staffs</h4>
            </div>
            <button type="button" wire:click="openModal('create')"
                class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                Create
            </button>
            <div class="relative overflow-x-auto">
                <table class="text-left whitespace-nowrap border border-gray-300" id="table">
                    <thead class="bg-gray-200 text-gray-700 ">
                        <tr class="border-gray-300 border-b ">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y ">
                        @foreach ($staffs as $data)
                            <tr>
                                <td class="text-left">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $data->name }}</td>
                                <td class="text-left">{{ $data->email }}</td>
                                <td class="text-left">{{ $data->phone }}</td>
                                <td class="text-left">{{ $data->role }}</td>
                                <td class="text-left">
                                    <button type="button" wire:click="openModal('edit',{{ $data->id }})"
                                        class="btn gap-x-z bg-yellow-600 border-yellow-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-800 hover:border-yellow-800 active:bg-yellow-800 active:border-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                                        <i data-lucide="pencil" class="w-4"></i>
                                    </button>
                                    @if ($data->role == 'driver')
                                        <button type="button" wire:click="openModal('show',{{ $data->id }})"
                                            class="btn gap-x-z bg-blue-600 border-blue-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-blue-800 hover:border-blue-800 active:bg-blue-800 active:border-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                            <i data-lucide="eye" class="w-4"></i>
                                        </button>
                                    @endif
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
                            {{ $mode }} Staff
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
                        <div class="grid gap-4 mb-4">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" wire:model="name" id="name"
                                    {{ $mode == 'show' ? 'disabled' : '' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" wire:model="email" id="email"
                                    {{ $mode == 'show' ? 'disabled' : '' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" wire:model="password" id="password"
                                    {{ $mode == 'show' ? 'disabled' : '' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                <input type="number" wire:model="phone" id="phone"
                                    {{ $mode == 'show' ? 'disabled' : '' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select wire:model="role" id="roleSelect" {{$mode == 'show' ? 'disabled' : ''}}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="staff">Staff</option>
                                    <option value="driver">Driver</option>
                                </select>
                            </div>
                        </div>
                        <div id="driverWrapper" style="display: none" class="flex mb-4">
                            <div class="col-span-2">
                                <label for="licence_no"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Licence
                                    No</label>
                                <input type="number" wire:model="licence_no" id="licence_no"
                                    {{ $mode == 'show' ? 'disabled' : '' }}
                                    class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                            <div class="col-span-2">
                                <label for="vehicle_info"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle
                                    Info</label>
                                <input type="text" wire:model="vehicle_info" id="vehicle_info"
                                    {{ $mode == 'show' ? 'disabled' : '' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="...">
                            </div>
                        </div>
                        @if ($mode != 'show')
                            <button type="submit" {{ $mode == 'show' ? 'disabled' : '' }}
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

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('driverShow', () => {
                setTimeout(() => {
                    const roleSelect = document.getElementById('roleSelect');
                    const driverWrapper = document.getElementById('driverWrapper');

                    // langsung deteksi awal kalau defaultnya proses
                    if (roleSelect.value === 'driver') {
                        driverWrapper.style.display = 'block';
                    } else {
                        driverWrapper.style.display = 'none';
                    }

                    // on change handler
                    roleSelect.addEventListener('change', function() {
                        if (this.value === 'driver') {
                            driverWrapper.style.display = 'block';
                        } else {
                            driverWrapper.style.display = 'none';
                        }
                    });
                });
            }, 100);
        })
    </script>
@endpush
