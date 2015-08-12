<div class="gradient">
	<div class="main container typography" role="main">
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
			<div class="col-lg-8  content" data-equalizer-watch>
				<div class="white-cover"></div>
				$Breadcrumbs
				<article>
					<div class="row">
						<% if $approvedProfileImage %>
						<div class="col-md-9 col-sm-9 ">
						<% else %>
						<div class="col-md-9 col-sm-12 ">
						<% end_if %>

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
						<div class="col-md-3 col-sm-3 ">

							<div class="profile-image">
                                <% if $approvedProfileImage %>
                                    $approvedProfileImage
                                <% else %>
                                   
                                <% end_if %>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 ">
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
							<p><a href="{$getFeedbackLink}" data-reveal-id="feedback-form-modal">Give Feedback About $FirstName</a></p>
						</div>
					</div>

				</article>
			</div>
			<div class="col-lg-4  end" data-equalizer-watch>
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