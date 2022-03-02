<?php namespace Phpleaks\Http\Controllers;

use Illuminate\Http\Request;
use Phpleaks\Link;
use Phpleaks\Tag;

class WelcomeController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index($sortmode = '')
    {
        if ($sortmode !== '' and $sortmode !== 'search') {
            session(['sortmode' => $sortmode]);
        } else {
            session(['sortmode' => 'new']);
        }

        $sortorder = session()->get('sortmode');

        if ($sortorder == 'new') {
            $orderby['column'] = 'created_at';
            $orderby['direction'] = 'desc';
        } elseif ($sortorder == 'mostclicks') {
            $orderby['column'] = 'outbound_count';
            $orderby['direction'] = 'desc';
        } elseif ($sortorder == 'mostfavorites') {
            $orderby['column'] = 'favorites_count';
            $orderby['direction'] = 'desc';
        } else {
            $orderby['column'] = 'created_at';
            $orderby['direction'] = 'desc';
        }

        // $links = Link::newest()->paginate(42);  lots of queries
        $links = Link::with('user')->with('tags')->withCount('favorites')->orderBy($orderby['column'],
            $orderby['direction'])->paginate(42);  // less queries

        $category = '';
        $categories = \DB::table('categories')->pluck('name', 'slug');
        $trending = $this->request['trending'];
        $tags = Tag::join('link_tag', 'link_tag.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->get([
                'tags.id',
                'tags.name',
                'tags.slug',
                \DB::raw('count(tags.id) as tag_count'),
            ])->sortByDesc('tag_count')->take(44);

        return view('welcome', compact(['links', 'category', 'categories', 'tags', 'trending', 'filter']));
    }

}
