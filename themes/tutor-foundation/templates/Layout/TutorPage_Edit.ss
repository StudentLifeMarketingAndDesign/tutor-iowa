<div class="gradient">
    <div class="main typography" role="main">
        <% if $IncludeFormTag %>
            <form $AttributesHTML>
        <% end_if %>

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
                <div class="page-bg">
                <% if $ApprovedCoverImage %>
                    <%-- <div class="page-bg" style="background-image: url('$ApprovedCoverImage.Link');"> --%>
                    <img id="profile-cover-photo-move" class="cover hide" src="$ApprovedCoverImage.Link" style="width: 100%; bottom: 300px; " />
                    <div id="profile-cover-photo" class=" CoverImage FlexEmbed FlexEmbed--3by1" style="background-image:url($ApprovedCoverImage.Link);"></div>
                <% else %>
			    	<%-- <img id="profile-cover-photo" src="http://lorempixel.com/1240/600/" /> --%>
			    <% end_if %>
            </div>
            
            	<%-- <div class="update-cover-photo">$EditProfileCoverForm</div> --%>
            <div class="col-lg-8  content" data-equalizer-watch>

                <div class="white-cover"></div>
                $Breadcrumbs
                <% if $Saved %>
                    <div data-alert class="alert-box success">
                          Your changes have been saved!
                          <a href="#" class="close">&times;</a>
                    </div>
                <% end_if %>
                <article>
                    <div class="row">
                        <div class="col-md-12 ">  
                            <% if $Message %>
                            <p id="{$FormName}_error" class="message $MessageType">$Message</p>
                            <% else %>
                            <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
                            <% end_if %>
                           	$EditProfileForm
                        </div>
                        <%--/* UNCOMMENT TO ENABLE COVER/PROFILE IMAGE EDITING */ -- %>
                        <div class="col-md-4 col-sm-2 ">
            				<ul class="button-group">
                                <li><button id="removeCoverPhoto" class="tiny radius alert">Remove Cover Photo</button></li>
                                <li><button id="repositionCoverPhoto" class="tiny radius secondary">Reposition Cover Photo</button></li>
                            </ul>
                            <div class="profile-image">
                                <% if $approvedProfileImage %>
                                    <div style="margin-bottom: 10px;">$approvedProfileImage</div>
                                    <button class="tiny round" id="removeProfilePhoto">Remove Profile Image</button>
                                <% else %>
                                    <img src="{$ThemeDir}/images/stain.png" />
                                <% end_if %>
                            </div>

                        </div>--%>
                    </div>
                </article>
            </div>
            <div class="col-lg-4  end" data-equalizer-watch>
                <div class="side-nav">
                <ul class="button-group stack"><li><a href="$Link" class="button radius" target="_blank">View Your Profile</a></li></ul>
                </div>
            </div>
            <% if $IncludeFormTag %>
            </form>
            <% end_if %>
        
        </div>

    </div>
</div>