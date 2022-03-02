@extends('layouts.master')
    
@section('content')
<a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

<table>
    <tr>
        <td><h1 class="animated flipInX">About devleaks</h1></td>
        <td style="vertical-align: bottom; padding: 4px;"><h4 class="text-muted animated lightSpeedIn">Your questions, answered.</h4> </td>
    </tr>
</table>

<div style="padding-bottom:20px" class="clearfix"></div>

<p>
The Web Development community consists of countless front and back end frameworks, libraries, and technologies, that it has become tough to keep track of all the exciting developments. devleaks is your inside source to all of the latest Web Development tips, tricks, and news, from users around the world.
</p>

<h2>About the devleaks Website</h2>

<p>
devleaks is built using the powerful <a href="http://laravel.com/">Laravel</a> framework. There are many powerful and best practices in the source code:
</p>

<ul>
<li> <strong>Bootstrap, Less and CoffeeScript Integration</strong>: Laravel Elixir | Less | CoffeeScript | Ajax | Bootstrap</li>

<li> <strong>Laravel Form Request Powered</strong>: Registered users can submit a link for display on the devleaks website. Links can be categorized under options such as  <emphasis>PHP</emphasis>, <emphasis>JavaScript</emphasis>, <emphasis>Tutorials</emphasis>, <emphasis>Design</emphasis>, <emphasis>Devops</emphasis>, and more.</li>

<li> <strong>An Administration Console</strong>: Administrate the website's community with ease.</li>

<li><strong>Codeception Integration</strong>: <a href="http://codeception.com/">Codeception</a> has been used to verify a rock solid foundation for your link aggregation website.
</li>

<li> <strong>Sluggable URLs</strong>: devleaks uses the <a href="https://github.com/cviebrock/eloquent-sluggable/">eloquent-sluggable</a> package to create very friendly URLs such as <a href="http://devleaks.com/category/php">http://devleaks.com/category/php</a>.</li>
</ul>
</ul>

<h2>Thanks for contributing.</h2>

<p>
Please make your best effort to submit only links that are genuinely helpful to the web development community.
</p>

@endsection
