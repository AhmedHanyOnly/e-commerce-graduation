<?php

namespace App\Http\Livewire\Admin;

use App\Models\Menu;
use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\livewireResource;

class Menus extends Component
{
    use WithPagination, livewireResource;
    public $search, $pages, $indexParent;
    public $name, $location, $url, $page_id = 0, $parent, $collapse = 0;
    public function rules()
    {
        return [
            'name' => 'required',
            'location' => 'required',
            'url' => 'required_if:page_id,0|url',
            'page_id' => 'required',
            'parent' => 'nullable',
        ];
    }
    public function mount()
    {
        $this->pages = Page::latest()->get();

    }
    public function render()
    {
        $menus = Menu::whereNull('parent')->get();
        // $childs = Menu::where('parent', $this->indexParent)->get()->sortBy('sort');
        $allMenus = Menu::when($this->search,fn($q)=>$q->where('name','like',"%$this->search%")) ->latest()->paginate(10);
        // dd($allMenus);
        return view('livewire.admin.menus', compact('menus', 'allMenus'))->extends('admin.layouts.admin')->section('content');
    }

    public function updateSort($id)
    {
        $menu = Menu::find($id);
        $menu->sort++;
        $menu->save();
    }

    public function beforeUpdate()
    {
        if ($this->data['page_id'] == 'url') {
            unset($this->data['page_id']);
        }
    }
}
