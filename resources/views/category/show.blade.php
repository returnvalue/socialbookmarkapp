@extends('layouts.master')
    
@section('content')

  <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>
  <table>
      <tr>
          <td><h1 class="animated flipInX">{{ $category->name }}</h1></td>
          <td style="vertical-align: bottom; padding: 4px;"><h4 class="text-muted animated lightSpeedIn">Resources.</h4> </td>
          <td>
              <div>
                  <div class="col-md-3">
                      <a target="_blank" title="Share this website on Twitter" data-toggle="tooltip"
                         href="https://twitter.com/share?url=http://devleaks.com/&amp;text=devleaks.com is a resource for Web Developers and Technology Fans.&amp;hashtags=JavaScript,Tutorials,WebDesign,Linux"><img
                                  width="85px" class="responsive animated flipInX" src="/images/twitter.png"></a>
                  </div>
                  <div class="col-md-3">
                      <a target="_blank" title="Share this website on Facebook" data-toggle="tooltip" href="https://www.facebook.com/sharer/sharer.php?u=http://devleaks.com"><img
                                  width="85px" class="responsive animated flipInX" src="/images/facebook.png"></a>
                  </div>
                  <div class="col-md-3">
                      <a target="_blank" title="Share this website on Google Plus" data-toggle="tooltip" href="https://plus.google.com/share?url=http://devleaks.com"><img
                                  width="85px" class="responsive animated flipInX" src="/images/google.png"></a>
                  </div>
                  <div class="col-md-3">
                      <a target="_blank" title="Share this website on LinkedIn" data-toggle="tooltip" href="http://www.linkedin.com/shareArticle?mini=true&url=http://devleaks.com"><img
                                  width="85px" class="responsive animated flipInX" src="/images/linkedin.png"></a>
                  </div>
              </div>
          </td>
      </tr>
  </table>

  <div style="padding-bottom:20px" class="clearfix"></div>

	@if ($links->count() > 0)

    @include('partials.linktable', array('categories' => $categories, 'links' => $links))

  @else
    <p>
    No links available.
    </p>

    <p>
    @if(Auth::check())
    	<a href="{{ URL::Route('link.create') }}">Submit a link</a>
    @else
    	If you were signed in you could add a link to this category. <a href="/auth/login">Sign In</a> or <a href="/auth/register">Create an account</a>.
    @endif
    </p>
  @endif

{!! $links->render() !!}


@endsection