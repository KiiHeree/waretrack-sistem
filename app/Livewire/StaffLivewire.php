<?php

namespace App\Livewire;

use App\Models\Driver;
use App\Models\Staff;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use PhpParser\Node\Stmt\If_;

class StaffLivewire extends Component
{
    public $staffs, $warehouses, $mode = "create", $showModal = false;
    public $name, $email, $password, $role, $phone, $staff_id, $license_no, $vehicle_info, $warehouse_id;

    public function mount()
    {
        $this->getStaff();
    }

    public function getStaff()
    {
        $this->staffs = User::all();
        $this->warehouses = Warehouse::all();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->role = '';
    }

    public function openModal($mode, $id = null)
    {
        $this->showModal = true;
        $this->mode = $mode;
        if ($mode == 'create') {
            $this->resetForm();
            $this->dispatch('driverShow');
        } elseif ($mode == 'edit' || $mode == 'show' && $id) {
            $st = User::findOrFail($id);
            $this->dispatch('driverShow');
            $this->name = $st->name;
            $this->email = $st->email;
            $this->phone = $st->phone;
            $this->role = $st->role;
            $this->staff_id = $st->id;
            $this->vehicle_info = $st->driver->vehicle_info ?? null;
            $this->license_no = $st->driver->license_no ?? null;
            $this->warehouse_id = $st->staff->warehouse_id ?? null;
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
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $password = Hash::make($this->password);

        $store = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
            'phone' => $this->phone,
            'role' => $this->role,
        ]);


        if ($store) {
            if ($store->role == 'driver') {
                $store_driver  = Driver::create([
                    'user_id' => $store->id,
                    'license_no' => $this->license_no,
                    'vehicle_info' => $this->vehicle_info,
                    'phone' => $store->phone,
                ]);
            } elseif ($store->role == 'staff') {
                $store_staff = Staff::create([
                    'user_id' => $store->id,
                    'warehouse_id' => $this->warehouse_id
                ]);
            }
            session()->flash('success', 'Berhasil menambah data staff');
            $this->closeModal();
            $this->getStaff();
        } else {
            session()->flash('error', 'Gagal menambah data staff');
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $update = User::findOrFail($this->staff_id);
        $password = $update->password;
        if ($this->password != null) {
            $password = Hash::make($this->password);
        }
        $update->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
            'phone' => $this->phone,
            'role' => $this->role,
        ]);

        if ($update) {
            if ($update->role == 'driver') {
                $update_driver = Driver::where('user_id', $this->staff_id)->first();
                $update_driver->update([
                    'license_no' => $this->license_no,
                    'vehicle_info' => $this->vehicle_info,
                    'phone' => $update->phone,
                ]);
            } elseif ($update->role == 'staff') {
                $update_staff = Staff::where('user_id', $this->staff_id)->first();
                
                // dd($this->staff_id);
                $update_staff->update([
                    'warehouse_id' => $this->warehouse_id
                ]);
            }
            session()->flash('success', 'Berhasil mengubah data staff');
            $this->closeModal();
            $this->getStaff();
        } else {
            session()->flash('error', 'Gagal mengubah data staff');
        }
    }

    public function delete($id)
    {
        $delete = User::findOrFail($id);
        if ($delete->role == 'driver') {
            $delete_driver = Driver::findOrFail($id)->delete();
        } elseif ($delete->role == 'staff') {
            $delete_staff = Staff::findOrFail($id)->delete();
        }
        $delete->delete();

        if ($delete) {
            session()->flash('success', 'Berhasil menghapus data staff');
            $this->dispatch('reinitComponents');
            $this->dispatch('reinitDataTable');
            $this->getStaff();
        } else {
            session()->flash('error', 'Gagal menghapus data staff');
        }
    }

    public function render()
    {
        return view('pages.staff')->layout('components.app');
    }
}
