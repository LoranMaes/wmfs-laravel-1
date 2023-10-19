<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Blogpost;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    private static function getRecents()
    {
        return Blogpost::orderByDesc('created_at')->limit(10)->get()->pluck('title', 'id');
    }

    private static function getCategories()
    {
        return Category::orderBy('id')->get();
    }

    private static function getAuthors()
    {
        return Author::orderBy('id')->get();
    }

    public function index()
    {
        $posts = Blogpost::with('tags')->where('featured', true)->orderByDesc('created_at')->get();
        return view('homepage', ['posts' => $posts, 'categories' => BlogController::getCategories()]);
    }

    public function viewCategory(int $id)
    {
        $posts = Blogpost::with('tags')->where('category_id', $id)->orderByDesc('created_at')->get();
        return view('category', ['posts' => $posts, 'categories' => BlogController::getCategories(), 'recent_posts' => BlogController::getRecents()]);
    }

    public function viewBlogpost(Request $request, int $id)
    {
        $post = Blogpost::where('id', $id)->get();
        if (count($post) < 1) return redirect('/');
        $comments = Comment::where('blogpost_id', $id)->orderByDesc('created_at')->get();
        return view('blogpost', ['post' => $post[0], 'categories' => BlogController::getCategories(), 'recent_posts' => BlogController::getRecents(), 'comments' => $comments]);
    }

    public function viewAuthor(int $id)
    {
        $author = Author::where('id', $id)->limit(1)->get();
        if (count($author) < 1) return redirect('/');
        $posts = Blogpost::with(['author', 'tags'])->where('author_id', $id)->orderByDesc('created_at')->get();
        return view('author', ['posts' => $posts, 'author' => $author[0], 'categories' => BlogController::getCategories(), 'recent_posts' => BlogController::getRecents()]);
    }

    public function showCreateBlogpost(Request $request)
    {
        return view('add', ['validation' => old('show'), 'authors' => BlogController::getAuthors(), 'categories' => BlogController::getCategories(), 'recent_posts' => BlogController::getRecents()]);
    }
    public function createBlogpost(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogposts|max:125',
            'content' => 'required|min:10',
            'image' => 'required|image|max:4000',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Add file
        $request->file('image')->store('public');
        $fileName = $request->file('image')->hashName();

        $post = Blogpost::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $fileName,
            'category_id' => $request->category_id,
            'author_id' => Auth::id(),
            'featured' => $request->featured == 'on' ? 1 : 0,
        ]);

        // Add tags
        if (strlen($request->tags) > 0) {
            $tags = explode(' ', $request->tags);
            foreach ($tags as $strTag) {
                $tag = Tag::firstOrCreate([
                    'title' => $strTag
                ]);
                $post->tags()->save($tag);
            }
        }

        $id = Blogpost::orderByDesc('created_at')->limit(1)->get('id')[0]->id;
        return redirect('/blogposts/' . $id);
    }

    public function deleteBlogpost(Blogpost $blogpost)
    {
        $blogpost->delete();
        return redirect('/authors/' . Auth::id());
    }

    public function searchBlogpost(Request $request)
    {
        $blogposts = [];
        if ($request->query->count() < 1) {
            // If there aren't any parameters
            $blogposts = Blogpost::with(['category', 'tags'])->orderBy('created_at', 'desc');
        } else {
            $blogposts = Blogpost::query();
            $blogposts->with(['category', 'tags']);
            foreach ($request->query as $key => $value) {
                switch ($key) {
                    case 'term':
                        if ($value) {
                            foreach (explode(' ', $value) as $term) {
                                $blogposts->where('title', 'LIKE', '%' . $term . '%');
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
                            $blogposts->orderBy('title');
                        }
                        break;
                }
            }
        }
        return view('search', ['blogposts' => $blogposts->paginate(10), 'categories' => $this->getCategories(), 'authors' => $this->getAuthors()]);
    }
}
