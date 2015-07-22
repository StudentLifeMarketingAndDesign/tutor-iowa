<footer class="footer clearfix" role="contentinfo">
	<div class="row logo-container">
		<div class="medium-6 large-5 columns">

			<a href="http://uc.uiowa.edu/retention" target="_blank" class="hide-print footer-logo"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7
			" data-src="{$ThemeDir}/images/asr-logo.png" alt="Academic Support and Retention" /></a>

			<p class="group-summary">
				Academic Support &amp; Retention offers Tutor Iowa as an excellent resource to find academic assistance and mentoring for your University of Iowa courses! If you have any questions or are unable to find what you are looking for contact us via:
				</p>
			<p>Phone: 319-353-2747<br />
				Email: <a href="mailto:tutoriowa@uiowa.edu">tutoriowa@uiowa.edu</a><br />
			</p>

		</div>
		<div class="medium-6 large-4 columns">
			<div class="row">
				<div class="small-6 columns">
					<ul class="border-list">
						<li><a href="{$BaseHref}">Home</a></li>
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