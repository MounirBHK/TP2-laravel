<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listeDocs = Document::selectDoc();

        return view('docs.docs', ['listeDocs' => $listeDocs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Session::get('id');
        $user = User::find($id);
        
        return view('docs.createDoc',['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required_without:title_fr',
            'title_fr' => 'required_without:title',
            'url' => 'required',
        ]);

        $filename = 'cmfiles'.time().'.'.$request->file('url')->getClientOriginalExtension();
        $path = $request->file('url')->storeAs('fichiers', $filename, 'public');

        $id = Session::get('id');
        $user = User::find($id);

        $newDocument = new Document;

        if($request->title != null)
            $newDocument->title = $request->title;
        else
            $newDocument->title ='';

        if($request->title_fr != null)
            $newDocument->title_fr = $request->title_fr;
        else
            $newDocument->title_fr ='';

        $newDocument->url = $filename;
        $newDocument->userId = $id;

        $newDocument->save();

        return redirect(route('docs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        if(session()->has('locale'))
        {
            if (session()->get('locale') == 'fr')
            {
                $document = Document::Select('documents.id',
                DB::raw('(case 
                            when (title_fr != "") then title_fr else title
                        end) as title'),
                'url',
                'documents.userId',
                'users.name as nom',
                'documents.created_at',
                'documents.updated_at'   
                )
                ->JOIN('users','users.id','=','documents.userId')
                ->WHERE('documents.id', $document->id )
                ->get(); 
            }
            else
            {
                $document = Document::Select('documents.id',
                DB::raw('(case 
                            when (title != "") then title else title_fr
                        end) as title'),
                'url',
                'documents.userId',
                'users.name as nom',
                'documents.created_at',
                'documents.updated_at'   
                )
                ->JOIN('users','users.id','=','documents.userId')
                ->WHERE('documents.id', $document->id )
                ->get();    
            }    
            return view('docs.showDoc', ['document' => $document[0]]);
        }
        
    }
   
    public function viewTheDoc(Document $document)
    {
        $file_name = $document->url;
        $file_path = public_path('storage/fichiers/'.$file_name);
        
        if(is_file($file_path))
        {
            return view('docs.viewTheDoc', ['document' => $document]);
        }
       
        return view('docs.docs');
    }
        
    /**
     * download
     *
     * @param  mixed $document
     * @return void
     */
    public function download(Document $document)
    {

        $file_name = $document->url;
        $file_path = public_path('storage/fichiers/'.$file_name);
        if(is_file($file_path)){
            return response()->download($file_path);
        }
        
        return '404 NOT FOUND';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $user = User::find($document->userId); 
        return view('docs.editDoc', ['document' => $document, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $document)
    {
        $file = Document::find($document);

        $request->validate([
            'title' => 'required_without:title_fr',
            'title_fr' => 'required_without:title',
        ]);
            
        $filename = $file->url;
        $path = public_path('storage/fichiers/'.$filename);

        if($request->hasFile('url')){
            unlink($path);
            
            $f = $request->file('url');
            
            $filename = 'cmfiles'.time().'.'.$f->getClientOriginalExtension();
                
            $path = $request->file('url')->storeAs('fichiers', $filename, 'public');

            $f->move($path, $filename);

            $file->url = $filename;
        } 
        else
        {
            $file->url = $request->old_file;
        }

        
        ($request->title != null) ? $file->title = $request->title : $file->title ='';
        ($request->title_fr != null) ? $file->title_fr = $request->title_fr : $file->title_fr ='';

        $file->save();

        return redirect(route('docs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $file_name = $document->url;
        $file_path = public_path('storage/fichiers/'.$file_name);
        if(is_file($file_path))
        {
            unlink($file_path);
            $document->delete();
        }
        else
        {
            echo "File does not exist";
        }

        return redirect(route('docs'));
        
    }
}
