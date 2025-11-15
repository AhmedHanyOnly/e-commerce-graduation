<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use App\Traits\JodaResource;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use JodaResource;

    public $rules = [
        'title' => 'required',
        'type' => 'required|in:orders,activate_mempership,other',
        'description' => 'required',
        'user_id' => 'required',
        'status' => 'sometimes|nullable|in:open,finished,closed',
    ];

    // public function query($query)
    // {
    //     if(\request()->status) {
    //         return $query->where('status',\request()->status)->latest()->paginate(10);
    //     } else {
    //         return $query->latest()->paginate(10);
    //     }
    // }
    public function query($query)
    {
        if (\request()->status) {
            return $query->where('status', \request()->status)->latest()->paginate(10);
        } elseif (\request()->has('replied')) {
            // يتم التعامل مع حالة تم الرد هنا
            return $query->whereHas('comments')->latest()->paginate(10);
        } else {
            return $query->latest()->paginate(10);
        }
    }
    


    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'ticket_id' => 'required',
            'user_id' => 'required',
            'filename' => 'nullable',
            'filename.*' => 'nullable|mimes:doc,pdf,docx,zip,png,jpg'
        ]);
        $ticket = new TicketComment();
        $ticket->ticket_id = $request->ticket_id;
        $ticket->comment = $request->comment;
        $ticket->user_id = $request->user_id;
        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
            $ticket->filename = json_encode($data);
        }
        $ticket->save();
        // $comment = TicketComment::create([
        //     'comment' => $request->comment,
        //     'ticket_id' => $request->ticket_id,
        //     'user_id' => $request->user_id,
        // ]);

       /* $ticket = Ticket::findOrFail($request->ticket_id);
        $user = User::findOrFail($ticket->user_id);
        $link = route('tickets.show', $ticket->id);
        $title = ' لديك تعليق جديد على التذكرة' . $ticket->title;

        $user->notify(new DatabaseNotification($title, $link)); */

        return redirect()->back()->with('success', trans('تم الاضافه بنجاح'));
    }
}
