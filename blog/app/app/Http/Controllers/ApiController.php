<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogpost;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class ApiController extends Controller
{
    public function getFeatured()
    {
        $blogposts = Blogpost::join('categories', 'categories.id', '=', 'blogposts.category_id')->where('featured', '1')->select(['blogposts.id', 'blogposts.title AS blogpost_title', 'image', 'created_at', 'content', 'category_id', 'categories.title AS categories_title'])->get();
        foreach ($blogposts as $post) {
            $post->content = Str::limit($post->content, 100);
        }

        return ['data' => $blogposts];
    }

    public function getRecent()
    {
        return ['data' => Blogpost::select(['id', 'title'])->orderBy('id', 'desc')->first()];
    }

    public function getBlogposts(Request $request)
    {
        $blogposts = [];
        if ($request->query->count() < 1) {
            // If there aren't any parameters
            $blogposts = Blogpost::join('categories', 'categories.id', '=', 'blogposts.category_id')->orderBy('created_at', 'desc');
        } else {
            $blogposts = Blogpost::query();
            $blogposts->join('categories', 'categories.id', '=', 'blogposts.category_id');
            foreach ($request->query as $key => $value) {
                switch ($key) {
                    case 'term':
                        if ($value) {
                            foreach (explode(' ', $value) as $term) {
                                $blogposts->where('blogposts.title', 'LIKE', '%' . $term . '%');
                            }
                        }
                        break;
                    case 'tags':
                        if ($value) {
                            $tags = explode(' ', $request->tags);
                            $blogposts->whereHas('tags', function (Builder $query) use ($tags) {
                                $query->whereIn('title', $tags);
                            });
                        }
                        break;
                    case 'category_id':
                        if ($value) {
                            $blogposts->where('category_id', $value);
                        }
                        break;
                    case 'author_id':
                        if ($value) {
                            $blogposts->where('author_id', $value);
                        }
                        break;
                    case 'after':
                        if ($value) {
                            $blogposts->where('created_at', '>', Carbon::parse($value)->format('Y-m-d H:i:s'));
                        }
                    case 'before':
                        if ($value) {
                            $blogposts->where('created_at', '<', Carbon::parse($value)->format('Y-m-d H:i:s'));
                        }
                        break;
                    case 'sort':
                        if ($value == 'most_recent') {
                            $blogposts->orderBy('id', 'desc');
                        } else if ($value == 'less_recent') {
                            $blogposts->orderBy('id');
                        } else if ($value == 'title') {
                            $blogposts->orderBy('blogposts.title');
                        }
                        break;
                }
            }
        }

        $blogposts->select(['blogposts.id', 'blogposts.title AS blogpost_title', 'image', 'created_at', 'content', 'category_id', 'categories.title AS categories_title']);

        foreach ($blogposts as $post) {
            $post->content = Str::limit($post->content, 100);
        }

        return ['data' => $blogposts->get()];
    }

    public function getBlogpost(int $id)
    {
        $blogpost = Blogpost::join('authors', 'authors.id', '=', 'blogposts.author_id')->where('blogposts.id', $id)->select(['blogposts.id AS blogpost_id', 'blogposts.title AS blogpost_title', 'image', 'blogposts.created_at', 'blogposts.content', 'blogposts.author_id AS authorID', Blogpost::raw("CONCAT(authors.first_name,' ',authors.last_name) AS full_name")])->first();
        $comments = Comment::join('authors', 'authors.id', '=', 'comments.author_id')->where('authors.id', $blogpost->authorID)->select(['comments.id AS comment_id', 'comments.created_at', 'comments.content', Comment::raw("CONCAT(authors.first_name,' ',authors.last_name) AS full_name")])->get();
        return ['data' => [$blogpost, $comments]];
    }

    public function addBlogpost(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogposts|max:125',
            'content' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        $post = Blogpost::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => 'no_image_with_api',
            'author_id' => $request->author_id,
            'featured' => $request->featured == 'on' ? 1 : 0,
        ]);

        return ['message' => 'The product with id ' . $post->id . ' has been created'];
    }

    public function getCategory(int $id)
    {
        $category = Category::where('id', $id)->select(['id', 'title'])->first();
        $blogposts = Blogpost::join('authors', 'authors.id', '=', 'blogposts.author_id')->where('category_id', $category->id)->select(['blogposts.id', 'blogposts.title', 'blogposts.image', 'blogposts.created_at', 'blogposts.content', 'blogposts.author_id AS authorID', Blogpost::raw("CONCAT(authors.first_name,' ',authors.last_name) AS full_name")])->get();

        return ['data' => [$category, $blogposts]];
    }

    public function getAuthor(int $id)
    {
        $author = Author::select(['id', 'first_name', Blogpost::raw("CONCAT(authors.first_name,' ',authors.last_name) AS full_name"), 'website', 'location'])
            ->where('id', $id)
            ->first();

        $blogposts = Blogpost::join('authors', 'authors.id', '=', 'blogposts.author_id')
            ->where('author_id', $author->id)
            ->select([
                'blogposts.id',
                'blogposts.title',
                'blogposts.image',
                'blogposts.created_at',
                'blogposts.content',
                'blogposts.author_id AS authorID',
                Blogpost::raw("CONCAT(authors.first_name,' ',authors.last_name) AS full_name")
            ])
            ->get();

        return ['data' => [$author, $blogposts]];
    }

    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function loginSanctum(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response(['message' => 'The user has been authenticated successfully'], 200);
        }
        return response(['message' => 'The provided credentials do not match our records.'], 401);
    }

    public function logoutSanctum(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return response(['message' => 'The user has been logged out successfully'], 200);
    }
}
