<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title="Welcome to the app!";
        return view('pages.index', compact('title'));
    }
    public function services(){
        $data=array(
            'title'=> 'Services',
            'services'=>['Save notes','Add pictures with your notes','Add descriptions ']

        );
        return view('pages.services')->with($data);
    }
}
