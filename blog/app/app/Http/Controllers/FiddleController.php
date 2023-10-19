<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Blogpost;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;

class FiddleController extends Controller
{
    public function index(){
        dump(Blogpost::count());
        dump(Blogpost::where('featured', 1)->count());
        
        dump(Comment::count());

        dump(Blogpost::find(2));

        dump(Blogpost::find(2)->title);
        dump(Blogpost::where('id', 2)->value('title'));

        dump(Blogpost::find(2));
        dump(Blogpost::where('title', 'like', 'A%')->orderBy('created_at', 'desc')->get());

        dump(Category::orderBy('title')->pluck('title', 'id')->all());

        dump(
            Comment::whereHas('author', function(Builder $query){
                $query->where('first_name', 'Joris');
            })->get()
        );
        dump(Comment::whereRelation('author', 'first_name', 'Joris'));

        dump(Blogpost::doesntHave('comments')->get());

        Author::create(['first_name' => 'Jefke', 'last_name'=> 'Janssens', 'email' => 'jefke@gobelijn.be', 'website' => 'jefke.be', 'location' => 'Zonnebeke']);
    
        dump(Author::pluck('first_name', 'last_name')->all());

        $comment = new Comment();
        $comment->content = 'Gevaarlijk vies ventj';
        $comment->blogpost()->associate(2);
        $comment->author()->associate(Author::where('first_name', 'Jefke')->first());
        $comment->save();
    }
}
