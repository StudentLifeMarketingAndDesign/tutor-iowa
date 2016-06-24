meta.foundation-mq-small{ font-family: '/only screen/'; width: 0em; }
meta.foundation-mq-small-only{ font-family: '/only screen and (max-width: 40em)/'; width: 0em; }
meta.foundation-mq-medium{ font-family: '/only screen and (min-width:40.063em)/'; width: 40.063em; }
meta.foundation-mq-medium-only{ font-family: '/only screen and (min-width:40.063em) and (max-width:64em)/'; width: 40.063em; }
meta.foundation-mq-large{ font-family: '/only screen and (min-width:64.063em)/'; width: 64.063em; }
meta.foundation-mq-large-only{ font-family: '/only screen and (min-width:64.063em) and (max-width:90em)/'; width: 64.063em; }
meta.foundation-mq-xlarge{ font-family: '/only screen and (min-width:90.063em)/'; width: 90.063em; }
meta.foundation-mq-xlarge-only{ font-family: '/only screen and (min-width:90.063em) and (max-width:120em)/'; width: 90.063em; }
meta.foundation-mq-xxlarge{ font-family: '/only screen and (min-width:120.063em)/'; width: 120.063em; }
meta.foundation-data-attribute-namespace{ font-family: false; }
html, body{ height: 100%; }
*{ box-sizing: border-box; }
html, body{ font-size: 100%; }
body{ background-color: rgb(255, 255, 255); color: rgb(34, 34, 34); padding: 0px; margin: 0px; font-family: proxima-nova-alt, Arial, sans-serif; font-weight: normal; font-style: normal; line-height: 1.5; position: relative; cursor: auto; background-position: initial initial; background-repeat: initial initial; }
img{ max-width: 100%; height: auto; }
img{ }
.left{ float: left !important; }
.right{ float: right !important; }
.clearfix::before, .clearfix::after{ content: ' '; display: table; }
.clearfix::after{ clear: both; }
img{ display: inline-block; vertical-align: middle; }
textarea{ height: auto; min-height: 50px; }
.row{ width: 100%; margin: 0px auto; max-width: 77.5rem; }
.row::before, .row::after{ content: ' '; display: table; }
.row::after{ clear: both; }
 .columns{ padding-left: 0.78125rem; padding-right: 0.78125rem; width: 100%; float: left; }
[class*="column"] + [class*="column"]:last-child{ float: right; }
[class*="column"] + [class*="column"].end{ float: left; }
@media only screen{
 .columns{ position: relative; padding-left: 0.78125rem; padding-right: 0.78125rem; float: left; }
}
@media only screen and (min-width: 40.063em){
 .columns{ position: relative; padding-left: 0.78125rem; padding-right: 0.78125rem; float: left; }
}
@media only screen and (min-width: 64.063em){
 .columns{ position: relative; padding-left: 0.78125rem; padding-right: 0.78125rem; float: left; }
.large-3{ width: 25%; }
.large-6{ width: 50%; }
.large-9{ width: 75%; }
.large-12{ width: 100%; }
}
 .button{ border: 0px solid rgb(0, 88, 248); cursor: pointer; font-family: proxima-nova-alt, Arial, sans-serif; font-weight: normal; line-height: normal; margin: 0px 0px 1.25rem; position: relative; text-decoration: none; text-align: center; -webkit-appearance: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; display: inline-block; padding: 0.875rem 1.75rem 0.9375rem; font-size: 1rem; background-color: rgb(55, 126, 255); color: rgb(255, 255, 255); transition: background-color 300ms ease-out; -webkit-transition: background-color 300ms ease-out; }
@media only screen and (min-width: 40.063em){
 .button{ display: inline-block; }
}
form{ margin: 0px 0px 1rem; }
label{ font-size: 0.875rem; color: rgb(77, 77, 77); cursor: pointer; display: block; font-weight: normal; line-height: 1.5; margin-bottom: 0px; }
input[type="text"], input[type="password"], input[type="email"], input[type="search"], textarea{ -webkit-appearance: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; background-color: rgb(255, 255, 255); font-family: inherit; border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.0980392) 0px 1px 2px inset; color: rgba(0, 0, 0, 0.74902); display: block; font-size: 0.875rem; margin: 0px 0px 1rem; padding: 0.5rem; height: 2.3125rem; width: 100%; box-sizing: border-box; transition: all 0.15s linear; -webkit-transition: all 0.15s linear; }
input[type="submit"]{ -webkit-appearance: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; }
textarea[rows]{ height: auto; }
textarea{ max-width: 100%; }
 input[type="checkbox"]{ margin: 0px 0px 1rem; }
fieldset{ border: 1px none rgb(221, 221, 221); padding: 0px; margin: 1.125rem 0px; }
.reveal-modal{ visibility: hidden; display: none; position: absolute; z-index: 1005; width: 100%; top: 0px; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; left: 0px; background-color: rgb(255, 255, 255); padding: 2.0625rem; border: 1px solid rgb(102, 102, 102); box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 10px; }
@media only screen and (max-width: 40em){
.reveal-modal{ min-height: 100vh; }
}
 .reveal-modal .columns{ min-width: 0px; }
.reveal-modal > :first-child{ margin-top: 0px; }
.reveal-modal > :last-child{ margin-bottom: 0px; }
@media only screen and (min-width: 40.063em){
.reveal-modal{ width: 80%; max-width: 77.5rem; left: 0px; right: 0px; margin: 0px auto; }
}
@media only screen and (min-width: 40.063em){
.reveal-modal{ top: 6.25rem; }
}
@media only screen and (min-width: 40.063em){
.reveal-modal.medium{ width: 60%; max-width: 77.5rem; left: 0px; right: 0px; margin: 0px auto; }
}
@media only screen and (min-width: 40.063em){
.reveal-modal.large{ width: 70%; max-width: 77.5rem; left: 0px; right: 0px; margin: 0px auto; }
}
.reveal-modal .close-reveal-modal{ font-size: 2.5rem; line-height: 1; position: absolute; top: 0.625rem; right: 1.375rem; color: rgb(170, 170, 170); font-weight: bold; cursor: pointer; }
.side-nav{ display: block; margin: 0px; padding: 0.625rem 0px; list-style-type: none; list-style-position: outside; font-family: proxima-nova-alt, Arial, sans-serif; }
.side-nav li{ margin: 0px 0px 0.4375rem; font-size: 0.875rem; font-weight: normal; }
.side-nav li a:not(.button){ display: block; color: rgb(55, 126, 255); margin: 0px; padding: 0px; }
meta.foundation-mq-topbar{ font-family: '/only screen and (min-width:64.063em)/'; width: 64.063em; }
.contain-to-grid{ width: 100%; background-color: rgb(68, 68, 68); background-position: initial initial; background-repeat: initial initial; }
.contain-to-grid .top-bar{ margin-bottom: 0px; }
.top-bar{ overflow: hidden; height: 4.375rem; line-height: 4.375rem; position: relative; background-color: rgb(68, 68, 68); margin-bottom: 0px; background-position: initial initial; background-repeat: initial initial; }
.top-bar ul{ margin-bottom: 0px; list-style: none; }
.top-bar .title-area{ position: relative; margin: 0px; }
.top-bar .name{ height: 4.375rem; margin: 0px; font-size: 16px; }
.top-bar .name h1{ line-height: 4.375rem; font-size: 1.0625rem; margin: 0px; }
.top-bar .name h1 a{ font-weight: normal; color: rgb(255, 255, 255); width: 75%; display: block; padding: 0px 1.4583333333rem; }
.top-bar .toggle-topbar{ position: absolute; right: 0px; top: 0px; }
.top-bar .toggle-topbar a{ color: rgb(255, 255, 255); text-transform: uppercase; font-size: 0.8125rem; font-weight: bold; position: relative; display: block; padding: 0px 1.4583333333rem; height: 4.375rem; line-height: 4.375rem; }
.top-bar .toggle-topbar.menu-icon{ top: 50%; margin-top: -16px; }
.top-bar .toggle-topbar.menu-icon a{ height: 34px; line-height: 33px; padding: 0px 3.0208333333rem 0px 1.4583333333rem; color: rgb(255, 255, 255); position: relative; }
.top-bar .toggle-topbar.menu-icon a span::after{ content: ''; position: absolute; display: block; height: 0px; top: 50%; margin-top: -8px; right: 1.4583333333rem; box-shadow: rgb(255, 255, 255) 0px 0px 0px 1px, rgb(255, 255, 255) 0px 7px 0px 1px, rgb(255, 255, 255) 0px 14px 0px 1px; width: 16px; }
.top-bar-section{ left: 0px; position: relative; width: auto; transition: left 300ms ease-out; -webkit-transition: left 300ms ease-out; }
.top-bar-section ul{ padding: 0px; width: 100%; height: auto; display: block; font-size: 16px; margin: 0px; }
.top-bar-section ul li{ background-color: rgb(68, 68, 68); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section ul li > a{ display: block; width: 100%; color: rgb(255, 255, 255); padding: 12px 0px 12px 1.4583333333rem; font-family: proxima-nova-alt-condensed, 'Arial Narrow', sans-serif; font-size: 1.375rem; font-weight: normal; text-transform: uppercase; }
.top-bar-section .has-dropdown{ position: relative; }
.top-bar-section .has-dropdown > a::after{ content: ''; display: block; width: 0px; height: 0px; border-style: inset inset inset solid; border-width: 5px; border-color: transparent transparent transparent rgba(255, 255, 255, 0.4); margin-right: 1.4583333333rem; margin-top: -4.5px; position: absolute; top: 50%; right: 0px; }
.top-bar-section .dropdown{ padding: 0px; left: 100%; top: 0px; z-index: 99; display: block; height: 1px; width: 1px; overflow: hidden; clip: rect(1px 1px 1px 1px); position: absolute !important; }
.top-bar-section .dropdown li{ width: 100%; height: auto; }
.top-bar-section .dropdown li a{ font-weight: normal; padding: 8px 1.4583333333rem; }
.top-bar-section .dropdown li a.parent-link{ font-weight: normal; }
.top-bar-section .dropdown li.title h5, .top-bar-section .dropdown li.parent-link{ margin-bottom: 0px; margin-top: 0px; font-size: 0.875rem; }
.top-bar-section .dropdown li.title h5 a, .top-bar-section .dropdown li.parent-link a{ color: rgb(255, 255, 255); display: block; }
.top-bar-section .dropdown label{ padding: 8px 1.4583333333rem 2px; margin-bottom: 0px; text-transform: uppercase; color: rgb(119, 119, 119); font-weight: bold; font-size: 0.625rem; }
.js-generated{ display: block; }
@media only screen and (min-width: 64.063em){
.top-bar{ background-color: rgb(68, 68, 68); overflow: visible; background-position: initial initial; background-repeat: initial initial; }
.top-bar::before, .top-bar::after{ content: ' '; display: table; }
.top-bar::after{ clear: both; }
.top-bar .toggle-topbar{ display: none; }
.top-bar .title-area{ float: left; }
.top-bar .name h1 a{ width: auto; }
.contain-to-grid .top-bar{ max-width: 77.5rem; margin: 0px auto; }
.top-bar-section{ transition: none 0ms 0ms; -webkit-transition: none 0ms 0ms; left: 0px !important; }
.top-bar-section ul{ width: auto; display: inline; height: auto !important; }
.top-bar-section ul li{ float: left; }
.top-bar-section ul li .js-generated{ display: none; }
.top-bar-section li:not(.has-form) a:not(.button){ padding: 0px 1.4583333333rem; line-height: 4.375rem; background-color: rgb(68, 68, 68); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section .has-dropdown > a{ padding-right: 2.7083333333rem !important; }
.top-bar-section .has-dropdown > a::after{ content: ''; display: block; width: 0px; height: 0px; border-style: solid inset inset; border-width: 5px; border-color: rgba(255, 255, 255, 0.4) transparent transparent; margin-top: -2.5px; top: 2.1875rem; }
.top-bar-section .has-dropdown .dropdown li.has-dropdown > a::after{ border: none; content: »; top: 1rem; margin-top: -1px; right: 5px; line-height: 1.2; }
.top-bar-section .dropdown{ left: 0px; top: auto; background-color: transparent; min-width: 100%; background-position: initial initial; background-repeat: initial initial; }
.top-bar-section .dropdown li a{ color: rgb(255, 255, 255); line-height: 4.375rem; white-space: nowrap; padding: 12px 1.4583333333rem; background-color: rgb(51, 51, 51); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button){ color: rgb(255, 255, 255); background-color: rgb(51, 51, 51); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section .dropdown li label{ white-space: nowrap; background-color: rgb(51, 51, 51); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section .dropdown li .dropdown{ left: 100%; top: 0px; }
.top-bar-section .left li .dropdown{ right: auto; left: 0px; }
.top-bar-section .left li .dropdown li .dropdown{ left: 100%; }
}
div, ul, li, h1, h2, h3, h4, h5, form, p{ margin: 0px; padding: 0px; }
a{ color: rgb(55, 126, 255); text-decoration: none; line-height: inherit; }
a img{ border: none; }
p{ font-family: inherit; font-weight: normal; font-size: 1rem; line-height: 1.6; margin-bottom: 1.25rem; text-rendering: optimizelegibility; }
h1, h2, h3, h4, h5{ font-family: proxima-nova-alt-condensed, 'Arial Narrow', sans-serif; font-weight: normal; font-style: normal; color: rgb(34, 34, 34); text-rendering: optimizelegibility; margin-top: 0.2rem; margin-bottom: 0.5rem; line-height: 1.1; }
h1{ font-size: 2.125rem; }
h2{ font-size: 1.6875rem; }
h3{ font-size: 1.375rem; }
h4{ font-size: 1.125rem; }
h5{ font-size: 1.125rem; }
strong{ font-weight: bold; line-height: inherit; }
ul{ font-size: 1rem; line-height: 1.6; margin-bottom: 1.25rem; list-style-position: outside; font-family: inherit; }
ul{ margin-left: 1.1rem; }
ul li ul{ margin-left: 1.25rem; margin-bottom: 0px; }
@media only screen and (min-width: 40.063em){
h1, h2, h3, h4, h5{ line-height: 1.1; }
h1{ font-size: 2.75rem; }
h2{ font-size: 2.3125rem; }
h3{ font-size: 1.6875rem; }
h4{ font-size: 1.4375rem; }
h5{ font-size: 1.125rem; }
}
@media only screen{
 .hide-for-large-up{ display: inherit !important; }
}
@media only screen and (min-width: 40.063em){
 .hide-for-large-up{ display: inherit !important; }
}
@media only screen and (min-width: 64.063em){
 .hide-for-large-up{ display: none !important; }
}
@media only screen and (min-width: 90.063em){
 .hide-for-large-up{ display: none !important; }
}
@media only screen and (min-width: 120.063em){
 .hide-for-large-up{ display: none !important; }
}
@media print{
*{ background-color: transparent !important; color: rgb(0, 0, 0) !important; box-shadow: none !important; text-shadow: none !important; background-position: initial initial !important; background-repeat: initial initial !important; }
a{ text-decoration: underline; }
a[href]::after{ content: ' (', attr(href), ')'; }
 a[href^="javascript:"]::after{ content: ''; }
 img{ page-break-inside: avoid; }
img{ max-width: 100% !important; }
p, h2, h3{ orphans: 3; widows: 3; }
h2, h3{ page-break-after: avoid; }
}
.banner{ text-transform: uppercase; font-size: 1rem; background-color: rgb(238, 238, 238); color: rgb(34, 34, 34); position: relative; padding: 3px; background-position: initial initial; background-repeat: initial initial; }
input[type="submit"]{ border: 0px solid rgb(0, 88, 248); cursor: pointer; font-family: proxima-nova-alt, Arial, sans-serif; font-weight: normal; line-height: normal; margin: 0px 0px 1.25rem; position: relative; text-decoration: none; text-align: center; -webkit-appearance: none; display: inline-block; padding: 0.875rem 1.75rem 0.9375rem; font-size: 1rem; color: rgb(255, 255, 255); border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; transition: all 1s ease-out; -webkit-transition: all 1s ease-out; background-image: linear-gradient(45deg, rgb(55, 126, 255) 0%, rgb(19, 103, 255) 50%, rgb(40, 116, 255) 50.01%, rgb(157, 192, 255)); background-position: initial initial; background-repeat: initial initial; }
.button{ transition: all 1s ease-out; -webkit-transition: all 1s ease-out; background-image: linear-gradient(45deg, rgb(55, 126, 255) 0%, rgb(19, 103, 255) 50%, rgb(40, 116, 255) 50.01%, rgb(157, 192, 255)); background-position: initial initial; background-repeat: initial initial; }
.tag{ border: 0px solid rgb(236, 205, 130); cursor: pointer; font-family: proxima-nova-alt, Arial, sans-serif; font-weight: normal; line-height: normal; margin: 0px 0px 3px; position: relative; text-decoration: none; text-align: center; -webkit-appearance: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; display: inline-block; padding: 0.25rem 0.5rem 0.3125rem; background-color: rgb(248, 236, 209); color: rgb(51, 51, 51); transition: background-color 300ms ease-out; -webkit-transition: background-color 300ms ease-out; text-transform: uppercase; font-size: 0.6875rem; }
.contain-to-grid{ background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68)); background-position: initial initial; background-repeat: initial initial; }
@media only screen and (min-width: 64.063em){
.top-bar-section .has-dropdown .dropdown li.has-dropdown > a::after{ border: none; content: »; top: 1rem; margin-top: 5px; right: 5px; line-height: 1.2; }
}
.top-bar{ background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68)); background-position: initial initial; background-repeat: initial initial; }
.top-bar h1{ max-width: 18.75rem; }
@media only screen and (min-width: 64.063em){
.top-bar h1{ max-width: 18.75rem; }
}
.top-bar .name h1 a{ padding-left: 0.78125rem; }
@media only screen and (min-width: 64.063em){
.top-bar .top-bar-section .has-dropdown .dropdown li.has-dropdown > a::after{ border: none; content: »; top: 1rem; margin-top: 5px; right: 5px; line-height: 1.2; }
}
.top-bar .top-bar-section ul li.log-in:not(.has-form) a:not(.button){ background-color: rgb(55, 126, 255); background-position: initial initial; background-repeat: initial initial; }
.top-bar .top-bar-section ul li.register:not(.has-form) a:not(.button){ background-color: rgb(55, 190, 94); background-position: initial initial; background-repeat: initial initial; }
@media only screen and (min-width: 64.063em){
.top-bar .top-bar-section ul li{ background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68)); background-position: initial initial; background-repeat: initial initial; }
}
@media only screen and (min-width: 64.063em){
.top-bar .top-bar-section li:not(.has-form) a:not(.button){ background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68)); background-position: initial initial; background-repeat: initial initial; }
}
.top-bar .top-bar-section .right{ padding-right: 0px; }
@media only screen and (min-width: 64.063em){
.top-bar .top-bar-section .right{ padding-right: 0.78125rem; }
}
.top-bar .title.back a{ background-color: rgb(102, 102, 102); background-position: initial initial; background-repeat: initial initial; }
.card{ padding: 0.78125rem 0px; }
@media only screen and (min-width: 64.063em){
.card{ padding: 0px; }
}
.card p{ margin-bottom: 0px; }
.card h4{ -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out; color: rgb(4, 93, 255); }
.small li.card{ padding: 10px 0px; }
.resource-card-list{ list-style-type: none; display: block; padding: 0px; margin: 0px; }
.resource-card-list::before, .resource-card-list::after{ content: ' '; display: table; }
.resource-card-list::after{ clear: both; }
.resource-card-list > li{ display: block; height: auto; float: left; padding: 0px 0.78125rem 1.5625rem; }
.resource-card-list > li{ width: 100%; padding: 0px 0.78125rem 1.5625rem; list-style: none; }
.resource-card-list > li:nth-of-type(1n){ clear: none; }
.resource-card-list > li:nth-of-type(1n+1){ clear: both; }
.resource-card-list > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
@media only screen and (min-width: 64.063em){
.resource-card-list{ display: block; padding: 0px; margin: 0px; }
.resource-card-list::before, .resource-card-list::after{ content: ' '; display: table; }
.resource-card-list::after{ clear: both; }
.resource-card-list > li{ display: block; height: auto; float: left; padding: 0px 0.78125rem 1.5625rem; }
.resource-card-list > li{ width: 50%; padding: 0px 0.78125rem 1.5625rem; list-style: none; }
.resource-card-list > li:nth-of-type(1n){ clear: none; }
.resource-card-list > li:nth-of-type(2n+1){ clear: both; }
.resource-card-list > li:nth-of-type(2n+1){ padding-left: 0rem; padding-right: 0.78125rem; }
.resource-card-list > li:nth-of-type(2n){ padding-left: 0.78125rem; padding-right: 0rem; }
}
.resource-card-list .resource-card{ margin-bottom: 0px; }
.resource-card-list li{ list-style-type: none; }
.resource-card-list li a{ color: rgb(34, 34, 34); }
.side-nav{ padding-top: 0px; }
@media only screen and (min-width: 64.063em){
.side-nav{ background-color: rgb(244, 244, 244); padding: 0.78125rem 0px 0.78125rem 0.78125rem; }
}
.side-nav li{ border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(204, 204, 204); }
.side-nav h3{ text-transform: uppercase; font-size: 1rem; background-color: rgb(238, 238, 238); color: rgb(34, 34, 34); position: relative; padding: 3px; background-position: initial initial; background-repeat: initial initial; }
.side-nav .announcements.small .announcement-card{ padding: 10px 0px; }
.announcements{ display: block; padding: 0px; margin: 0px; }
.announcements::before, .announcements::after{ content: ' '; display: table; }
.announcements::after{ clear: both; }
.announcements > li{ display: block; height: auto; float: left; padding: 0px 0.78125rem 1.5625rem; }
.announcements > li{ width: 100%; padding: 0px 0.78125rem 1.5625rem; list-style: none; }
.announcements > li:nth-of-type(1n){ clear: none; }
.announcements > li:nth-of-type(1n+1){ clear: both; }
.announcements > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
@media only screen and (min-width: 64.063em){
.announcements{ display: block; padding: 0px; margin: 0px; }
.announcements::before, .announcements::after{ content: ' '; display: table; }
.announcements::after{ clear: both; }
.announcements > li{ display: block; height: auto; float: left; padding: 0px 0.78125rem 1.5625rem; }
.announcements > li{ width: 50%; padding: 0px 0.78125rem 1.5625rem; list-style: none; }
.announcements > li:nth-of-type(1n){ clear: none; }
.announcements > li:nth-of-type(2n+1){ clear: both; }
.announcements > li:nth-of-type(2n+1){ padding-left: 0rem; padding-right: 0.78125rem; }
}
.announcements.small{ display: block; padding: 0px; margin: 0px; }
.announcements.small::before, .announcements.small::after{ content: ' '; display: table; }
.announcements.small::after{ clear: both; }
.announcements.small > li{ display: block; height: auto; float: left; padding: 0px 0.78125rem 1.5625rem; }
.announcements.small > li{ width: 100%; padding: 0px 0.78125rem 1.5625rem; list-style: none; }
.announcements.small > li:nth-of-type(1n){ clear: none; }
.announcements.small > li:nth-of-type(1n+1){ clear: both; }
.announcements.small > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
.announcements .announcement-card a{ color: rgb(0, 0, 0); display: block; }
.division-topbar input[type="submit"]{ -webkit-appearance: button; cursor: pointer; }
.division-topbar input[type="search"]{ -webkit-appearance: textfield; box-sizing: border-box; }
.division-topbar *, .division-topbar ::before, .division-topbar ::after{ box-sizing: border-box; }
.division-topbar img{ vertical-align: middle; height: auto; max-width: 100%; }
.division-topbar a{ text-decoration: none; }
.clearfix::before, .clearfix::after{ content: ' '; display: table; }
.clearfix::after{ clear: both; }
.clearfix{ }
.division-topbar{ background-color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; line-height: 1.5; position: relative; background-position: initial initial; background-repeat: initial initial; }
.uiowa{ line-height: 42px; }
.uiowa{ display: block; float: left; opacity: 0.7; width: 177px; }
@media only screen and (min-width: 64.063em){
.uiowa{ margin-left: 0px; }
}
 .search-toggle{ border-left-width: 1px; border-left-style: solid; border-left-color: rgb(0, 0, 0); -webkit-box-shadow: rgba(255, 255, 255, 0.0980392) -1px 0px 0px; box-shadow: rgba(255, 255, 255, 0.0980392) -1px 0px 0px; display: block; float: right; height: 40px; text-decoration: none; width: 40px; }
@media only screen and (min-width: 64.063em){
 .search-toggle{ border-left-style: none; -webkit-box-shadow: none; box-shadow: none; }
}
.search-toggle{ background-image: url(../../../division-bar/images/division-bar/magnifier-18.png); background-size: 52%; padding: 10px; text-indent: -999em; background-position: 10px 10px; background-repeat: no-repeat no-repeat; }
@media only screen and (min-width: 64.063em){
.search-toggle{ display: none; }
}
.division-search{ border-top-width: 1px; border-top-style: solid; border-top-color: rgb(0, 0, 0); -webkit-box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 0px inset; box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 0px inset; display: none; position: relative; left: 0px; bottom: 0px; }
.division-search form{ padding: 10px; }
@media only screen and (min-width: 64.063em){
.division-search{ border-top-style: none; position: absolute; right: 13px; bottom: 7px; left: auto; -webkit-box-shadow: none; box-shadow: none; display: block !important; }
.division-search form{ padding: 0px; }
}
.division-search label{ border: 0px; clip: rect(0px 0px 0px 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; width: 1px; }
.division-search form{ margin: 0px; position: relative; }
.division-search input[type="search"].division-search-input{ -webkit-appearance: textfield; box-sizing: border-box; background-color: rgb(255, 255, 255); border: 1px solid rgb(0, 0, 0); color: rgb(34, 34, 34); display: inline-block; font-size: 13px; font-family: arial, verdana, sans-serif; line-height: normal; padding: 5px 0px 4px 5px; position: relative; vertical-align: middle; width: 100%; margin: 4px 0px 0px; height: auto; border-top-left-radius: 15px; border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-bottom-left-radius: 15px; transition: width 0.2s ease, background-color 0.2s ease; -webkit-transition: width 0.2s ease, background-color 0.2s ease; background-position: initial initial; background-repeat: initial initial; }
@media only screen and (min-width: 64.063em){
.division-search input[type="search"].division-search-input{ width: 120px; }
}
.division-search .division-search-btn{ border: 0px; clip: rect(0px 0px 0px 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; width: 1px; }
.main .content{ min-height: 320px; }
@media only screen and (min-width: 64.063em){
.main .content{ min-height: 600px; }
}
.gradient{ background-color: rgb(255, 255, 255); position: relative; background-position: initial initial; background-repeat: initial initial; }
@media only screen and (min-width: 64.063em){
.gradient{ background-image: linear-gradient(to right, rgb(255, 255, 255) 60%, rgb(244, 244, 244) 40%); background-position: initial initial; background-repeat: initial initial; }
}
.white-cover{ display: none; }
@media only screen and (min-width: 64.063em){
.white-cover{ background-color: rgb(255, 255, 255); border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); display: block; position: absolute; width: 100%; height: 100%; }
}
article{ position: relative; z-index: 1000; }
form label span{ color: rgb(240, 65, 36); padding-right: 3px; }
#feedback-btn{ display: none; }
@media only screen and (min-width: 64.063em){
#feedback-btn{ display: block; background-image: url(../images/feedback-btn.gif); position: fixed; width: 40px; height: 120px; top: 45%; right: 0px; z-index: 101; background-size: cover; background-position: 50% 100%; background-repeat: initial initial; }
}
.visuallyhidden{ border: 0px; clip: rect(0px 0px 0px 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; width: 1px; }