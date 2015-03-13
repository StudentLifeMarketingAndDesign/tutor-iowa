<div class="gradient">
    <div class="main typography" role="main">
        <% if $IncludeFormTag %>
            <form $AttributesHTML>
        <% end_if %>
        <div class="row" data-equalizer>
            <fieldset>
                <div class="page-bg">
                    <% with $Fields.BackgroundImage %>
                        $Title
                    <% end_with %>
                </div>
            </fieldset>
            <div class="large-8 columns content" data-equalizer-watch>

                <div class="white-cover"></div>
                $Breadcrumbs
                <article>
                    <div class="row">
                        <div class="medium-9 small-10 columns">  
                            <% if $Message %>
                            <p id="{$FormName}_error" class="message $MessageType">$Message</p>
                            <% else %>
                            <p id="{$FormName}_error" class="message $MessageType" style="display: none;"></p>
                            <% end_if %>
                            <fieldset>
                                <% if $Legend %><legend>$Legend</legend><% end_if %> 
                                <% loop $Fields %>
                                    $FieldHolder
                                <% end_loop %>
                                <div class="clear"><!-- --></div>
                            </fieldset>
                        </div>
                        <div class="medium-3 small-2 columns">

                            <div class="profile-image">
                                <% if $Image %>
                                    <img src="http://lorempixel.com/500/500/" />
                                <% else %>
                                    <img src="{$ThemeDir}/images/stain.png" />
                                <% end_if %>
                                $EditProfileImageForm
                            </div>

                        </div>
                    </div>
                </article>
            </div>
            <div class="large-4 columns end" data-equalizer-watch>
                <div class="side-nav">
                    <% if $Actions %>
                    <div class="Actions">
                        <% loop $Actions %>
                            $Field
                        <% end_loop %>
                    </div>
                    <% end_if %>
                    <% include RelatedResources %>
                    <% include SiteAdmin %>
                </div>
            </div>
            <% if $IncludeFormTag %>
            </form>
            <% end_if %>
        
        </div>

    </div>
</div>