<?php namespace Phpleaks\Http\Controllers;

use Illuminate\Http\Request;
use Phpleaks\Tag;

class TagController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $tags = Tag::join('link_tag', 'link_tag.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->get([
                'tags.id',
                'tags.name',
                'tags.slug',
                \DB::raw('count(tags.id) as tag_count')
            ])->sortByDesc('tag_count')->all();

        $categories = \DB::table('categories')->lists('name', 'slug');
        $title = 'All Tags - Devleaks Best Web Development Resources';

        return view('tag.index', compact(['tags','categories','title']));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
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

        $tag = Tag::where('slug', $id)->first();
        $categories = \DB::table('categories')->pluck('name', 'slug');
        $links = Tag::find($tag->id)->links()->orderBy('outbound_count', 'desc')->paginate(42);

        $title = $links->total().' awesome '.$tag->name.' resources - Devleaks Best Web Development Resources';
        $metadescription = $links->total().' awesome '.$tag->name.' resources - Devleaks Best Web Development Resources';
        $metakeywords = $tag->name;

        $trending = $this->request['trending'];

        $activetag = $this->request->tag;

        return view('tag.show', compact(['tags', 'tag', 'categories', 'links', 'title', 'metadescription', 'metakeywords', 'trending', 'activetag']));
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
