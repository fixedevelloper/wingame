<?php


namespace App\Http\Controllers;


use App\Helpers\UploadableTrait;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    use UploadableTrait;
    public function tikets(Request $request)
    {
        if ($request->method()=="POST"){
            $ticket=new Ticket();
            $ticket->numero=$request->numero;
            if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
                $photo = $this->storeFile($request->file('image'), 'tickets');
                $ticket->image = $photo;
            }
            $ticket->date=date('Y-m-d');
            $ticket->save();

        }
        $tickes=Ticket::query()->orderByDesc('created_at')->paginate(20);
        return view('ticket.ticket', [
            "tickets"=>$tickes,
            'route'=>"partipates"
        ]);
    }
    public function updatetikets(Request $request,$id)
    { $ticket=Ticket::query()->find($id);
        if ($request->method()=="POST"){

            if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
                $photo = $this->storeFile($request->file('image'), 'tickets');
                $ticket->image_result = $photo;
            }
            $ticket->save();
            return redirect()->route('admin.tikets');
        }

        return view('ticket.update_ticket', [
            "ticket"=>$ticket
        ]);
    }
}
