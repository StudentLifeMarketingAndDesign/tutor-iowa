
<footer class="footer clearfix" role="contentinfo">
	<div class="row">
		<div class="medium-6 large-5 columns">
			<a href="http://www.uiowa.edu" target="_blank" class="hide-print footer-logo"><img src="{$ThemeDir}/images/uiowa-dome.png" alt="The University of Iowa"></a><br><br>
			<a href="http://uc.uiowa.edu/student-success/swat" target="_blank" class="hide-print footer-logo"><img src="{$ThemeDir}/images/footer_swat.png" alt="SWAT"></a><br>
			<% if $SiteConfig.GroupSummary %>
				$SiteConfig.GroupSummary
			<% else %>
				<p>The Division of Student Life fosters student success by creating and promoting inclusive educationally purposeful services and activities within and beyond the classroom.</p>
			<% end_if %>
			<p>$SiteConfig.Address
				<% if $SiteConfig.PhoneNumber %>
					<br />Phone: $SiteConfig.PhoneNumber
				<% end_if %>
				<% if $SiteConfig.EmailAddress %>
					<br />Email: <a href="mailto:{$SiteConfig.EmailAddress}">$SiteConfig.EmailAddress</a>
				<% end_if %>
			</p>
		</div>
		<div class="medium-6 large-4 columns">
			<div class="row">
				<div class="small-6 columns">
					<ul class="border-list">
						<% loop Menu(1) %>
							<li><a href="$Link">$MenuTitle</a></li>
						<% end_loop %>
					</ul>
				</div>
				<div class="small-6 columns">
 					<ul class="border-list">
						<% if $SiteConfig.FacebookLink %>
							<li><a href="$SiteConfig.FacebookLink" target="_blank"><span class="social-icon">F</span> Facebook</a></li>
						<% end_if %>
						<% if $SiteConfig.TwitterLink %>
							<li><a href="$SiteConfig.TwitterLink" target="_blank"><span class="social-icon">t</span> Twitter</a></li>
						<% end_if %>
						<% if $SiteConfig.VimeoLink %>
							<li><a href="$SiteConfig.VimeoLink" target="_blank"><span class="social-icon">v</span> Vimeo</a></li>
						<% end_if %>
						<% if $SiteConfig.YouTubeLink %>
							<li><a href="$SiteConfig.YouTubeLink" target="_blank"><span class="social-icon">y</span> Youtube</a></li>
						<% end_if %>
					</ul>
				</div>
			</div>
		</div>
		<div class="medium-12 large-3 columns">
			<% include FooterRightContent %>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<hr>
			<% include CopyrightPrivacyFooter %>
		</div>
	</div>
</footer>
