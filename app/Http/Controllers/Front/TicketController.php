<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Traits\JodaResource;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use JodaResource;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $model = 'App\Models\Ticket';
    protected $route = 'tickets.index';

    public $rules = [
        'title' => 'required',
        'type' => 'required|in:orders,activate_mempership,other',
        'description' => 'required',
        'user_id' => 'required',
        'status' => 'sometimes|nullable|in:open,finished,closed',
    ];

    public function query($query)
    {
        if (\request()->status) {
            return $query->where('status', \request()->status)->latest()->paginate(10);
        } elseif (\request()->has('replied')) {
            return $query->whereHas('comments')->latest()->paginate(10);
        } else {
            return $query->latest()->paginate(10);
        }
    }

    public function show(Ticket $ticket)
    {
        return view('client.profile.ticket.show', compact('ticket'));
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'ticket_id' => 'required',
            'user_id' => 'required',
            'file' => 'nullable|mimes:doc,pdf,docx,zip,png,jpg',
        ]);

        $ticket = new TicketComment();
        $ticket->ticket_id = $request->ticket_id;
        $ticket->comment = $request->comment;
        $ticket->user_id = $request->user_id;
        // $ticket->file = store_file($request->file, 'tickets');
        
        if ($request->hasFile('file')) {
            $ticket->file = store_file($request->file('file'), 'tickets');
        }

        $ticket->save();
        return redirect()->back()->with('success', trans('تم الاضافه بنجاح'));
    }


    protected function stored()
    {
        return redirect()->back()->with('success', trans('تم الاضافه بنجاح'));
    }

    protected function updated()
    {
        return redirect()->back()->with('success', trans('تم التعديل'));
    }

    protected function destroyed()
    {
        return redirect()->back()->with('success', trans('تم الحذف بنجاح'));
    }
}
