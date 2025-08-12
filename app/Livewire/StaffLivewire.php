<?php

namespace App\Livewire;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class StaffLivewire extends Component
{
    public $staffs, $mode = "create", $showModal = false;
    public $name, $email, $password, $role, $phone, $staff_id, $licence_no, $vehicle_info;

    public function mount()
    {
        $this->getStaff();
    }

    public function getStaff()
    {
        $this->staffs = User::all();
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

            // if($st->role == 'driver') {
            //     $d = Driver::findOrFail($id);
            //     $this->licence_no = $d->licence_no;
            //     $this->vehicle_info = $d->vehicle_info;
            // }
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
                    'licence_no' => $this->licence_no,
                    'vehicle_info' => $this->vehicle_info,
                    'phone' => $store->phone,
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
                $update_driver = Driver::findOrFail($this->staff_id);
                $update_driver->update([
                    'licence_no' => $this->licence_no,
                    'vehicle_info' => $this->vehicle_info,
                    'phone' => $update->phone,
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
