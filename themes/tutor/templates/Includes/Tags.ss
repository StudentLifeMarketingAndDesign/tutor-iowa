<div id="tags">
		<h2>Tags</h2>
		<p>
		<% loop SplitKeywords %>
			<a href="{$BaseHref}home/SearchForm?Search={$Keyword}&action_results=Find+Tutors">$Keyword</a><% if Last %><% else %>,<% end_if %> 
		<% end_loop %>
		
		</p>
		<div class="clearfix"></div>
		</div>
	