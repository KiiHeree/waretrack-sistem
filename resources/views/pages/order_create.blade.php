@section('title', 'Create Order')

<div>
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">WareTrack - Create Orders</h1>
    </div>
    <!-- card -->
    <div class="card shadow  -mt-12 mx-6">
        <!-- card body -->
        <div class="card-body">
            <!-- border -->
            <div class="mb-6">
                <h4 class="mb-1">Order information</h4>
            </div>
            <form class="p-4 md:p-5" wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="customer_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                            Name</label>
                        <input type="text" wire:model="customer_name" id="customer_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="customer_phone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                            Number</label>
                        <input type="number" wire:model="customer_phone" id="customer_phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for="destination_address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination
                            Address</label>
                        <input type="text" wire:model="destination_address" id="destination_address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="...">
                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Warehouse</label>
                        <select wire:model="warehouse_id" id=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Pilih Warehouse</option>
                            @foreach ($warehouses as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($itemsForm as $index => $itemsField)
                        <div class="item-card" wire:key="item-{{ $index }}">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Item</label>
                                <select wire:model="itemsForm.{{ $index }}.item_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">Chosee Item</option>
                                    @foreach ($items as $data)
                                        <option value="{{ $data->item_id }}">
                                            {{ $data->item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Item Quantity</label>
                                <input type="number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    wire:model="itemsForm.{{ $index }}.qty">
                            </div>
                            <button type="button"
                                class="btn gap-x-z bg-red-600 border-red-600 text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-red-800 hover:border-red-800 active:bg-red-800 active:border-red-800 focus:outline-none focus:ring-4 focus:ring-red-300"
                                wire:click="removeItemField({{ $index }})">-</button>
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center">
                    <button type="button" wire:click="addItemField"
                        class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">+</button>
                </div>

                <button type="submit"
                    class="btn gap-x-2 mb-5 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Submit
                </button>

            </form>
        </div>
    </div>
</div>
