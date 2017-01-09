<?PHP
///////////////////// TEMPLATE Default /////////////////////
$template_active = <<<HTML
<div style="width:100%; margin-bottom:30px;">
<h2>{title}</strong></h2>
<div style="text-align:justify; padding:3px; margin-top:3px; margin-bottom:5px; border-top:1px solid #D3D3D3;">{short-story}</div>

<div style="float: right;">[full-link]Read more[/full-link]</div>

<div><em>Posted on {date}</em></div>
</div>
HTML;


$template_full = <<<HTML
<div style="width:100%; margin-bottom:15px;">
<h2>{title}</strong></h2>

<div style="text-align:justify; padding:3px; margin-top:3px; margin-bottom:5px; border-top:1px solid #D3D3D3;">{full-story}</div>

<div><em>Posted on {date}</em></div>
</div>
<P><A href="{news-page}"><< Back</a></p>
HTML;


$template_comment = <<<HTML

HTML;


$template_form = <<<HTML

HTML;


$template_prev_next = <<<HTML
<p align="center">[prev-link]<< Previous[/prev-link] {pages} [next-link]Next >>[/next-link]</p>
HTML;
$template_comments_prev_next = <<<HTML

HTML;
?>
