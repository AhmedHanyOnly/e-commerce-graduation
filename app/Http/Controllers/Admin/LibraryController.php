<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationLibrary;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $libraries =NotificationLibrary::paginate(10);
        return view('admin.library.index',compact('libraries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['content' => 'required']);
        NotificationLibrary::create($data);
        return back()->with('success', 'تم انشاء مكتبة بنجاح');
    }

    public function update(Request $request, NotificationLibrary $library)
    {
        $data = $request->validate(['content' => 'required']);
        $library->update($data);
        return back()->with('success', 'تم تعديل المكتبة بنجاح');
    }

    public function destroy(Request $request, NotificationLibrary $library)
    {
        $library->delete();
        return back()->with('success', 'تم حذف المكتبة بنجاح');
    }

    public function deleteAll(Request $request, NotificationLibrary $library)
    {
        \DB::table('notification_libraries')->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
