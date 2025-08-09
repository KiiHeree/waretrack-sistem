<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriLivewire extends Component
{
    public $categories, $mode = "create", $showModal = false;
    public $name, $description,$category_id;

    public function mount()
    {
        $this->getCategori();
    }

    public function getCategori()
    {
        $this->categories = Category::all();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
    }

    public function openModal($mode, $id = null)
    {
        $this->showModal = true;
        if ($mode == 'create') {
            $this->resetForm();
        } elseif ($mode == 'edit' || $mode == 'show' && $id) {
            $cat = Category::findOrFail($id);
            $this->name = $cat->name;
            $this->description = $cat->description;
            $this->category_id = $cat->id;
        } else {
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function store() {
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $store = Category::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        if($store) {
            session()->flash('success','Berhasil menambah data category');
            $this->closeModal();
            $this->getCategori();
        }else{
            session()->flash('error','Gagal menambah data category');
        }

    }

    public function update() {
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $update = Category::findOrFail($this->category_id);
        $update->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        if($update) {
            session()->flash('success','Berhasil mengubah data category');
            $this->closeModal();
            $this->getCategori();
        }else{
            session()->flash('error','Gagal mengubah data category');
        }

    }

    public function delete($id) {
        $delete = Category::findOrFail($id);
        $delete->delete();

         if($delete) {
            session()->flash('success','Berhasil menghapus data category');
            $this->closeModal();
            $this->getCategori();
        }else{
            session()->flash('error','Gagal menghapus data category');
        }
    }

    public function render()
    {
        return view('pages.categori')->layout('components.app');
    }
}
