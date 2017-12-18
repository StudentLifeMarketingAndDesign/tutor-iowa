meta.foundation-mq-small {
  font-family: '/only screen/';
  width: 0em;
  font-family: "/only screen/";
}

meta.foundation-mq-small-only {
  font-family: '/only screen and (max-width: 40em)/';
  width: 0em;
  font-family: "/only screen and (max-width: 40em)/";
}

meta.foundation-mq-medium {
  font-family: '/only screen and (min-width:40.063em)/';
  width: 40.063em;
  font-family: "/only screen and (min-width:40.063em)/";
}

meta.foundation-mq-medium-only {
  font-family: '/only screen and (min-width:40.063em) and (max-width:64em)/';
  width: 40.063em;
  font-family: "/only screen and (min-width:40.063em) and (max-width:64em)/";
}

meta.foundation-mq-large {
  font-family: '/only screen and (min-width:64.063em)/';
  width: 64.063em;
  font-family: "/only screen and (min-width:64.063em)/";
}

meta.foundation-mq-large-only {
  font-family: '/only screen and (min-width:64.063em) and (max-width:90em)/';
  width: 64.063em;
  font-family: "/only screen and (min-width:64.063em) and (max-width:90em)/";
}

meta.foundation-mq-xlarge {
  font-family: '/only screen and (min-width:90.063em)/';
  width: 90.063em;
  font-family: "/only screen and (min-width:90.063em)/";
}

meta.foundation-mq-xlarge-only {
  font-family: '/only screen and (min-width:90.063em) and (max-width:120em)/';
  width: 90.063em;
  font-family: "/only screen and (min-width:90.063em) and (max-width:120em)/";
}

meta.foundation-mq-xxlarge {
  font-family: '/only screen and (min-width:120.063em)/';
  width: 120.063em;
  font-family: "/only screen and (min-width:120.063em)/";
}

meta.foundation-data-attribute-namespace {
  font-family: false;
}

html,
body {
  height: 100%;
  font-size: 100%;
}

* {
  box-sizing: border-box;
}

html,
body {
  font-size: 100%;
  height: 100%;
}

body {
  background-color: rgb(255, 255, 255);
  color: rgb(34, 34, 34);
  padding: 0px;
  margin: 0px;
  font-family: proxima-nova-alt, Arial, sans-serif;
  font-weight: normal;
  font-style: normal;
  line-height: 1.5;
  position: relative;
  cursor: auto;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #fff;
  color: #222;
  padding: 0;
  margin: 0;
  font-family: "proxima-nova-alt","Arial",sans-serif;
}

span.error {
  display: block;
  padding: 0.375rem 0.5625rem 0.5625rem;
  margin-top: -1px;
  margin-bottom: 1rem;
  font-size: 0.75rem;
  font-weight: normal;
  font-style: italic;
  background-color: rgb(240, 65, 36);
  color: rgb(255, 255, 255);
  background-position: initial initial;
  background-repeat: initial initial;
}

.reveal-modal {
  visibility: hidden;
  display: none;
  position: absolute;
  z-index: 1005;
  width: 100%;
  top: 0px;
  border-top-left-radius: 2px;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
  border-bottom-left-radius: 2px;
  left: 0px;
  background-color: rgb(255, 255, 255);
  padding: 2.0625rem;
  border: 1px solid rgb(102, 102, 102);
  box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 10px;
  top: 0;
  border-radius: 2px;
  left: 0;
  background-color: #fff;
  border: solid 1px #666;
  box-shadow: 0 0 10px rgba(0,0,0,0.4);
}

@media only screen and (max-width: 40em) {
  .reveal-modal {
    min-height: 100vh;
  }
}

.reveal-modal .columns {
  min-width: 0px;
}

.reveal-modal > :first-child {
  margin-top: 0px;
}

.reveal-modal > :last-child {
  margin-bottom: 0px;
}

@media only screen and (min-width: 40.063em) {
  .reveal-modal {
    width: 80%;
    max-width: 77.5rem;
    left: 0px;
    right: 0px;
    margin: 0px auto;
    left: 0;
    right: 0;
    margin: 0 auto;
    top: 6.25rem;
  }
}

@media only screen and (min-width: 40.063em) {
  .reveal-modal {
    top: 6.25rem;
    width: 80%;
    max-width: 77.5rem;
    left: 0;
    right: 0;
    margin: 0 auto;
  }
}

@media only screen and (min-width: 40.063em) {
  .reveal-modal.medium {
    width: 60%;
    max-width: 77.5rem;
    left: 0px;
    right: 0px;
    margin: 0px auto;
    left: 0;
    right: 0;
    margin: 0 auto;
  }
}

.reveal-modal .close-reveal-modal {
  font-size: 2.5rem;
  line-height: 1;
  position: absolute;
  top: 0.625rem;
  right: 1.375rem;
  color: rgb(170, 170, 170);
  font-weight: bold;
  cursor: pointer;
  top: .625rem;
  color: #aaa;
}

meta.foundation-mq-topbar {
  font-family: '/only screen and (min-width:64.063em)/';
  width: 64.063em;
  font-family: "/only screen and (min-width:64.063em)/";
}

.top-bar .toggle-topbar {
  position: absolute;
  right: 0px;
  top: 0px;
  right: 0;
  top: 0;
}

.top-bar .toggle-topbar a {
  color: rgb(255, 255, 255);
  text-transform: uppercase;
  font-size: 0.8125rem;
  font-weight: bold;
  position: relative;
  display: block;
  padding: 0px 1.4583333333rem;
  height: 4.375rem;
  line-height: 4.375rem;
  color: #fff;
  font-size: .8125rem;
  padding: 0 1.4583333333rem;
}

.top-bar .toggle-topbar.menu-icon {
  top: 50%;
  margin-top: -16px;
}

.top-bar .toggle-topbar.menu-icon a {
  height: 34px;
  line-height: 33px;
  padding: 0px 3.0208333333rem 0px 1.4583333333rem;
  color: rgb(255, 255, 255);
  position: relative;
  padding: 0 3.0208333333rem 0 1.4583333333rem;
  color: #fff;
}

.top-bar .toggle-topbar.menu-icon a span::after {
  content: '';
  position: absolute;
  display: block;
  height: 0px;
  top: 50%;
  margin-top: -8px;
  right: 1.4583333333rem;
  box-shadow: rgb(255, 255, 255) 0px 0px 0px 1px, rgb(255, 255, 255) 0px 7px 0px 1px, rgb(255, 255, 255) 0px 14px 0px 1px;
  width: 16px;
  content: "";
  height: 0;
  box-shadow: 0 0 0 1px #fff,0 7px 0 1px #fff,0 14px 0 1px #fff;
}

.top-bar-section .dropdown li {
  width: 100%;
  height: auto;
}

.top-bar-section .dropdown li a {
  font-weight: normal;
  padding: 8px 1.4583333333rem;
}

.top-bar-section .dropdown li a.parent-link {
  font-weight: normal;
}

.top-bar-section .dropdown li.title h5,
.top-bar-section .dropdown li.parent-link {
  margin-bottom: 0px;
  margin-top: 0px;
  font-size: 0.875rem;
  margin-bottom: 0;
  margin-top: 0;
  font-size: .875rem;
}

.top-bar-section .dropdown li.title h5 a,
.top-bar-section .dropdown li.parent-link a {
  color: rgb(255, 255, 255);
  display: block;
  color: #fff;
}

.js-generated {
  display: block;
}

@media only screen and (min-width: 64.063em) {
  .top-bar .toggle-topbar {
    display: none;
  }

  .top-bar-section ul li .js-generated {
    display: none;
  }

  .top-bar-section .dropdown li a {
    color: rgb(255, 255, 255);
    line-height: 4.375rem;
    white-space: nowrap;
    padding: 12px 1.4583333333rem;
    background-color: rgb(51, 51, 51);
    background-position: initial initial;
    background-repeat: initial initial;
    color: #fff;
    background: #333;
  }

  .top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button) {
    color: rgb(255, 255, 255);
    background-color: rgb(51, 51, 51);
    background-position: initial initial;
    background-repeat: initial initial;
  }
}

div,
ul,
li,
h1,
h3,
h5,
pre,
p {
  margin: 0px;
  padding: 0px;
}

p {
  font-family: inherit;
  font-weight: normal;
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 1.25rem;
  text-rendering: optimizelegibility;
  text-rendering: optimizeLegibility;
}

h1,
h3,
h5 {
  font-family: proxima-nova-alt-condensed, 'Arial Narrow', sans-serif;
  font-weight: normal;
  font-style: normal;
  color: rgb(34, 34, 34);
  text-rendering: optimizelegibility;
  margin-top: 0.2rem;
  margin-bottom: 0.5rem;
  line-height: 1.1;
}

h1 {
  font-size: 2.125rem;
}

h3 {
  font-size: 1.375rem;
}

h5 {
  font-size: 1.125rem;
}

strong,
b {
  font-weight: bold;
  line-height: inherit;
}

ul {
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 1.25rem;
  list-style-position: outside;
  font-family: inherit;
  margin-left: 1.1rem;
}

ul {
  margin-left: 1.1rem;
}

@media only screen and (min-width: 40.063em) {
  h1,
  h3,
  h5 {
    line-height: 1.1;
  }

  h1 {
    font-size: 2.75rem;
  }

  h3 {
    font-size: 1.6875rem;
  }

  h5 {
    font-size: 1.125rem;
  }
}

@media only screen {
  .hide-for-large-up {
    display: inherit !important;
  }
}

@media only screen and (min-width: 40.063em) {
  .hide-for-large-up {
    display: inherit !important;
  }
}

@media only screen and (min-width: 64.063em) {
  .hide-for-large-up {
    display: none !important;
  }
}

@media only screen and (min-width: 90.063em) {
  .hide-for-large-up {
    display: none !important;
  }
}

@media only screen and (min-width: 120.063em) {
  .hide-for-large-up {
    display: none !important;
  }
}

@media print {
  * {
    background-color: transparent !important;
    color: rgb(0, 0, 0) !important;
    box-shadow: none !important;
    text-shadow: none !important;
    background-position: initial initial !important;
    background-repeat: initial initial !important;
    background: transparent !important;
    color: #000 !important;
  }

  a[href^="javascript:"]::after {
    content: '';
  }

  pre {
    border: 1px solid rgb(153, 153, 153);
    page-break-inside: avoid;
  }

  p,
  h3 {
    orphans: 3;
    widows: 3;
  }

  h3 {
    page-break-after: avoid;
  }
}

.button--hawkid {
  transition: all 1s ease-out;
  -webkit-transition: all 1s ease-out;
  background-image: linear-gradient(45deg, rgb(255, 205, 0) 0%, rgb(219, 176, 0) 50%, rgb(240, 193, 0) 50.01%, rgb(255, 225, 102));
  color: rgb(17, 17, 17);
  background-position: initial initial;
  background-repeat: initial initial;
  -moz-transition: all 1s ease-out;
  -o-transition: all 1s ease-out;
  background: #FFCD00;
  background: -webkit-linear-gradient(45deg, #FFCD00 0%,#dbb000 50%,#f0c100 50.01%,#ffe166);
  background: linear-gradient(45deg, #FFCD00 0%,#dbb000 50%,#f0c100 50.01%,#ffe166);
  color: #111;
}

.top-bar .title.back a {
  background-color: rgb(102, 102, 102);
  background-position: initial initial;
  background-repeat: initial initial;
  background: #666;
}

.search-toggle {
  border-left-width: 1px;
  border-left-style: solid;
  border-left-color: rgb(0, 0, 0);
  -webkit-box-shadow: rgba(255, 255, 255, 0.0980392) -1px 0px 0px;
  box-shadow: rgba(255, 255, 255, 0.0980392) -1px 0px 0px;
  display: block;
  float: right;
  height: 40px;
  text-decoration: none;
  width: 40px;
  background: url(../../../division-bar/images/division-bar/magnifier-18.png) no-repeat 10px 10px;
  background-size: 52%;
  padding: 10px;
  text-indent: -999em;
}

@media only screen and (min-width: 64.063em) {
  .search-toggle {
    border-left-style: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    display: none;
  }
}

.search-toggle {
  background-image: url(../../../division-bar/images/division-bar/magnifier-18.png);
  background-size: 52%;
  padding: 10px;
  text-indent: -999em;
  background-position: 10px 10px;
  background-repeat: no-repeat no-repeat;
  background: url(../../../division-bar/images/division-bar/magnifier-18.png) no-repeat 10px 10px;
}

@media only screen and (min-width: 64.063em) {
  .search-toggle {
    display: none;
  }
}

#feedback-btn {
  display: none;
}

@media only screen and (min-width: 64.063em) {
  #feedback-btn {
    display: block;
    background-image: url(../images/feedback-btn.gif);
    position: fixed;
    width: 40px;
    height: 120px;
    top: 45%;
    right: 0px;
    z-index: 101;
    background-size: cover;
    background-position: 50% 100%;
    background-repeat: initial initial;
    background: url("../images/feedback-btn.gif") bottom;
    right: 0;
  }
}

.visuallyhidden {
  border: 0px;
  clip: rect(0px 0px 0px 0px);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0px;
  position: absolute;
  width: 1px;
  border: 0;
  clip: rect(0 0 0 0);
  padding: 0;
}

#BetterNavigator {
  display: none;
}

@media only screen and (min-width: 64.063em) {
  #BetterNavigator {
    display: block;
  }
}