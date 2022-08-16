<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_fr', 'url'];

    public function userDoc()
    { 
        return $this->belongsTo(User::class); 
    }

    static public function selectDoc()
    {
        if(! session()->has('locale'))
        {
            session()->put('locale', 'en');
        }
        
        if (session()->get('locale') == 'fr')
        {
            $query = Document::Select('id',
            DB::raw('(case 
                        when (title_fr != "") then title_fr else title
                    end) as title'),
            'url',
            'userId',
            'created_at',
            'updated_at'   
            )
            ->get(); 
        }
        else
        {
            $query = Document::Select('id',
            DB::raw('(case 
                        when (title != "") then title else title_fr
                    end) as title'),
            'url',
            'userId',
            'created_at',
            'updated_at'   
            )
            ->get(); 
        }    
       

        return $query;
    }
}
