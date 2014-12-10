		<form action="{$BaseHref}home/SearchForm">
					<div class="fieldHolder">
							<label for="textInput" style="display:none;"</label><input type="text" name="Search" class="textInput" placeholder="Find a tutor here!" />
						</div>
							<input type="submit" name="action_results" class="button" value="Find Help"  />
							<div id="search_help">example searches: <a href="{$BaseHref}home/SearchForm?Search=bio&action_results=Find+Tutors">bio</a>,<a href="{$BaseHref}home/SearchForm?Search=chem&action_results=Find+Tutors">chem</a>, <a href="{$BaseHref}home/SearchForm?Search=002:001&action_results=Find+Tutors">002:001</a>, etc.</div>
		</form>
		<div class="clearfix"></div>