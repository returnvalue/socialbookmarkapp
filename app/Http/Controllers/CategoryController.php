<?php namespace Phpleaks\Http\Controllers;

use Illuminate\Http\Request;
use Phpleaks\Category;
use Phpleaks\Tag;


class CategoryController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('category.index', compact(['categories']));
    }

    public function show($id)
    {
        $tags = Tag::join('link_tag', 'link_tag.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->get([
                'tags.id',
                'tags.name',
                'tags.slug',
                \DB::raw('count(tags.id) as tag_count')
            ])->sortByDesc('tag_count')->take(44);

        $category = Category::where('slug', $id)->first();
        $categories = \DB::table('categories')->lists('name', 'slug');

        $links = $category->links()->paginate(42);

        $title = $category->name . ' - Devleaks Best Web Development Resources';
        $metadescription = $category->name;

        $trending = $this->request['trending'];

        return view('category.show', compact(['category','tags','categories', 'links', 'title', 'metadescription', 'trending']));
    }


}
