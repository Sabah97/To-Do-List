<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Note;
use DB;

class NotesController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */

     //for user authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $notes= Note::orderBy('created_at','desc')->paginate(10);
        return view('notes.index')->with('notes',$notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image' =>'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt= $request-> file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo( $filenameWithExt, PATHINFO_FILENAME);

            //get just ext
            $extension=$request->file('cover_image')->getCLientOriginalExtension();

            //filenametostore
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //upload
            $path= $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'noimage.jpg';

        }

        //Create Note
        $note=new Note;
        $note->title=$request->input('title');
        $note->body=$request->input('body');
        $note->user_id=auth()->user()->id;
        $note->cover_image=$fileNameToStore;
        $note->save();
        return redirect('/dashboard')->with('success', 'Note created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $note= Note::find($id);
       return view('notes.show')->with('note',$note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note= Note::find($id);
       return view('notes.edit')->with('note',$note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt= $request-> file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo( $filenameWithExt, PATHINFO_FILENAME);

            //get just ext
            $extension=$request->file('cover_image')->getCLientOriginalExtension();

            //filenametostore
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //upload
            $path= $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        
        $note=Note::find($id);
        $note->title=$request->input('title');
        $note->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $note->cover_image=$fileNameToStore;
        }
        $note->save();
        return redirect('/dashboard')->with('success', 'Note updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note=Note::find($id);
        if(auth()->user()->id!==$note->user_id){
            return redirect('/dashboard')->with('error','Unauthorized page');
        }
        if($note->cover_image!='noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$note->cover_image);

        }
        $note->delete();
        return redirect ('/dashboard')->with('success', 'Note Deleted');
    }
}
