<div class="gradient">
	<div class="main typography" role="main">
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				$Breadcrumbs
				<article>
					<div class="row">

						<div class="medium-9 small-12 columns">
			

							<% if $Sent %>
							<div data-alert class="alert-box success">
							  Your message to $Title has been sent.
							  <a href="#" class="close">&times;</a>
							</div>
							<% end_if %>

							<% if $isCertified %>
								<h1>$Title <i class="fa fa-star star" aria-hidden="true"></i> </h1>
							<% else %>
								<h1>$Title</h1>
							<% end_if %>

							<p><% if $isCertified %><a href="private-tutors/certified" class="tag tag--gold"><i class="fa fa-star star star--white" aria-hidden="false"></i> Certified Tutor</a><br /><% end_if %><strong>Member Since: </strong> $Created.NiceUS <br />
							<% if $MeetingPreference %><strong>Meeting Preference: </strong>{$MeetingPreference}<br /><% end_if %>
								<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
								<% if $HourlyRate %><strong>Hourly Rate:</strong> {$HourlyRate}<% end_if %>
							</p>
						</div>
						<div class="medium-3 small-3 columns">
						</div>
					</div>
					<div class="row">
						<div class="medium-12 columns">
							<h2>About</h2>
							<p>$Content</p>

							<%--
							<% if $currentMemberPage.ID == $ID %>
								<% include EditProfileButton %>
							<% end_if %>
							--%>
							<% if $WhatToExpect %>
								<h3> What to Expect: </h3><p>$WhatToExpect</p>
							<% end_if %>
							<% if $HowToPrepare %>
								<h3> How to Prepare: </h3><p>$HowToPrepare</p>
							<% end_if %>
						
							<% if $Tags %>
								<p><% include Tags %></p>
							<% end_if %>
							$Form
							<hr />
							<h2>Contact</h2>

							<% if $CurrentMember %>
								$ContactForm
								<p><a href="{$getFeedbackLink}" data-reveal-id="feedback-form-modal">Give Feedback About $Title</a></p>
							<% else %>
								<a href="$Link("hawkcheck")" class="button button--hawkid">Log in with your HawkID to contact $FirstName</a>
							<% end_if %>
						</div>
					</div>

				</article>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
				 <div class="side-nav">
				 <% if $currentMemberPage.ID == $ID %>
				 	<ul class="button-group stack">
				        <li><a href="{$Link}edit" class="button success radius">Edit Your Profile</a></li>
					</ul>
					<hr>
					<% end_if %>
                    <% include RelatedResources %>
                    <% include SiteAdmin %>
                </div>
			</div>
		
		</div>

	</div>
</div>