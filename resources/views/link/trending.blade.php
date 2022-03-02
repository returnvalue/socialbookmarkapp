@extends('layouts.master')
    
@section('content')

<a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

<table>
    <tr>
        <td><h1 class="animated flipInX">What's Trending</h1></td>
        <td style="vertical-align: bottom; padding: 4px;"><h4 class="text-muted animated lightSpeedIn"><span class="glyphicon glyphicon-link"></span></h4> </td>

    </tr>
</table>

<div style="padding-bottom:20px" class="clearfix"></div>
<span style="font-size: 30px;">
The top <?php echo sizeof($trending) ?> trending resources of the last 30 days -
    <?php echo '<b><a class="text-success"  href="https://twitter.com/intent/tweet?url=http://devleaks.com/trending&amp;text=The+top+'.sizeof($trending). '+trending+resources+of+the+last+30+days+%23webdev+%23webdesign&amp;via=devleakslinks">share this!</a></b>'; ?>
<br>
<?php
for ($i = 0; $i < sizeof($trending); $i++) {
	echo ($i + 1).' =>  '.$trending[$i] . '<br>';
}
?>
</span>

@endsection