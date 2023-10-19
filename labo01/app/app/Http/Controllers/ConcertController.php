<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConcertController extends Controller
{
    public function index(){
        return redirect('/concerts');
    }

    public function showConcerts(Request $request){
        // @TODO: Als er search als get param is doorsturen naar /search/term
        if($request->query('search')){
            return redirect('/search/' . $request->query('search'));
        }
        $companies = DB::select('select * from concerts');
        return view('overview', ['companies' => $companies, 'searchString' => '']);
    }

    public function searchConcerts(Request $request, $term){
        $companies = DB::select('SELECT * FROM concerts WHERE (title LIKE ? OR location LIKE ?)', ['%'.$term.'%', '%'.$term.'%']);
        return view('overview', ['companies' => $companies, 'searchString' => $term]);
    }

    public function toggleConcert(Request $request, $id){
        switch(DB::select('SELECT fav FROM concerts WHERE id = ?', [$id])[0]->fav){
            case 0:
                DB::update('UPDATE concerts SET fav = 1 WHERE id = ?', [$id]);
                break;
            case 1:
                DB::update('UPDATE concerts SET fav = 0 WHERE id = ?', [$id]);
                break;
            default:
            break;
        }
        return redirect('concerts');
    }

    public function showConcert($id){
        $company = DB::select('SELECT * FROM concerts WHERE id = ?', [$id]);
        $images = DB::select('SELECT * FROM images WHERE concert_id = ?', [$id]);
        return view('concert', ['company' =>  $company[0], 'images' => $images]);
    }

    public function showConcertImage($concert_id, $img_id){
        $image = DB::select('SELECT * FROM images INNER JOIN concerts ON concerts.id = images.concert_id WHERE images.id = ? AND images.concert_id = ?', [$img_id, $concert_id]);
        return view('image', ['image' => $image[0]]);
    }
}
