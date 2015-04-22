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
						<div class="medium-9 small-9 columns">

							<% if $Sent %>
							<div data-alert class="alert-box success">
							  Your message to $FirstName has been sent.
							  <a href="#" class="close">&times;</a>
							</div>
							<% end_if %>
							
							<h1>$Title</h1>
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
                                    <img src="{$ThemeDir}/images/stain.png" />
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
							<% if $Tags %>
								<p><% include Tags %></p>
							<% end_if %>
							$Form
							<hr />
							<h2>Contact $FirstName</h2>
							$ContactForm
						</div>
					</div>

				</article>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
				 <div class="side-nav">
				 	<ul class="button-group stack">
					    <% if $currentMemberPage.ID == $ID %>
					        <li><a href="{$Link}edit" class="button info radius">Edit Your Profile</a></li>
					    <% else %>
					        <li><a href="{$getFeedbackLink}" class="button radius" target="_blank">Give Feedback About $FirstName</a></li>
					    <% end_if %>
					</ul>
					<hr>
                    <% include RelatedResources %>
                    <% include SiteAdmin %>
                </div>
			</div>
		
		</div>

	</div>
</div>