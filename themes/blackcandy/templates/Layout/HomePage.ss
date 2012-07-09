Rendered with Homepage.ss
<div id="random">$SearchForm</div>
<br><br>
</article>
<ul id="NewsList">
    <% control LatestNews %>
        <li class="newsDateTitle"><a href="$Link" title="Read more on &quot;{$Title}&quot;">$Title</a></li>
        <li class="newsDateTitle">$Date.Nice</li>
        <li class="newsSummary">$Content.FirstParagraph<a href="$Link" title="Read more on &quot;{$Title}&quot;">Read more &gt;&gt;</a></li>
    <% end_control %>
</ul>

<br><br>

$PageComments

	