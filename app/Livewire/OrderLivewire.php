<?php

namespace App\Livewire;

use App\Models\DeliveryOrder;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderLivewire extends Component
{
    public $orders, $showModal = false, $drivers;
    public $status, $driver_id, $order_id;

    public function mount()
    {
        $this->getOrder();
    }

    public function getOrder()
    {
        $this->orders = DeliveryOrder::all();
        $this->drivers = User::where('role', 'driver')->get();
    }

    public function openModal($id)
    {
        $this->showModal = true;
        $orders = DeliveryOrder::findOrFail($id);
        $this->status = $orders->status;
        $this->order_id = $id;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->status = '';
        $this->getOrder();
        $this->dispatch('reinitComponents');
        $this->dispatch('reinitDataTable');
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required',
        ]);

        $update_status = DeliveryOrder::findOrFail($this->order_id);
        if ($this->status != 'assigned') {
            $update_status->update([
                'status' => $this->status
            ]);
        } elseif ($this->status == 'assigned') {
            $update_status->update([
                'status' => $this->status,
                'assigned_driver_id' => $this->driver_id,
                'approved_by' => Auth::user()->id
            ]);
        }

        if ($update_status) {
            session()->flash('success', 'Berhasil mengubah status menjadi ' . $this->status);
            $this->closeModal();
        } else {
            session()->flash('error', 'Gagal mengubah status menjadi ' . $this->status);
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        $delete = DeliveryOrder::findOrFail($id);
        $delete->delete();

        if ($delete) {
            session()->flash('success', 'Berhasil menghapus data order');
            $this->closeModal();
        } else {
            session()->flash('error', 'Gagal menghapus data order');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('pages.order')->layout('components.app');
    }
}
