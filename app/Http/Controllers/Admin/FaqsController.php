<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnaesthesiaOption;
use App\Models\CoreValue;
use App\Models\FiristVisitOption;
use App\Models\OralSurgery;
use Illuminate\Http\Request;

use App\Traits\JodaResource;

class FaqsController extends Controller
{
    use JodaResource;
    public $model = 'App\Models\Faq';
    public $route = "admin.faqs";
    public $view = "admin.faqs";
    public $rules = [
        'question' => 'required',
        'answer' => 'required',
        // 'question_en' => 'required',
        // 'answer_en' => 'required',
    ];

    public function query($query)
    {
        return $query->latest()->paginate(10);
    }


}
