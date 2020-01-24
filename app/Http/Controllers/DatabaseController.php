<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;

class DatabaseController extends Controller
{
    public function index()
    {
        return view('upload');
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

}
