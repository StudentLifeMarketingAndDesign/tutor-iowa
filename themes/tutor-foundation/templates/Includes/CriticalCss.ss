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
body{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 255); color: rgb(34, 34, 34); padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: proxima-nova-alt, sans-serif; font-weight: normal; font-style: normal; line-height: 1.5; position: relative; cursor: auto; background-position: initial initial; background-repeat: initial initial; }
img{ max-width: 100%; height: auto; }
img{ }
.left{ float: left !important; }
.right{ float: right !important; }
img{ display: inline-block; vertical-align: middle; }
.row{ width: 100%; margin-left: auto; margin-right: auto; margin-top: 0px; margin-bottom: 0px; max-width: 77.5rem; }
.row::before, .row::after{ content: ' '; display: table; }
.row::after{ clear: both; }
.row .row{ width: auto; margin-left: -0.78125rem; margin-right: -0.78125rem; margin-top: 0px; margin-bottom: 0px; max-width: none; }
.row .row::before, .row .row::after{ content: ' '; display: table; }
.row .row::after{ clear: both; }
 .columns{ padding-left: 0.78125rem; padding-right: 0.78125rem; width: 100%; float: left; }
[class*="column"] + [class*="column"]:last-child{ float: right; }
@media only screen{
 .columns{ position: relative; padding-left: 0.78125rem; padding-right: 0.78125rem; float: left; }
.small-3{ width: 25%; }
.small-6{ width: 50%; }
.small-9{ width: 75%; }
.small-12{ width: 100%; }
}
@media only screen and (min-width: 40.063em){
 .columns{ position: relative; padding-left: 0.78125rem; padding-right: 0.78125rem; float: left; }
.medium-6{ width: 50%; }
.medium-12{ width: 100%; }
.pull-3{ position: relative; right: 25%; left: auto; }
.push-9{ position: relative; left: 75%; right: auto; }
}
@media only screen and (min-width: 64.063em){
 .columns{ position: relative; padding-left: 0.78125rem; padding-right: 0.78125rem; float: left; }
.large-3{ width: 25%; }
.large-4{ width: 33.3333333333%; }
.large-5{ width: 41.6666666667%; }
.large-6{ width: 50%; }
.large-8{ width: 66.6666666667%; }
.large-12{ width: 100%; }
.pull-3{ position: relative; right: 25%; left: auto; }
.push-9{ position: relative; left: 75%; right: auto; }
}
 .button{ border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; cursor: pointer; font-family: proxima-nova-alt, sans-serif; font-weight: normal; line-height: normal; margin-top: 0px; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; position: relative; text-decoration: none; text-align: center; -webkit-appearance: none; border-top-left-radius: 0px 0px; border-top-right-radius: 0px 0px; border-bottom-right-radius: 0px 0px; border-bottom-left-radius: 0px 0px; display: inline-block; padding-top: 0.875rem; padding-right: 1.75rem; padding-bottom: 0.9375rem; padding-left: 1.75rem; font-size: 1rem; background-color: rgb(55, 126, 255); border-top-color: rgb(0, 88, 248); border-right-color: rgb(0, 88, 248); border-bottom-color: rgb(0, 88, 248); border-left-color: rgb(0, 88, 248); color: rgb(255, 255, 255); }
 .button.success{ background-color: rgb(55, 190, 94); border-top-color: rgb(44, 152, 75); border-right-color: rgb(44, 152, 75); border-bottom-color: rgb(44, 152, 75); border-left-color: rgb(44, 152, 75); color: rgb(255, 255, 255); }
 .button.radius{ border-top-left-radius: 2px 2px; border-top-right-radius: 2px 2px; border-bottom-right-radius: 2px 2px; border-bottom-left-radius: 2px 2px; }
@media only screen and (min-width: 40.063em){
 .button{ display: inline-block; }
}
form{ margin-top: 0px; margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; }
label{ font-size: 0.875rem; color: rgb(77, 77, 77); cursor: pointer; display: block; font-weight: normal; line-height: 1.5; margin-bottom: 0px; }
label.right{ float: none !important; text-align: right; }
input[type="text"], input[type="password"]{ -webkit-appearance: none; border-top-left-radius: 0px 0px; border-top-right-radius: 0px 0px; border-bottom-right-radius: 0px 0px; border-bottom-left-radius: 0px 0px; background-color: rgb(255, 255, 255); font-family: inherit; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.0976562) 0px 1px 2px inset; color: rgba(0, 0, 0, 0.746094); display: block; font-size: 0.875rem; margin-top: 0px; margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; padding-top: 0.5rem; padding-right: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; height: 2.3125rem; width: 100%; box-sizing: border-box; }
input[type="submit"]{ -webkit-appearance: none; border-top-left-radius: 0px 0px; border-top-right-radius: 0px 0px; border-bottom-right-radius: 0px 0px; border-bottom-left-radius: 0px 0px; }
 input[type="checkbox"]{ margin-top: 0px; margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; }
input[type="checkbox"] + label{ display: inline-block; margin-left: 0.5rem; margin-right: 1rem; margin-bottom: 0px; vertical-align: baseline; }
fieldset{ border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-top-color: rgb(221, 221, 221); border-right-color: rgb(221, 221, 221); border-bottom-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 1.125rem; margin-right: 0px; margin-bottom: 1.125rem; margin-left: 0px; }
.panel{ border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-color: rgb(216, 216, 216); border-right-color: rgb(216, 216, 216); border-bottom-color: rgb(216, 216, 216); border-left-color: rgb(216, 216, 216); margin-bottom: 1.25rem; padding-top: 1.25rem; padding-right: 1.25rem; padding-bottom: 1.25rem; padding-left: 1.25rem; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(242, 242, 242); color: rgb(51, 51, 51); background-position: initial initial; background-repeat: initial initial; }
.panel > :first-child{ margin-top: 0px; }
.panel > :last-child{ margin-bottom: 0px; }
 .panel h2, .panel h3, .panel p{ color: rgb(51, 51, 51); }
 .panel h2, .panel h3{ line-height: 1; margin-bottom: 0.625rem; }
.reveal-modal{ visibility: hidden; display: none; position: absolute; z-index: 1005; top: 0px; border-top-left-radius: 2px 2px; border-top-right-radius: 2px 2px; border-bottom-right-radius: 2px 2px; border-bottom-left-radius: 2px 2px; left: 0px; background-color: rgb(255, 255, 255); border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-color: rgb(102, 102, 102); border-right-color: rgb(102, 102, 102); border-bottom-color: rgb(102, 102, 102); border-left-color: rgb(102, 102, 102); box-shadow: rgba(0, 0, 0, 0.398438) 0px 0px 10px; padding-top: 2.0625rem; padding-right: 2.0625rem; padding-bottom: 2.0625rem; padding-left: 2.0625rem; }
@media only screen and (max-width: 40em){
.reveal-modal{ }
}
 .reveal-modal .columns{ min-width: 0px; }
.reveal-modal > :first-child{ margin-top: 0px; }
.reveal-modal > :last-child{ margin-bottom: 0px; }
@media only screen and (min-width: 40.063em){
.reveal-modal{ width: 80%; max-width: 77.5rem; left: 0px; right: 0px; margin-top: 0px; margin-right: auto; margin-bottom: 0px; margin-left: auto; }
}
@media only screen and (min-width: 40.063em){
.reveal-modal{ top: 6.25rem; }
}
@media only screen and (min-width: 40.063em){
.reveal-modal.large{ width: 70%; max-width: 77.5rem; left: 0px; right: 0px; margin-top: 0px; margin-right: auto; margin-bottom: 0px; margin-left: auto; }
}
.reveal-modal .close-reveal-modal{ font-size: 2.5rem; line-height: 1; position: absolute; top: 0.625rem; right: 1.375rem; color: rgb(170, 170, 170); font-weight: bold; cursor: pointer; }
@media print{
 .reveal-modal{ display: none; background-image: initial !important; background-attachment: initial !important; background-origin: initial !important; background-clip: initial !important; background-color: rgb(255, 255, 255) !important; background-position: initial initial !important; background-repeat: initial initial !important; }
}
.side-nav{ display: block; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0.875rem; padding-right: 0px; padding-bottom: 0.875rem; padding-left: 0px; list-style-type: none; list-style-position: outside; font-family: proxima-nova-alt, sans-serif; }
.side-nav li{ margin-top: 0px; margin-right: 0px; margin-bottom: 0.4375rem; margin-left: 0px; font-size: 0.875rem; font-weight: normal; }
.side-nav li a:not(.button){ display: block; color: rgb(55, 126, 255); margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
meta.foundation-mq-topbar{ font-family: '/only screen and (min-width:64.063em)/'; width: 64.063em; }
.contain-to-grid{ width: 100%; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(68, 68, 68); background-position: initial initial; background-repeat: initial initial; }
.contain-to-grid .top-bar{ margin-bottom: 0px; }
.top-bar{ overflow-x: hidden; overflow-y: hidden; height: 4.375rem; line-height: 4.375rem; position: relative; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(68, 68, 68); margin-bottom: 0px; background-position: initial initial; background-repeat: initial initial; }
.top-bar ul{ margin-bottom: 0px; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.top-bar .row{ max-width: none; }
.top-bar form, .top-bar input{ margin-bottom: 0px; }
.top-bar input{ height: 1.75rem; padding-top: 0.35rem; padding-bottom: 0.35rem; font-size: 0.3rem; }
.top-bar .button{ padding-top: 0.4125rem; padding-bottom: 0.4125rem; margin-bottom: 0px; font-size: 0.3rem; }
@media only screen and (max-width: 40em){
.top-bar .button{ position: relative; top: -1px; }
}
.top-bar .title-area{ position: relative; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.top-bar .name{ height: 4.375rem; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 16px; }
.top-bar .name h1{ line-height: 4.375rem; font-size: 1.0625rem; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.top-bar .name h1 a{ font-weight: normal; color: rgb(255, 255, 255); width: 75%; display: block; padding-top: 0px; padding-right: 1.4583333333rem; padding-bottom: 0px; padding-left: 1.4583333333rem; }
.top-bar .toggle-topbar{ position: absolute; right: 0px; top: 0px; }
.top-bar .toggle-topbar a{ color: rgb(255, 255, 255); text-transform: uppercase; font-size: 0.8125rem; font-weight: bold; position: relative; display: block; padding-top: 0px; padding-right: 1.4583333333rem; padding-bottom: 0px; padding-left: 1.4583333333rem; height: 4.375rem; line-height: 4.375rem; }
.top-bar .toggle-topbar.menu-icon{ top: 50%; margin-top: -16px; }
.top-bar .toggle-topbar.menu-icon a{ height: 34px; line-height: 33px; padding-top: 0px; padding-right: 3.0208333333rem; padding-bottom: 0px; padding-left: 1.4583333333rem; color: white; position: relative; }
.top-bar .toggle-topbar.menu-icon a span::after{ content: ''; position: absolute; display: block; height: 0px; top: 50%; margin-top: -8px; right: 1.4583333333rem; box-shadow: white 0px 0px 0px 1px, white 0px 7px 0px 1px, white 0px 14px 0px 1px; width: 16px; }
.top-bar-section{ left: 0px; position: relative; width: auto; }
.top-bar-section ul{ padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; width: 100%; height: auto; display: block; font-size: 16px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.top-bar-section ul li{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(68, 68, 68); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section ul li > a{ display: block; width: 100%; color: rgb(255, 255, 255); padding-top: 12px; padding-right: 0px; padding-bottom: 12px; padding-left: 1.4583333333rem; font-family: proxima-nova-alt-condensed, sans-serif; font-size: 1.375rem; font-weight: normal; text-transform: uppercase; }
.top-bar-section ul li > a.button{ font-size: 1.375rem; padding-right: 1.4583333333rem; padding-left: 1.4583333333rem; background-color: rgb(55, 126, 255); border-top-color: rgb(0, 88, 248); border-right-color: rgb(0, 88, 248); border-bottom-color: rgb(0, 88, 248); border-left-color: rgb(0, 88, 248); color: rgb(255, 255, 255); }
.top-bar-section ul li > a.button.success{ background-color: rgb(55, 190, 94); border-top-color: rgb(44, 152, 75); border-right-color: rgb(44, 152, 75); border-bottom-color: rgb(44, 152, 75); border-left-color: rgb(44, 152, 75); color: rgb(255, 255, 255); }
.top-bar-section .has-form{ padding-top: 1.4583333333rem; padding-right: 1.4583333333rem; padding-bottom: 1.4583333333rem; padding-left: 1.4583333333rem; }
@media only screen and (min-width: 64.063em){
.top-bar{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(68, 68, 68); overflow-x: visible; overflow-y: visible; background-position: initial initial; background-repeat: initial initial; }
.top-bar::before, .top-bar::after{ content: ' '; display: table; }
.top-bar::after{ clear: both; }
.top-bar .toggle-topbar{ display: none; }
.top-bar .title-area{ float: left; }
.top-bar .name h1 a{ width: auto; }
.top-bar input, .top-bar .button{ font-size: 0.875rem; position: relative; height: 1.75rem; top: 1.3125rem; }
.contain-to-grid .top-bar{ max-width: 77.5rem; margin-top: 0px; margin-right: auto; margin-left: auto; margin-bottom: 0px; }
.top-bar-section{ left: 0px !important; }
.top-bar-section ul{ width: auto; height: auto !important; display: inline; }
.top-bar-section ul li{ float: left; }
.top-bar-section li:not(.has-form) a:not(.button){ padding-top: 0px; padding-right: 1.4583333333rem; padding-bottom: 0px; padding-left: 1.4583333333rem; line-height: 4.375rem; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(68, 68, 68); background-position: initial initial; background-repeat: initial initial; }
.top-bar-section .has-form{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(68, 68, 68); padding-top: 0px; padding-right: 1.4583333333rem; padding-bottom: 0px; padding-left: 1.4583333333rem; height: 4.375rem; background-position: initial initial; background-repeat: initial initial; }
}
div, ul, li, h1, h2, h3, h4, form, p{ margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
a{ color: rgb(55, 126, 255); text-decoration: none; line-height: inherit; }
a img{ border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; }
p{ font-family: inherit; font-weight: normal; font-size: 1rem; line-height: 1.6; margin-bottom: 1.25rem; text-rendering: optimizelegibility; }
h1, h2, h3, h4{ font-family: proxima-nova-alt-condensed, sans-serif; font-weight: normal; font-style: normal; color: rgb(34, 34, 34); text-rendering: optimizelegibility; margin-top: 0.2rem; margin-bottom: 0.5rem; line-height: 1.1; }
h1{ font-size: 2.125rem; }
h2{ font-size: 1.6875rem; }
h3{ font-size: 1.375rem; }
h4{ font-size: 1.125rem; }
hr{ border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-right-color: rgb(221, 221, 221); border-bottom-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); border-width: initial; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; clear: both; margin-top: 1.25rem; margin-right: 0px; margin-bottom: 1.1875rem; margin-left: 0px; height: 0px; }
strong{ font-weight: bold; line-height: inherit; }
ul{ font-size: 1rem; line-height: 1.6; margin-bottom: 1.25rem; list-style-position: outside; font-family: inherit; }
ul{ margin-left: 1.1rem; }
@media only screen and (min-width: 40.063em){
h1, h2, h3, h4{ line-height: 1.1; }
h1{ font-size: 2.75rem; }
h2{ font-size: 2.3125rem; }
h3{ font-size: 1.6875rem; }
h4{ font-size: 1.4375rem; }
}
@media print{
*{ background-image: initial !important; background-attachment: initial !important; background-origin: initial !important; background-clip: initial !important; background-color: transparent !important; color: rgb(0, 0, 0) !important; box-shadow: none !important; text-shadow: none !important; background-position: initial initial !important; background-repeat: initial initial !important; }
a{ text-decoration: underline; }
a[href]::after{ content: ' (', attr(href), ')'; }
 img{ page-break-inside: avoid; }
img{ max-width: 100% !important; }
p, h2, h3{ orphans: 3; widows: 3; }
h2, h3{ page-break-after: avoid; }
}
input[type="submit"]{ border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; cursor: pointer; font-family: proxima-nova-alt, sans-serif; font-weight: normal; line-height: normal; margin-top: 0px; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; position: relative; text-decoration: none; text-align: center; -webkit-appearance: none; display: inline-block; padding-top: 0.875rem; padding-right: 1.75rem; padding-bottom: 0.9375rem; padding-left: 1.75rem; font-size: 1rem; border-top-color: rgb(0, 88, 248); border-right-color: rgb(0, 88, 248); border-bottom-color: rgb(0, 88, 248); border-left-color: rgb(0, 88, 248); color: rgb(255, 255, 255); border-top-left-radius: 2px 2px; border-top-right-radius: 2px 2px; border-bottom-right-radius: 2px 2px; border-bottom-left-radius: 2px 2px; -webkit-transition-property: all; -webkit-transition-duration: 1s; -webkit-transition-timing-function: ease-out; -webkit-transition-delay: initial; background-image: -webkit-linear-gradient(45deg, rgb(55, 126, 255) 0%, rgb(19, 103, 255) 50%, rgb(40, 116, 255) 50.01%, rgb(157, 192, 255)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
.button{ -webkit-transition-property: all; -webkit-transition-duration: 1s; -webkit-transition-timing-function: ease-out; -webkit-transition-delay: initial; background-image: -webkit-linear-gradient(45deg, rgb(55, 126, 255) 0%, rgb(19, 103, 255) 50%, rgb(40, 116, 255) 50.01%, rgb(157, 192, 255)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
.button.success{ -webkit-transition-property: all; -webkit-transition-duration: 1s; -webkit-transition-timing-function: ease-out; -webkit-transition-delay: initial; background-image: -webkit-linear-gradient(45deg, rgb(55, 190, 94) 0%, rgb(47, 162, 80) 50%, rgb(52, 178, 88) 50.01%, rgb(129, 218, 155)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
.tag{ border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; cursor: pointer; font-family: proxima-nova-alt, sans-serif; font-weight: normal; line-height: normal; margin-top: 0px; margin-right: 0px; margin-left: 0px; position: relative; text-decoration: none; text-align: center; -webkit-appearance: none; border-top-left-radius: 0px 0px; border-top-right-radius: 0px 0px; border-bottom-right-radius: 0px 0px; border-bottom-left-radius: 0px 0px; display: inline-block; padding-top: 0.25rem; padding-right: 0.5rem; padding-bottom: 0.3125rem; padding-left: 0.5rem; background-color: rgb(248, 236, 209); border-top-color: rgb(236, 205, 130); border-right-color: rgb(236, 205, 130); border-bottom-color: rgb(236, 205, 130); border-left-color: rgb(236, 205, 130); color: rgb(51, 51, 51); margin-bottom: 3px; text-transform: uppercase; font-size: 0.6875rem; }
.contain-to-grid.uiowa-bar{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(34, 34, 34); background-position: initial initial; background-repeat: initial initial; }
.contain-to-grid.uiowa-bar .top-bar{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(34, 34, 34); height: auto; background-position: initial initial; background-repeat: initial initial; }
@media only screen and (min-width: 64.063em){
.contain-to-grid.uiowa-bar .top-bar{ height: 2.6875rem; line-height: 2.6875rem; }
}
.contain-to-grid.uiowa-bar .top-bar input{ top: 0.46875rem; }
.contain-to-grid.uiowa-bar .top-bar .top-bar-section .has-form{ height: 2.6875rem; padding-top: 0px; padding-right: 0.8958333333rem; padding-bottom: 0px; padding-left: 0.8958333333rem; }
.contain-to-grid.uiowa-bar .top-bar .top-bar-section ul{ line-height: 2.6875rem; }
.contain-to-grid.uiowa-bar .top-bar .top-bar-section li{ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(34, 34, 34); background-position: initial initial; background-repeat: initial initial; }
.contain-to-grid.uiowa-bar .top-bar .top-bar-section li:not(.has-form) a:not(.button){ background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(34, 34, 34); line-height: 2.6875rem; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; background-position: initial initial; background-repeat: initial initial; }
.contain-to-grid{ background-image: -webkit-linear-gradient(-90deg, rgb(81, 81, 81), rgb(68, 68, 68)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
.top-bar{ background-image: -webkit-linear-gradient(-90deg, rgb(81, 81, 81), rgb(68, 68, 68)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
.top-bar h1{ max-width: 18.75rem; }
@media only screen and (min-width: 64.063em){
.top-bar h1{ max-width: 18.75rem; }
}
.top-bar .name h1 a{ padding-left: 0.78125rem; }
@media only screen and (min-width: 64.063em){
.top-bar .top-bar-section ul li{ background-image: -webkit-linear-gradient(-90deg, rgb(81, 81, 81), rgb(68, 68, 68)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
}
.top-bar .top-bar-section ul li a.button{ font-size: 1.125rem; padding-top: 0.1875rem; padding-right: 1.0625rem; padding-bottom: 0.1875rem; padding-left: 1.0625rem; text-transform: capitalize; font-family: proxima-nova-alt, sans-serif; }
.top-bar .top-bar-section .has-form{ background-image: -webkit-linear-gradient(-90deg, rgb(81, 81, 81), rgb(68, 68, 68)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; padding-top: 0px; padding-right: 5px; padding-bottom: 0px; padding-left: 5px; background-position: initial initial; background-repeat: initial initial; }
.top-bar .top-bar-section .has-form:last-of-type{ padding-right: 0px; }
@media only screen and (min-width: 64.063em){
.top-bar .top-bar-section li:not(.has-form) a:not(.button){ background-image: -webkit-linear-gradient(-90deg, rgb(81, 81, 81), rgb(68, 68, 68)); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial; }
}
.top-bar .top-bar-section .right{ padding-right: 0.78125rem; }
.message{ overflow-x: hidden; overflow-y: hidden; }
.card h4{ -webkit-transition-property: all; -webkit-transition-duration: 0.2s; -webkit-transition-timing-function: ease-in-out; -webkit-transition-delay: initial; color: rgb(4, 93, 255); }
.small li.card{ padding-top: 10px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); }
.small li.card.last{ border-bottom-width: 0px; border-bottom-style: initial; border-bottom-color: initial; }
.tutor-card-list{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.tutor-card-list::before, .tutor-card-list::after{ content: ' '; display: table; }
.tutor-card-list::after{ clear: both; }
.tutor-card-list > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.tutor-card-list > li{ width: 100%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.tutor-card-list > li:nth-of-type(1n){ clear: none; }
.tutor-card-list > li:nth-of-type(1n+1){ clear: both; }
.tutor-card-list > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
@media only screen and (min-width: 64.063em){
.tutor-card-list{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.tutor-card-list::before, .tutor-card-list::after{ content: ' '; display: table; }
.tutor-card-list::after{ clear: both; }
.tutor-card-list > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.tutor-card-list > li{ width: 50%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.tutor-card-list > li:nth-of-type(1n){ clear: none; }
.tutor-card-list > li:nth-of-type(2n+1){ clear: both; }
.tutor-card-list > li:nth-of-type(2n+1){ padding-left: 0rem; padding-right: 0.78125rem; }
.tutor-card-list > li:nth-of-type(2n){ padding-left: 0.78125rem; padding-right: 0rem; }
}
.tutor-card-list.large li{ padding-bottom: 0px; }
.tutor-card-list li{ margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; min-height: 200px; }
.tutor-card-list li img{ -webkit-transition-property: all; -webkit-transition-duration: 0.2s; -webkit-transition-timing-function: ease-in-out; -webkit-transition-delay: initial; }
.tutor-card-list li img{ display: block; }
.tutor-card-list a{ color: rgb(34, 34, 34); }
.resource-card-list{ list-style-type: none; display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.resource-card-list::before, .resource-card-list::after{ content: ' '; display: table; }
.resource-card-list::after{ clear: both; }
.resource-card-list > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.resource-card-list > li{ width: 100%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.resource-card-list > li:nth-of-type(1n){ clear: none; }
.resource-card-list > li:nth-of-type(1n+1){ clear: both; }
.resource-card-list > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
@media only screen and (min-width: 64.063em){
.resource-card-list{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.resource-card-list::before, .resource-card-list::after{ content: ' '; display: table; }
.resource-card-list::after{ clear: both; }
.resource-card-list > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.resource-card-list > li{ width: 50%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.resource-card-list > li:nth-of-type(1n){ clear: none; }
.resource-card-list > li:nth-of-type(2n+1){ clear: both; }
.resource-card-list > li:nth-of-type(2n+1){ padding-left: 0rem; padding-right: 0.78125rem; }
.resource-card-list > li:nth-of-type(2n){ padding-left: 0.78125rem; padding-right: 0rem; }
}
.resource-card-list.small{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.resource-card-list.small::before, .resource-card-list.small::after{ content: ' '; display: table; }
.resource-card-list.small::after{ clear: both; }
.resource-card-list.small > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.resource-card-list.small > li{ width: 100%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.resource-card-list.small > li:nth-of-type(1n){ clear: none; }
.resource-card-list.small > li:nth-of-type(1n+1){ clear: both; }
.resource-card-list.small > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
.resource-card-list .resource-card{ margin-bottom: 0px; }
.resource-card-list li{ list-style-type: none; }
.resource-card-list li a{ color: rgb(34, 34, 34); }
.resource-card-list li span{ color: rgb(55, 126, 255); }
.side-nav{ background-color: rgb(244, 244, 244); padding-top: 0.78125rem; padding-right: 0.78125rem; padding-bottom: 0.78125rem; padding-left: 0.78125rem; }
@media only screen and (min-width: 64.063em){
.side-nav{ padding-right: 0px; }
}
.side-nav a p{ color: rgb(34, 34, 34); }
.side-nav h3{ text-transform: uppercase; font-size: 1rem; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(102, 102, 102); color: white; padding-top: 2px; padding-right: 2px; padding-bottom: 2px; padding-left: 2px; background-position: initial initial; background-repeat: initial initial; }
.side-nav h3 span{ padding-top: 2px; padding-right: 2px; padding-bottom: 2px; padding-left: 2px; }
.side-nav .announcements.small .announcement-card{ padding-top: 10px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px; }
.side-nav .resource-card-list.small .resource-card{ padding-top: 10px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px; }
.footer p, .footer li{ font-size: 0.75rem; }
.footer a{ color: rgb(238, 238, 238); }
.footer-logo img{ display: block; margin-top: -20px; max-width: 300px; }
.border-list{ list-style-type: none; list-style-position: initial; list-style-image: initial; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
@media only screen and (min-width: 40.063em){
.border-list{ border-left-width: 1px; border-left-style: solid; border-left-color: rgb(0, 0, 0); }
}
.border-list:first-child{ padding-top: 0px; }
.border-list a{ display: block; padding-top: 10px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px; -webkit-transition-property: all; -webkit-transition-duration: 0.2s; -webkit-transition-timing-function: ease-in-out; -webkit-transition-delay: initial; }
@media only screen and (min-width: 40.063em){
.border-list a{ border-left-width: 1px; border-left-style: solid; border-left-color: rgb(46, 46, 46); padding-top: 5px; padding-right: 0px; padding-bottom: 5px; padding-left: 10px; }
}
.footer hr{ border-top-color: rgb(0, 0, 0); border-bottom-color: rgb(46, 46, 46); margin-top: 0.5em; margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; }
.announcements{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.announcements::before, .announcements::after{ content: ' '; display: table; }
.announcements::after{ clear: both; }
.announcements > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.announcements > li{ width: 100%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.announcements > li:nth-of-type(1n){ clear: none; }
.announcements > li:nth-of-type(1n+1){ clear: both; }
.announcements > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
@media only screen and (min-width: 64.063em){
.announcements{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.announcements::before, .announcements::after{ content: ' '; display: table; }
.announcements::after{ clear: both; }
.announcements > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.announcements > li{ width: 50%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.announcements > li:nth-of-type(1n){ clear: none; }
.announcements > li:nth-of-type(2n+1){ clear: both; }
.announcements > li:nth-of-type(2n+1){ padding-left: 0rem; padding-right: 0.78125rem; }
.announcements > li:nth-of-type(2n){ padding-left: 0.78125rem; padding-right: 0rem; }
}
.announcements.small{ display: block; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; }
.announcements.small::before, .announcements.small::after{ content: ' '; display: table; }
.announcements.small::after{ clear: both; }
.announcements.small > li{ display: block; height: auto; float: left; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; }
.announcements.small > li{ width: 100%; padding-top: 0px; padding-right: 0.78125rem; padding-bottom: 1.5625rem; padding-left: 0.78125rem; list-style-type: none; list-style-position: initial; list-style-image: initial; }
.announcements.small > li:nth-of-type(1n){ clear: none; }
.announcements.small > li:nth-of-type(1n+1){ clear: both; }
.announcements.small > li:nth-of-type(1n){ padding-left: 0rem; padding-right: 0rem; }
.announcements .announcement-card a{ color: rgb(0, 0, 0); display: block; }
.announcements .announcement-card p{ margin-bottom: 0px; }
.uiowa{ line-height: 42px; }
.uiowa{ display: block; float: left; opacity: 0.7; width: 177px; margin-left: 10px; }
@media only screen and (min-width: 64.063em){
.uiowa{ margin-left: 0px; }
}
#search_help p{ color: white; }
.profile-image{ background-size: cover; }
.profile-image img{ border-top-left-radius: 50% 50%; border-top-right-radius: 50% 50%; border-bottom-right-radius: 50% 50%; border-bottom-left-radius: 50% 50%; }
.tutor-name{ text-transform: capitalize; }
.b-lazy{ -webkit-transition-property: opacity; -webkit-transition-duration: 500ms; -webkit-transition-timing-function: ease-in-out; -webkit-transition-delay: initial; max-width: 100%; opacity: 0; }
.b-lazy.b-loaded{ opacity: 1; }