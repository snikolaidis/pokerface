<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;
use Illuminate\Support\Facades\Auth;

class DatabaseController extends Controller
{

    /**
     * Implementing basic auth access.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Default upload functionality. In case the user has no rights, redirects back to dashboard with error message.
     * 
     * @return Illuminate\View\View|Illuminate\Contracts\View\Factory|Illuminate\Routing\Redirector|Illuminate\Http\RedirectResponse 
     */
    public function index()
    {
        $this->user = Auth::user();

        if ($this->user->user_level == 10) {
            return view('upload');
        } else {
            return redirect('home')->with('danger', 'You don\'t have access to upload section.');
        }
    }

    public function store(Request $request)
    {
        return back()->with('message', 'Your file is submitted Successfully');
    }
    
    public function upload(Request $request)
    {
        $uploadedFile = $request->file('file')->getRealPath();
        $file = fopen($uploadedFile, "r");
        
        $i = 0;
        while(!feof($file)) {
            $singleLineOfCards = fgets($file);
            $game = new \App\PokerGame();
            $game->addListOfCards($singleLineOfCards);
            $game->save();
            $i++;
        }
        fclose($file);

        return [
            "result" => true,
            "message" => "Your file is submitted successfully. <b>$i records</b> were processed.",
        ];
    }

    /**
     * Default wipe functionality. In case the user has no rights, redirects back to dashboard with error message.
     * 
     * @param Request $request 
     * @return Illuminate\Http\RedirectResponse|Illuminate\Routing\Redirector 
     */
    public function wipe(Request $request)
    {
        $this->user = Auth::user();

        if ($this->user->user_level == 10) {
            \App\PokerGame::truncate();
            return back()->with('message', 'Database is wiped. Let\'s start again!');
        } else {
            return redirect('home')->with('danger', 'You don\'t have access to wipe the database.');
        }
    }

}
