<footer class="footer clearfix" role="contentinfo">
	<div class="row logo-container">
		<div class="medium-6 large-5 columns">
			<a href="http://www.uiowa.edu" target="_blank" class="hide-print footer-logo"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7
			" data-src="{$ThemeDir}/images/uiowa-dome.png" alt="The University of Iowa"></a>
			<a href="http://uc.uiowa.edu/student-success/arc" target="_blank" class="hide-print footer-logo arc-logo"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7
			" data-src="{$ThemeDir}/images/footer-arc.png" alt="Academic Resource Center Logo" class="right" /></a>
			<br />
			<p class="group-summary"><a href="http://uc.uiowa.edu/student-success/arc" target="_blank">The Academic Resource Center</a> offers free academic support for undergraduates at the University of Iowa. Supplemental Instruction (SI) and tutoring are offered for a variety of courses throughout the year to help you succeed both in and outside the classroom.  All of the sessions are free.  Our SI leaders and tutors have excelled in their subject area and were recommended by instructors to assist you.</a></p>
			<p>Phone: 319-353-2747<br />
				Email: <a href="mailto:tutoriowa@uiowa.edu">tutoriowa@uiowa.edu</a><br />
			</p>
			<%--<p>$SiteConfig.Address
				<% if $SiteConfig.PhoneNumber %>
				<br />Phone: $SiteConfig.PhoneNumber
				<% end_if %>
				<% if $SiteConfig.EmailAddress %>
				<br />Email: <a href="mailto:{$SiteConfig.EmailAddress}">$SiteConfig.EmailAddress</a>
				<% end_if %>
			</p>--%>

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