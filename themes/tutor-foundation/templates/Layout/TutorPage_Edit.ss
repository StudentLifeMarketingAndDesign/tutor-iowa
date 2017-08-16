<div class="gradient">
    <div class="main typography" role="main">
        <% if $IncludeFormTag %>
            <form $AttributesHTML>
        <% end_if %>

        <div class="row" data-equalizer>

            
            	
            <div class="large-8 columns content" data-equalizer-watch>

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
                        <div class="medium-12 columns">  
                            <% if $Message %>
                            <p id="{$FormName}_error" class="message $MessageType">$Message</p>
                            <% else %>
                            <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
                            <% end_if %>
                           	$EditProfileForm
                        </div>
                    </div>
                </article>
            </div>
            <div class="large-4 columns end" data-equalizer-watch>
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