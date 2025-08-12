<?php

namespace App\Livewire;

use App\Models\Warehouse;
use Livewire\Component;

class WarehouseLivewire extends Component
{
    public $warehouses, $mode = "create", $showModal = false;
    public $name, $address, $city, $phone, $warehouse_id;

    public function mount()
    {
        $this->getWarehouse();
    }

    public function getWarehouse()
    {
        $this->warehouses = Warehouse::all();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->city = '';
        $this->phone = '';
    }

    public function openModal($mode, $id = null)
    {
        $this->mode = $mode;
        $this->showModal = true;
        if ($mode == 'create') {
            $this->resetForm();
        } elseif ($mode == 'edit' || $mode == 'show' && $id) {
            $war = Warehouse::findOrFail($id);
            $this->name = $war->name;
            $this->address = $war->address;
            $this->city = $war->city;
            $this->phone = $war->phone;
            $this->warehouse_id = $war->id;
        } else {
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('reinitComponents');
        $this->dispatch('reinitDataTable');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $store = Warehouse::create([
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'phone' => $this->phone,
        ]);

        if ($store) {
            session()->flash('success', 'Berhasil menambah data warehouse');
            $this->closeModal();
            $this->getWarehouse();
        } else {
            session()->flash('error', 'Gagal menambah data warehouse');
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $update = Warehouse::findOrFail($this->warehouse_id);
        $update->update([
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'phone' => $this->phone,
        ]);

        if ($update) {
            $this->closeModal();
            $this->getWarehouse();
            session()->flash('success', 'Berhasil mengubah data warehouse');
        } else {
            session()->flash('error', 'Gagal mengubah data warehouse');
        }
    }

    public function delete($id)
    {
        $delete = Warehouse::findOrFail($id);
        $delete->delete();

        if ($delete) {
            session()->flash('success', 'Berhasil menghapus data warehouse');
            $this->closeModal();
            $this->dispatch('reinitComponents');
            $this->getWarehouse();
        } else {
            session()->flash('error', 'Gagal menghapus data warehouse');
        }
    }
    public function render()
    {
        return view('pages.warehouse')->layout('components.app');
    }
}
