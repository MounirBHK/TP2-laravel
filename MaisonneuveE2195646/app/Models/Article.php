<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_fr', 'body', 'body_fr', 'userId'];

    public function userArticle()
    { 
        return $this->belongsTo(User::class); 
    }

    static public function selectArticle()
    {
        if(! session()->has('locale'))
        {
            session()->put('locale', 'en');
        }
        
        if (session()->get('locale') === 'fr')
        {
            $query = Article::Select('id',
            DB::raw('(case 
                        when (title_fr != "") then title_fr else title
                    end) as title'),
            DB::raw('(case 
                        when (body_fr != "") then body_fr else body
                    end) as body'),
            'userId',
            'created_at',
            'updated_at'   
            )
            ->get(); 
        }
        else
        {
            $query = Article::Select('id',
            DB::raw('(case 
                        when (title != "") then title else title_fr
                    end) as title'),
            DB::raw('(case 
                        when (body != "") then body else body_fr
                    end) as contenu'),
            'userId',
            'created_at',
            'updated_at'   
            )
            ->get(); 
        }    
        
        return $query;

    }
}
