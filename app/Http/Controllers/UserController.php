<?php namespace Phpleaks\Http\Controllers;

use Illuminate\Http\Request;
use Phpleaks\User;

class UserController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function show($name)
    {
        $user = User::where('name', '=', $name)->first();

        // Retrieve the latest 15 links. If user wants to see more favorited
        // by this profile, user can click a link to view paginated results
        // $favoritedLinks = $user->favorites()->orderBy('created_at', 'desc')->paginate(42);

        $favoritedLinks = $user->favorites()->withCount('users')->orderBy('users_count', 'desc')->paginate(42);

        $title = $user->name . '\'s favorite links on Devleaks Best Web Development Resources';
        $metadescription = $user->name . '\'s favorite links on Devleaks Best Web Development Resources';

        $trending = $this->request['trending'];

        return view('user.show', compact(['user', 'favoritedLinks', 'title', 'metadescription', 'trending']));
    }

}
