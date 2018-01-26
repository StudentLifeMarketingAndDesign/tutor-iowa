<div class="gradient">
	<div class="main typography" role="main">
		<div class="row" data-equalizer>
			<style>
				#profile-cover-photo {
					background-position: center center;
				}
				@media (min-width: 40em) {
					#profile-cover-photo {
						background-position-y: {$ApprovedCoverImage.NiceTop()};
					}
				}
			</style>
			<div class="page-bg" >
			    <% if $approvedCoverImage %>
                     <div id="profile-cover-photo" class="CoverImage FlexEmbed FlexEmbed--3by1" style="background-image:url($ApprovedCoverImage.Link);"></div>
                <% else %>
			    	<%-- <img id="profile-cover-photo" src="http://lorempixel.com/1240/600/" /> --%>
			    <% end_if %>
			</div>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				$Breadcrumbs
				<article>
					<div class="row">
						<% if $approvedProfileImage %>
						<div class="medium-9 small-9 columns">
						<% else %>
						<div class="medium-9 small-12 columns">
						<% end_if %>

							<% if $Sent %>
							<div data-alert class="alert-box success">
							  Your message to $FirstName has been sent.
							  <a href="#" class="close">&times;</a>
							</div>
							<% end_if %>

							<% if $isCertified %>
								<h1>$Title<p class="fa fa-star"></p></h1>
							<% else %>
								<h1>$Title</h1>
							<% end_if %>

							<p><strong>Member Since: </strong> $Created.NiceUS <br />
							<% if $MeetingPreference %><strong>Meeting Preference: </strong>{$MeetingPreference}<br /><% end_if %>
								<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
								<% if $HourlyRate %><strong>Hourly Rate:</strong> {$HourlyRate}<% end_if %>
							</p>
						</div>
						<div class="medium-3 small-3 columns">

							<div class="profile-image">
                                <% if $approvedProfileImage %>
                                    $approvedProfileImage
                                <% else %>
                                   
                                <% end_if %>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="medium-12 columns">
							<h2>About $FirstName</h2>
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
							<h2>Contact $FirstName</h2>

							<% if $CurrentMember %>
								$ContactForm
								<p><a href="{$getFeedbackLink}" data-reveal-id="feedback-form-modal">Give Feedback About $FirstName</a></p>
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