<?php namespace Phpleaks\Http\Controllers;

use Phpleaks\Http\Requests;
use Phpleaks\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Phpleaks\Category;
use Phpleaks\Link;
use Phpleaks\Tag;
use Phpleaks\User;
use Phpleaks\Http\Requests\LinkCreateFormRequest;
use Phpleaks\Http\Requests\LinkUpdateFormRequest;

class LinkController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
        $this->middleware('admin', ['only' => ['edit', 'update']]);
        $this->middleware('spam', ['only' => ['store']]);
        $this->request = $request;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $tags = Tag::pluck('name', 'id');
        $categories = \DB::table('categories')->pluck('name', 'id');

        return view('link.create', compact(['tags', 'categories']));
    }

    public function store(LinkCreateFormRequest $request)
    {
        $link = new Link([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'description' => $request->get('description'),
        ]);

        $link->category()->associate(Category::find($request->get('category')));

        $link->user()->associate(User::find(\Auth::id()));

        $link->save();

        $link->tags()->attach($request->input('tags'));

        return \Redirect::route('link.show',
            [$link->slug])->with('message', 'Your link has been added!');
    }

    public function edit($id)
    {
        $link = Link::where('slug', $id)->first();
        $tags = \Phpleaks\Tag::lists('name', 'id');

        foreach ($link->tags as $tag) {
            $currentTags[] = $tag->id;
        }

        if (empty($currentTags)) {
            $currentTags = '';
        }

        $categories = \DB::table('categories')->lists('name', 'id');
        $title = $link->name . ' - Best Web Development Resources';
        $metadescription = $link->description;

        return view('link.edit', compact(['link', 'title', 'metadescription', 'categories', 'tags', 'currentTags']));
    }

    public function destroy($id)
    {
        $link = Link::where('slug', $id)->first();
        $link->delete();

        return back();
    }

    public function update(LinkUpdateFormRequest $request, $id)
    {
        $link = Link::where('slug', $id)->first();
        $link->category()->associate(Category::find($request->get('category')));
        $link->name = $request->get('name');
        $link->description = $request->input('description');
        $tags = $request->input('tags');
        $link->tags()->sync($tags);
        $link->save();

        return \Redirect::route('link.show',
            [$link->slug])->with('message', 'Your link has been updated!');
    }

    public function show($id)
    {
        $link = Link::where('slug', $id)->first();
        $title = $link->name . ' - Best Web Development Resources';
        $metadescription = $link->name . ' - ' . $link->description;
        $metakeywords = $link->name;

        return view('link.show', compact(['link', 'title', 'metadescription', 'metakeywords']));
    }

    public function newest($category = '')
    {
        $category = isset($category) ? Category::where('slug', $category)->first() : '';

        $categories = \DB::table('categories')->pluck('name', 'slug');

        $links = Link::orderBy('created_at', 'desc')
            ->where(function ($query) use ($category) {

                if ($category != '') {
                    $query->where('category_id', '=', $category->id);
                }

            })->paginate(42);

        $trending = $this->request['trending'];

        return view('link.new', compact(['category', 'categories', 'links', 'trending']));
    }

    public function category($category = '', $sortmode = '')
    {
        if ($sortmode !== '') {
            session(['sortmode' => $sortmode]);
        }
        $sortorder = session('sortmode', 'new');
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
        $category = isset($category) ? Category::where('slug', $category)->first() : '';

        $links = Link::with('user')->with('tags')->withCount('favorites')
            ->where(function ($query) use ($category) {

                if ($category != '') {
                    $query->where('category_id', '=', $category->id);
                }

            })->orderBy($orderby['column'],
                $orderby['direction'])->paginate(42);

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

        $metacategory = is_null($category) ? '' : $category->name;
        $title = 'Popular ' . $metacategory . ' Resources - Best Web Development Resources';
        $metadescription = 'Popular ' . $metacategory . ' Resources - Best Web Development Resources';
        $metakeywords = $metacategory;

        return view('link.category', compact([
            'category',
            'tags',
            'categories',
            'links',
            'trending',
            'title',
            'metadescription',
            'metakeywords',
        ]));
    }

    public function tag($tag = '', $sortmode = '')
    {
        if ($sortmode !== '') {
            session(['sortmode' => $sortmode]);
        }
        $sortorder = session('sortmode', 'new');
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

        $tag = isset($tag) ? Tag::where('slug', $tag)->first() : '';

        $links = Link::with('user')->with('tags')->withCount('favorites')
            ->whereHas('tags', function ($query) use ($tag) {
                if ($tag != '') {
                    $query->where('tags.id', '=', $tag->id);
                }
            })->orderBy($orderby['column'],
                $orderby['direction'])->paginate(42);


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

        $metatag = is_null($tag) ? '' : $tag->name;
        $title = 'Popular ' . $metatag . ' Resources - Best Web Development Resources';
        $metadescription = 'Popular ' . $metatag . ' Resources - Best Web Development Resources';
        $metakeywords = $metatag;
        $activetag = $this->request->tag;

        return view('link.tag', compact([
            'tag',
            'tags',
            'categories',
            'links',
            'trending',
            'title',
            'metadescription',
            'metakeywords',
            'activetag',
        ]));
    }

    public function trending()
    {
        $trending = $this->request['trending'];

        return view('link.trending', compact(['trending']));
    }

    public function outbound()
    {
        $link = Link::find(\Input::get('id'));

        $user = User::find(\Auth::id());

        // Prevent users from easily gaming the system
        // by not allowing them to increase click-throughs
        // by clicking on their own links.

        if ($user != $link->user) {
            $link->outbound_count++;
        }

        if ($link->save()) {
            return \Response::json(['success' => true]);
        }

        return \Response::json(['success' => false]);
    }

    public function favorite()
    {
        $link = Link::find(\Input::get('id'));

        $user = User::find(\Auth::id());

        if ($user->favorites->contains($link)) {
            $user->favorites()->detach($link);
            $status = 'down';

        } else {
            $user->favorites()->attach($link);
            $status = 'up';
        }

        return \Response::json(['success' => true, 'id' => $link->id, 'status' => $status]);
    }

    public function search()
    {
        $query = \Request::get('q');

        if ($query == '') {
            return \Redirect::back();
        }

        $category = '';
        $links = Link::where('name', 'LIKE', "%$query%")->orWhere('description', 'LIKE', "%$query%")->paginate(42);
        $categories = \DB::table('categories')->lists('name', 'slug');
        $trending = $this->request['trending'];

        return view('link.search', compact(['links', 'category', 'categories', 'query', 'trending']));
    }
}
