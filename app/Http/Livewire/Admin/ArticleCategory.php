<?php

namespace App\Http\Livewire\Admin;

use App\Models\ArticleCategories;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ArticleCategory extends Component
{
    public $name, $screen='index',$image, $obj,$data;
use WithFileUploads ,WithPagination;
    public function beforeSubmit()
    {
        if (!$this->image) {
            return;
        }
        if ($this->obj) {
            if ($this->obj->image !== $this->image) {
                delete_file($this->obj->image);
                $this->data['image'] = store_file($this->image, 'articles');
            }
        } else {
            $this->data['image'] = store_file($this->image, 'articles');
        }
    }

    public function submit()
    {
        $this->data = $this->validate([
            'name' => 'required',
            'image' => 'nullable'
        ]);
        $this->beforeSubmit();

        if ($this->obj) {
            $this->obj->update($this->data);
        } else {
            $this->obj = ArticleCategories::create($this->data);
        }
        $this->obj = null;
        $this->reset();
        $this->screen = 'index';
        session()->flash('success', 'تم الحفظ بنجاح');

    }

    public function edit($id)
    {
        $this->obj =ArticleCategories::findOrFail($id);
        $this->name =$this->obj->name;
        $this->image =$this->obj->image;
        $this->screen ='edit';
}

    public function delete($id)
    {
        ArticleCategories::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');

    }
    public function render()
    {
        $categories = \App\Models\ArticleCategories::paginate(10);
        return view('livewire.admin.article-categories', compact('categories'));
    }
}
