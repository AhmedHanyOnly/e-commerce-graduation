<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use App\Traits\livewireResource;
use Livewire\Component;

class Articles extends Component
{
    use livewireResource;

    public $title, $image, $content, $active;
    protected $view = 'livewire.admin.Articles.index';

    public $search;

    public function rules()
    {
        return [
            'title' => 'required',
            'image' => 'nullable',
            'active' => 'required',
            'content' => 'required'
        ];
    }

    public function beforeSubmit()
    {
        if ($this->image) {
            if ($this->obj) {
                if ($this->obj->image !== $this->image) {
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'articles');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'articles');
            }
        }
    }

    public function render()
    {
        $articles = Article::when($this->search, fn($q) => $q->where('title', 'like', "%$this->search%"))->paginate(10);
        return view('livewire.admin.Articles.index', compact('articles'));
    }
}
