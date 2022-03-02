<?php
$query = \Request::get('q');
Route::get('search', [
    'as' => 'link.search',
    'uses' => 'LinkController@search'
]);

Route::get('category/{category}/{sortorder?}', 'LinkController@category');
Route::get('tag/{tag}/{sortorder?}', 'LinkController@tag');
Route::get('trending', [
    'as' => 'link.trending',
    'uses' => 'LinkController@trending'
]);
Route::get('/{sortorder?}', 'WelcomeController@index');

Route::get('/', ['as' => 'welcome', 'uses' => 'WelcomeController@index']);

Route::get('about', function () {
    return view('about.index');
});

Route::get('terms', function () {
    return view('about.terms');
});

Route::resource('category', 'CategoryController', ['only' => ['index', 'show']]);
Route::put('link/{id}', 'LinkController@update');
Route::resource('link', 'LinkController');

Route::resource('tag', 'TagController', ['only' => ['show', 'index']]);

Route::get('new/{category?}', [
    'as' => 'link.new',
    'uses' => 'LinkController@newest'
]);

Route::get('popular/{category?}', [
    'as' => 'link.popular',
    'uses' => 'LinkController@popular'
]);

Route::post('link/outbound', 'LinkController@outbound');

Route::post('link/favorite', [
    'as' => 'link.favorite',
    'uses' => 'LinkController@favorite'
]);

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'admin',
        'middleware' => 'admin'
    ], function () {
    Route::resource('user', 'UserController');
});

Route::resource('user', 'UserController');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::get('test', function () {

    $tags = Phpleaks\Tag::join('link_tag', 'link_tag.tag_id', '=', 'tags.id')
        ->groupBy('tags.id')
        ->get(['tags.id', 'tags.name', DB::raw('count(tags.id) as tag_count')])->sortByDesc('tag_count');

    foreach ($tags as $tag) {
        var_dump($tag->name);
    }
});


//--route resources--//
//Route::resource('link', 'LinkController');
//Route::resource('user', 'UserController');
//Route::resource('category', 'CategoryController', ['only' => ['index', 'show']]);
//Route::resource('tag', 'TagController', ['only' => ['show', 'index']]);
//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);
//
//$query = \Request::get('q');
//Route::get('trending', 'LinkController@trending');
//Route::get('search', 'LinkController@search');
//
//Route::put('link/{id}', ['as'=>'link.update', 'uses'=>'LinkController@update']);
//
////--sorting--//
//Route::get('category/{category}/{sortorder?}', 'LinkController@category');
//Route::get('tag/{tag}/{sortorder?}', 'LinkController@tag');
//
//Route::get('/{sortorder?}', 'WelcomeController@index');
//
//
//Route::get('new', [
//    'as' => 'link.new',
//    'uses' => 'LinkController@new',
//]);



Route::post('link/outbound', 'LinkController@outbound');

Route::post('link/favorite', [
    'as' => 'link.favorite',
    'uses' => 'LinkController@favorite',
]);



Route::get('about', function () {
    return view('about.index');
});

Route::get('terms', function () {
    return view('about.terms');
});

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'admin',
        'middleware' => 'admin',
    ], function () {
    Route::resource('user', 'UserController');
});

Route::get('test', function () {

    $tags = Phpleaks\Tag::join('link_tag', 'link_tag.tag_id', '=', 'tags.id')
        ->groupBy('tags.id')
        ->get(['tags.id', 'tags.name', DB::raw('count(tags.id) as tag_count')])->sortByDesc('tag_count');

    foreach ($tags as $tag) {
        var_dump($tag->name);
    }

});
