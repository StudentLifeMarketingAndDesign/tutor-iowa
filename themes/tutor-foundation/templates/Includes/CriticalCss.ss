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

img {
  max-width: 100%;
  height: auto;
  -ms-interpolation-mode: bicubic;
  display: inline-block;
  vertical-align: middle;
}

img {
  max-width: 100%;
  height: auto;
  -ms-interpolation-mode: bicubic;
  display: inline-block;
  vertical-align: middle;
}

.left {
  float: left !important;
}

.right {
  float: right !important;
}

.clearfix::before,
.clearfix::after {
  content: ' ';
  display: table;
}

.clearfix::after {
  clear: both;
}

img {
  display: inline-block;
  vertical-align: middle;
  max-width: 100%;
  height: auto;
  -ms-interpolation-mode: bicubic;
}

textarea {
  height: auto;
  min-height: 50px;
  max-width: 100%;
}

.row {
  width: 100%;
  margin: 0px auto;
  max-width: 77.5rem;
  margin-left: auto;
  margin-right: auto;
  margin-top: 0;
  margin-bottom: 0;
}

.row::before,
.row::after {
  content: ' ';
  display: table;
}

.row::after {
  clear: both;
}

.columns {
  padding-left: 0.78125rem;
  padding-right: 0.78125rem;
  width: 100%;
  float: left;
}

[class*="column"] + [class*="column"]:last-child {
  float: right;
}

[class*="column"] + [class*="column"].end {
  float: left;
}

@media only screen {
  .columns {
    position: relative;
    padding-left: 0.78125rem;
    padding-right: 0.78125rem;
    float: left;
  }
}

@media only screen and (min-width: 40.063em) {
  .columns {
    position: relative;
    padding-left: 0.78125rem;
    padding-right: 0.78125rem;
    float: left;
  }
}

@media only screen and (min-width: 64.063em) {
  .columns {
    position: relative;
    padding-left: 0.78125rem;
    padding-right: 0.78125rem;
    float: left;
  }

  .large-3 {
    width: 25%;
  }

  .large-9 {
    width: 75%;
  }

  .large-12 {
    width: 100%;
  }
}

.button {
  border: 0px solid rgb(0, 88, 248);
  cursor: pointer;
  font-family: proxima-nova-alt, Arial, sans-serif;
  font-weight: normal;
  line-height: normal;
  margin: 0px 0px 1.25rem;
  position: relative;
  text-decoration: none;
  text-align: center;
  -webkit-appearance: none;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  border-bottom-left-radius: 0px;
  display: inline-block;
  padding: 0.875rem 1.75rem 0.9375rem;
  font-size: 1rem;
  background-color: rgb(55, 126, 255);
  color: rgb(255, 255, 255);
  transition: background-color 300ms ease-out;
  -webkit-transition: background-color 300ms ease-out;
}

@media only screen and (min-width: 40.063em) {
  .button {
    display: inline-block;
  }
}

form {
  margin: 0px 0px 1rem;
  margin: 0 0 1rem;
}

label {
  font-size: 0.875rem;
  color: rgb(77, 76, 76);
  cursor: pointer;
  display: block;
  font-weight: normal;
  line-height: 1.5;
  margin-bottom: 0px;
  font-size: .875rem;
  color: #4d4c4c;
  margin-bottom: 0;
}

input[type="text"],
input[type="email"],
input[type="search"],
textarea {
  -webkit-appearance: none;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  border-bottom-left-radius: 0px;
  background-color: rgb(255, 255, 255);
  font-family: inherit;
  border: 1px solid rgb(204, 204, 204);
  box-shadow: rgba(0, 0, 0, 0.0980392) 0px 1px 2px inset;
  color: rgba(0, 0, 0, 0.74902);
  display: block;
  font-size: 0.875rem;
  margin: 0px 0px 1rem;
  padding: 0.5rem;
  height: 2.3125rem;
  width: 100%;
  box-sizing: border-box;
  transition: all 0.15s linear;
  -webkit-transition: all 0.15s linear;
}

input[type="submit"] {
  -webkit-appearance: none;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  border-bottom-left-radius: 0px;
  border-radius: 0;
  border-style: solid;
  border-width: 0;
  cursor: pointer;
  font-family: "proxima-nova-alt","Arial",sans-serif;
  font-weight: normal;
  line-height: normal;
  margin: 0 0 1.25rem;
  position: relative;
  text-decoration: none;
  text-align: center;
  -moz-appearance: none;
  display: inline-block;
  padding-top: .875rem;
  padding-right: 1.75rem;
  padding-bottom: .9375rem;
  padding-left: 1.75rem;
  font-size: 1rem;
  background-color: #377EFF;
  border-color: #0058f8;
  color: #fff;
  border-radius: 2px;
  transition: background-color 300ms ease-out;
  -webkit-transition: all 1s ease-out;
  -moz-transition: all 1s ease-out;
  -o-transition: all 1s ease-out;
  transition: all 1s ease-out;
  background: #377EFF;
  background: -webkit-linear-gradient(45deg, #377EFF 0%,#1367ff 50%,#2874ff 50.01%,#9dc0ff);
  background: linear-gradient(45deg, #377EFF 0%,#1367ff 50%,#2874ff 50.01%,#9dc0ff);
}

textarea[rows] {
  height: auto;
}

textarea {
  max-width: 100%;
  height: auto;
  min-height: 50px;
}

input[type="checkbox"] {
  margin: 0px 0px 1rem;
}

fieldset {
  border: 1px none rgb(221, 221, 221);
  padding: 0px;
  margin: 1.125rem 0px;
  border: 1px none #ddd;
  padding: 0;
  margin: 1.125rem 0;
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

.side-nav {
  display: block;
  margin: 0px;
  padding: 0.625rem 0px;
  list-style-type: none;
  list-style-position: outside;
  font-family: proxima-nova-alt, Arial, sans-serif;
  margin: 0;
  padding: .625rem 0;
  font-family: "proxima-nova-alt","Arial",sans-serif;
  padding-top: 0;
}

.side-nav li {
  margin: 0px 0px 0.4375rem;
  font-size: 0.875rem;
  font-weight: normal;
  margin: 0 0 .4375rem 0;
  font-size: .875rem;
  border-bottom: 1px solid #ccc;
}

.side-nav li a:not(.button) {
  display: block;
  color: rgb(55, 126, 255);
  margin: 0px;
  padding: 0px;
  color: #377EFF;
  margin: 0;
  padding: 0;
}

meta.foundation-mq-topbar {
  font-family: '/only screen and (min-width:64.063em)/';
  width: 64.063em;
  font-family: "/only screen and (min-width:64.063em)/";
}

.contain-to-grid {
  width: 100%;
  background-color: rgb(68, 68, 68);
  background-position: initial initial;
  background-repeat: initial initial;
  background: #444;
  background: #515151;
  background: -webkit-linear-gradient(-90deg, #515151,#444);
  background: linear-gradient(180deg, #515151,#444);
}

.contain-to-grid .top-bar {
  margin-bottom: 0px;
  margin-bottom: 0;
}

.top-bar {
  overflow: hidden;
  height: 4.375rem;
  line-height: 4.375rem;
  position: relative;
  background-color: rgb(68, 68, 68);
  margin-bottom: 0px;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #444;
  margin-bottom: 0;
  background: #515151;
  background: -webkit-linear-gradient(-90deg, #515151,#444);
  background: linear-gradient(180deg, #515151,#444);
}

.top-bar ul {
  margin-bottom: 0px;
  list-style: none;
  margin-bottom: 0;
}

.top-bar .title-area {
  position: relative;
  margin: 0px;
  margin: 0;
}

.top-bar .name {
  height: 4.375rem;
  margin: 0px;
  font-size: 16px;
  margin: 0;
}

.top-bar .name h1 {
  line-height: 4.375rem;
  font-size: 1.0625rem;
  margin: 0px;
}

.top-bar .name h1 a {
  font-weight: normal;
  color: rgb(255, 255, 255);
  width: 75%;
  display: block;
  padding: 0px 1.4583333333rem;
  padding-left: .78125rem;
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

.top-bar-section {
  left: 0px;
  position: relative;
  width: auto;
  transition: left 300ms ease-out;
  -webkit-transition: left 300ms ease-out;
  left: 0;
}

.top-bar-section ul {
  padding: 0px;
  width: 100%;
  height: auto;
  display: block;
  font-size: 16px;
  margin: 0px;
  padding: 0;
  margin: 0;
}

.top-bar-section ul li {
  background-color: rgb(68, 68, 68);
  background-position: initial initial;
  background-repeat: initial initial;
  background: #444;
}

.top-bar-section ul li > a {
  display: block;
  width: 100%;
  color: rgb(255, 255, 255);
  padding: 12px 0px 12px 1.4583333333rem;
  font-family: proxima-nova-alt-condensed, 'Arial Narrow', sans-serif;
  font-size: 1.375rem;
  font-weight: normal;
  text-transform: uppercase;
}

.top-bar-section .has-dropdown {
  position: relative;
}

.top-bar-section .has-dropdown > a::after {
  content: '';
  display: block;
  width: 0px;
  height: 0px;
  border-style: inset inset inset solid;
  border-width: 5px;
  border-color: transparent transparent transparent rgba(255, 255, 255, 0.4);
  margin-right: 1.4583333333rem;
  margin-top: -4.5px;
  position: absolute;
  top: 50%;
  right: 0px;
}

.top-bar-section .dropdown {
  padding: 0px;
  left: 100%;
  top: 0px;
  z-index: 99;
  display: block;
  height: 1px;
  width: 1px;
  overflow: hidden;
  clip: rect(1px 1px 1px 1px);
  position: absolute !important;
  padding: 0;
  position: absolute;
  top: 0;
  clip: rect(1px, 1px, 1px, 1px);
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

.top-bar-section .dropdown label {
  padding: 8px 1.4583333333rem 2px;
  margin-bottom: 0px;
  text-transform: uppercase;
  color: rgb(119, 119, 119);
  font-weight: bold;
  font-size: 0.625rem;
  margin-bottom: 0;
  color: #777;
  font-size: .625rem;
}

.js-generated {
  display: block;
}

@media only screen and (min-width: 64.063em) {
  .top-bar {
    background-color: rgb(68, 68, 68);
    overflow: visible;
    background-position: initial initial;
    background-repeat: initial initial;
    background: #444;
  }

  .top-bar::before,
  .top-bar::after {
    content: ' ';
    display: table;
  }

  .top-bar::after {
    clear: both;
  }

  .top-bar .toggle-topbar {
    display: none;
  }

  .top-bar .title-area {
    float: left;
  }

  .top-bar .name h1 a {
    width: auto;
  }

  .contain-to-grid .top-bar {
    max-width: 77.5rem;
    margin: 0px auto;
    margin: 0 auto;
    margin-bottom: 0;
  }

  .top-bar-section {
    transition: none 0ms 0ms;
    -webkit-transition: none 0ms 0ms;
    left: 0px !important;
    transition: none 0 0;
    left: 0 !important;
  }

  .top-bar-section ul {
    width: auto;
    display: inline;
    height: auto !important;
  }

  .top-bar-section ul li {
    float: left;
  }

  .top-bar-section ul li .js-generated {
    display: none;
  }

  .top-bar-section li:not(.has-form) a:not(.button) {
    padding: 0px 1.4583333333rem;
    line-height: 4.375rem;
    background-color: rgb(68, 68, 68);
    background-position: initial initial;
    background-repeat: initial initial;
    padding: 0 1.4583333333rem;
    background: #444;
  }

  .top-bar-section .has-dropdown > a {
    padding-right: 2.7083333333rem !important;
  }

  .top-bar-section .has-dropdown > a::after {
    content: '';
    display: block;
    width: 0px;
    height: 0px;
    border-style: solid inset inset;
    border-width: 5px;
    border-color: rgba(255, 255, 255, 0.4) transparent transparent;
    margin-top: -2.5px;
    top: 2.1875rem;
  }

  .top-bar-section .has-dropdown .dropdown li.has-dropdown > a::after {
    border: none;
    content: »;
    top: 1rem;
    margin-top: -1px;
    right: 5px;
    line-height: 1.2;
  }

  .top-bar-section .dropdown {
    left: 0px;
    top: auto;
    background-color: transparent;
    min-width: 100%;
    background-position: initial initial;
    background-repeat: initial initial;
    left: 0;
    background: transparent;
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

  .top-bar-section .dropdown li label {
    white-space: nowrap;
    background-color: rgb(51, 51, 51);
    background-position: initial initial;
    background-repeat: initial initial;
    background: #333;
  }

  .top-bar-section .dropdown li .dropdown {
    left: 100%;
    top: 0px;
    top: 0;
  }

  .top-bar-section .left li .dropdown {
    right: auto;
    left: 0px;
    left: 0;
  }

  .top-bar-section .left li .dropdown li .dropdown {
    left: 100%;
  }
}

div,
ul,
li,
h1,
h3,
h4,
h5,
form {
  margin: 0px;
  padding: 0px;
}

a {
  color: rgb(55, 126, 255);
  text-decoration: none;
  line-height: inherit;
  color: #377EFF;
}

a img {
  border: none;
}

h1,
h3,
h4,
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

h4 {
  font-size: 1.125rem;
}

h5 {
  font-size: 1.125rem;
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

ul li ul {
  margin-left: 1.25rem;
  margin-bottom: 0px;
}

@media only screen and (min-width: 40.063em) {
  h1,
  h3,
  h4,
  h5 {
    line-height: 1.1;
  }

  h1 {
    font-size: 2.75rem;
  }

  h3 {
    font-size: 1.6875rem;
  }

  h4 {
    font-size: 1.4375rem;
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

  a {
    text-decoration: underline;
  }

  a[href]::after {
    content: ' (', attr(href), ')';
  }

  a[href^="javascript:"]::after {
    content: '';
  }

  img {
    page-break-inside: avoid;
    max-width: 100% !important;
  }

  img {
    max-width: 100% !important;
  }

  h3 {
    orphans: 3;
    widows: 3;
  }

  h3 {
    page-break-after: avoid;
  }
}

.banner {
  text-transform: uppercase;
  font-size: 1rem;
  color: rgb(34, 34, 34);
  background-image: linear-gradient(to right, rgb(255, 255, 255) 0%, rgb(246, 246, 246) 47%, rgb(237, 237, 237) 100%);
  position: relative;
  padding: 3px;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #eee;
  color: #222;
  background: #fff;
  background: -moz-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, #fff), color-stop(47%, #f6f6f6), color-stop(100%, #ededed));
  background: -webkit-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: -o-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: -ms-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: linear-gradient(to right, #fff 0%, #f6f6f6 47%, #ededed 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );
}

input[type="submit"] {
  border: 0px solid rgb(0, 88, 248);
  cursor: pointer;
  font-family: proxima-nova-alt, Arial, sans-serif;
  font-weight: normal;
  line-height: normal;
  margin: 0px 0px 1.25rem;
  position: relative;
  text-decoration: none;
  text-align: center;
  -webkit-appearance: none;
  display: inline-block;
  padding: 0.875rem 1.75rem 0.9375rem;
  font-size: 1rem;
  color: rgb(255, 255, 255);
  border-top-left-radius: 2px;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
  border-bottom-left-radius: 2px;
  transition: all 1s ease-out;
  -webkit-transition: all 1s ease-out;
  background-image: linear-gradient(45deg, rgb(55, 126, 255) 0%, rgb(19, 103, 255) 50%, rgb(40, 116, 255) 50.01%, rgb(157, 192, 255));
  background-position: initial initial;
  background-repeat: initial initial;
  border-radius: 0;
  border-style: solid;
  border-width: 0;
  font-family: "proxima-nova-alt","Arial",sans-serif;
  margin: 0 0 1.25rem;
  -moz-appearance: none;
  padding-top: .875rem;
  padding-right: 1.75rem;
  padding-bottom: .9375rem;
  padding-left: 1.75rem;
  background-color: #377EFF;
  border-color: #0058f8;
  color: #fff;
  border-radius: 2px;
  transition: background-color 300ms ease-out;
  -moz-transition: all 1s ease-out;
  -o-transition: all 1s ease-out;
  background: #377EFF;
  background: -webkit-linear-gradient(45deg, #377EFF 0%,#1367ff 50%,#2874ff 50.01%,#9dc0ff);
  background: linear-gradient(45deg, #377EFF 0%,#1367ff 50%,#2874ff 50.01%,#9dc0ff);
}

.button {
  transition: all 1s ease-out;
  -webkit-transition: all 1s ease-out;
  background-image: linear-gradient(45deg, rgb(55, 126, 255) 0%, rgb(19, 103, 255) 50%, rgb(40, 116, 255) 50.01%, rgb(157, 192, 255));
  background-position: initial initial;
  background-repeat: initial initial;
}

.tag {
  border: 0px solid rgb(236, 205, 130);
  cursor: pointer;
  font-family: proxima-nova-alt, Arial, sans-serif;
  font-weight: normal;
  line-height: normal;
  margin: 0px 0px 3px;
  position: relative;
  text-decoration: none;
  text-align: center;
  -webkit-appearance: none;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  border-bottom-left-radius: 0px;
  display: inline-block;
  padding: 0.25rem 0.5rem 0.3125rem;
  background-color: rgb(248, 236, 209);
  color: rgb(51, 51, 51);
  transition: background-color 300ms ease-out;
  -webkit-transition: background-color 300ms ease-out;
  text-transform: uppercase;
  font-size: 0.6875rem;
  border-style: solid;
  border-width: 0;
  font-family: "proxima-nova-alt","Arial",sans-serif;
  margin: 0 0 1.25rem;
  -moz-appearance: none;
  border-radius: 0;
  padding-top: .25rem;
  padding-right: .5rem;
  padding-bottom: .3125rem;
  padding-left: .5rem;
  background-color: #f8ecd1;
  border-color: #eccd82;
  color: #333;
  margin-bottom: 3px;
  font-size: .6875rem;
}

.contain-to-grid {
  background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68));
  background-position: initial initial;
  background-repeat: initial initial;
  width: 100%;
  background: #444;
  background: #515151;
  background: -webkit-linear-gradient(-90deg, #515151,#444);
  background: linear-gradient(180deg, #515151,#444);
}

@media only screen and (min-width: 64.063em) {
  .top-bar-section .has-dropdown .dropdown li.has-dropdown > a::after {
    border: none;
    content: »;
    top: 1rem;
    margin-top: 5px;
    right: 5px;
    line-height: 1.2;
  }
}

.top-bar {
  background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68));
  background-position: initial initial;
  background-repeat: initial initial;
  overflow: hidden;
  height: 4.375rem;
  line-height: 4.375rem;
  position: relative;
  background: #444;
  margin-bottom: 0;
  background: #515151;
  background: -webkit-linear-gradient(-90deg, #515151,#444);
  background: linear-gradient(180deg, #515151,#444);
}

.top-bar h1 {
  max-width: 18.75rem;
}

@media only screen and (min-width: 64.063em) {
  .top-bar h1 {
    max-width: 18.75rem;
  }
}

.top-bar .name h1 a {
  padding-left: 0.78125rem;
  padding-left: .78125rem;
}

@media only screen and (min-width: 64.063em) {
  .top-bar .top-bar-section .has-dropdown .dropdown li.has-dropdown > a::after {
    border: none;
    content: »;
    top: 1rem;
    margin-top: 5px;
    right: 5px;
    line-height: 1.2;
  }
}

.top-bar .top-bar-section ul li.log-in:not(.has-form) a:not(.button) {
  background-color: rgb(55, 126, 255);
  background-position: initial initial;
  background-repeat: initial initial;
  background: #377EFF;
}

.top-bar .top-bar-section ul li.register:not(.has-form) a:not(.button) {
  background-color: rgb(55, 190, 94);
  background-position: initial initial;
  background-repeat: initial initial;
  background: #37be5e;
}

@media only screen and (min-width: 64.063em) {
  .top-bar .top-bar-section ul li {
    background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68));
    background-position: initial initial;
    background-repeat: initial initial;
    background: #515151;
    background: -webkit-linear-gradient(-90deg, #515151,#444);
    background: linear-gradient(180deg, #515151,#444);
  }
}

@media only screen and (min-width: 64.063em) {
  .top-bar .top-bar-section li:not(.has-form) a:not(.button) {
    background-image: linear-gradient(rgb(81, 81, 81), rgb(68, 68, 68));
    background-position: initial initial;
    background-repeat: initial initial;
    background: #515151;
    background: -webkit-linear-gradient(-90deg, #515151,#444);
    background: linear-gradient(180deg, #515151,#444);
  }
}

.top-bar .top-bar-section .right {
  padding-right: 0px;
  padding-right: 0;
}

@media only screen and (min-width: 64.063em) {
  .top-bar .top-bar-section .right {
    padding-right: 0.78125rem;
    padding-right: .78125rem;
  }
}

.top-bar .title.back a {
  background-color: rgb(102, 102, 102);
  background-position: initial initial;
  background-repeat: initial initial;
  background: #666;
}

.HomePage .bg-container {
  background-color: rgb(51, 51, 51);
  background-size: cover;
  min-height: 400px;
  background-position: 50% 50%;
  background-repeat: no-repeat no-repeat;
  background-color: #333;
  background-repeat: no-repeat;
}

@media only screen and (min-width: 40.063em) {
  .HomePage .bg-container {
    min-height: 700px;
  }
}

.HomePage .tagline {
  font-size: 2.25rem;
  line-height: 1em;
  font-weight: bold;
  display: block;
  text-align: center;
  color: white;
  padding: 1.5625rem 0px;
  padding: 1.5625rem 0;
}

@media only screen and (min-width: 40.063em) {
  .HomePage .tagline {
    font-size: 4.5rem;
    line-height: 0.9em;
  }
}

.HomePage .HomePageSearchBg {
  margin: 0px auto;
  max-width: 600px;
  margin: 0 auto;
}

@media only screen and (min-width: 40.063em) {
  .HomePage .HomePageSearchBg {
    padding-top: 12%;
    padding-bottom: 3%;
  }
}

.HomePage .HomePagePopSearches {
  position: relative;
  text-align: center;
  margin: 0px auto;
  background-color: rgba(34, 34, 34, 0.298039);
  padding: 10px;
  background-position: initial initial;
  background-repeat: initial initial;
  margin: 0 auto;
  background: rgba(34,34,34,0.3);
}

.HomePage .HomeFieldHolder {
  overflow: hidden;
  padding-right: 0.5em;
  text-align: center;
  padding-right: .5em;
}

.HomePage .HomeFieldHolder input.textInput {
  width: 100%;
  text-align: center;
  border-top-left-radius: 100px;
  border-top-right-radius: 100px;
  border-bottom-right-radius: 100px;
  border-bottom-left-radius: 100px;
  border-radius: 100px;
}

@media only screen and (min-width: 40.063em) {
  .HomePage .HomeFieldHolder input.textInput {
    height: 2.3125em;
    font-size: 1rem;
  }
}

.HomePage .HomeFieldHolder input.button.home-search-submit {
  display: inline;
  width: 40%;
}

.card {
  padding: 0.78125rem 0px;
  padding: .78125rem 0;
}

@media only screen and (min-width: 64.063em) {
  .card {
    padding: 0px;
    padding: 0;
  }
}

.card h4 {
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  color: rgb(4, 93, 255);
  transition: all .2s ease-in-out;
  -moz-transition: all .2s ease-in-out;
  -webkit-transition: all .2s ease-in-out;
  color: #045dff;
}

.small li.card {
  padding: 10px 0px;
  padding: 10px 0;
}

.resource-card-list {
  list-style-type: none;
  display: block;
  padding: 0px;
  margin: 0px;
  margin: 0;
  padding: 0;
}

.resource-card-list::before,
.resource-card-list::after {
  content: ' ';
  display: table;
}

.resource-card-list::after {
  clear: both;
}

.resource-card-list > li {
  display: block;
  height: auto;
  float: left;
  padding: 0px 0.78125rem 1.5625rem;
}

.resource-card-list > li {
  width: 100%;
  padding: 0px 0.78125rem 1.5625rem;
  list-style: none;
}

.resource-card-list > li:nth-of-type(1n) {
  clear: none;
}

.resource-card-list > li:nth-of-type(1n+1) {
  clear: both;
}

.resource-card-list > li:nth-of-type(1n) {
  padding-left: 0rem;
  padding-right: 0rem;
}

@media only screen and (min-width: 64.063em) {
  .resource-card-list {
    display: block;
    padding: 0px;
    margin: 0px;
    padding: 0;
    margin: 0;
  }

  .resource-card-list::before,
  .resource-card-list::after {
    content: ' ';
    display: table;
  }

  .resource-card-list::after {
    clear: both;
  }

  .resource-card-list > li {
    display: block;
    height: auto;
    float: left;
    padding: 0px 0.78125rem 1.5625rem;
  }

  .resource-card-list > li {
    width: 50%;
    padding: 0px 0.78125rem 1.5625rem;
    list-style: none;
  }

  .resource-card-list > li:nth-of-type(1n) {
    clear: none;
  }

  .resource-card-list > li:nth-of-type(2n+1) {
    clear: both;
  }

  .resource-card-list > li:nth-of-type(2n+1) {
    padding-left: 0rem;
    padding-right: 0.78125rem;
  }

  .resource-card-list > li:nth-of-type(2n) {
    padding-left: 0.78125rem;
    padding-right: 0rem;
  }
}

.resource-card-list .resource-card {
  margin-bottom: 0px;
  list-style-type: none;
  margin-bottom: 0;
}

.resource-card-list li {
  list-style-type: none;
}

.resource-card-list li a {
  color: rgb(34, 34, 34);
  color: #222;
}

.side-nav {
  padding-top: 0px;
  display: block;
  margin: 0;
  padding: .625rem 0;
  list-style-type: none;
  list-style-position: outside;
  font-family: "proxima-nova-alt","Arial",sans-serif;
  padding-top: 0;
}

@media only screen and (min-width: 64.063em) {
  .side-nav {
    background-color: rgb(244, 244, 244);
    padding: 0.78125rem 0px 0.78125rem 0.78125rem;
    background-color: #f4f4f4;
    padding: .78125rem;
    padding-right: 0;
  }
}

.side-nav li {
  border-bottom-width: 1px;
  border-bottom-style: solid;
  border-bottom-color: rgb(204, 204, 204);
  margin: 0 0 .4375rem 0;
  font-size: .875rem;
  font-weight: normal;
  border-bottom: 1px solid #ccc;
}

.side-nav h3 {
  text-transform: uppercase;
  font-size: 1rem;
  color: rgb(34, 34, 34);
  background-image: linear-gradient(to right, rgb(255, 255, 255) 0%, rgb(246, 246, 246) 47%, rgb(237, 237, 237) 100%);
  position: relative;
  padding: 3px;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #eee;
  color: #222;
  background: #fff;
  background: -moz-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, #fff), color-stop(47%, #f6f6f6), color-stop(100%, #ededed));
  background: -webkit-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: -o-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: -ms-linear-gradient(left, #fff 0%, #f6f6f6 47%, #ededed 100%);
  background: linear-gradient(to right, #fff 0%, #f6f6f6 47%, #ededed 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );
  background: linear-gradient(to right, #ededed, 0%, #f6f6f6 47%, #fff 100%);
}

.side-nav .announcements.small .announcement-card {
  padding: 10px 0px;
  padding: 10px 0;
}

.announcements {
  display: block;
  padding: 0px;
  margin: 0px;
  margin: 0;
  padding: 0;
}

.announcements::before,
.announcements::after {
  content: ' ';
  display: table;
}

.announcements::after {
  clear: both;
}

.announcements > li {
  display: block;
  height: auto;
  float: left;
  padding: 0px 0.78125rem 1.5625rem;
}

.announcements > li {
  width: 100%;
  padding: 0px 0.78125rem 1.5625rem;
  list-style: none;
}

.announcements > li:nth-of-type(1n) {
  clear: none;
}

.announcements > li:nth-of-type(1n+1) {
  clear: both;
}

.announcements > li:nth-of-type(1n) {
  padding-left: 0rem;
  padding-right: 0rem;
}

@media only screen and (min-width: 64.063em) {
  .announcements {
    display: block;
    padding: 0px;
    margin: 0px;
    padding: 0;
    margin: 0;
  }

  .announcements::before,
  .announcements::after {
    content: ' ';
    display: table;
  }

  .announcements::after {
    clear: both;
  }

  .announcements > li {
    display: block;
    height: auto;
    float: left;
    padding: 0px 0.78125rem 1.5625rem;
  }

  .announcements > li {
    width: 50%;
    padding: 0px 0.78125rem 1.5625rem;
    list-style: none;
  }

  .announcements > li:nth-of-type(1n) {
    clear: none;
  }

  .announcements > li:nth-of-type(2n+1) {
    clear: both;
  }

  .announcements > li:nth-of-type(2n+1) {
    padding-left: 0rem;
    padding-right: 0.78125rem;
  }
}

.announcements.small {
  display: block;
  padding: 0px;
  margin: 0px;
  padding: 0;
  margin: 0;
}

.announcements.small::before,
.announcements.small::after {
  content: ' ';
  display: table;
}

.announcements.small::after {
  clear: both;
}

.announcements.small > li {
  display: block;
  height: auto;
  float: left;
  padding: 0px 0.78125rem 1.5625rem;
}

.announcements.small > li {
  width: 100%;
  padding: 0px 0.78125rem 1.5625rem;
  list-style: none;
}

.announcements.small > li:nth-of-type(1n) {
  clear: none;
}

.announcements.small > li:nth-of-type(1n+1) {
  clear: both;
}

.announcements.small > li:nth-of-type(1n) {
  padding-left: 0rem;
  padding-right: 0rem;
}

.announcements .announcement-card a {
  color: rgb(0, 0, 0);
  display: block;
  color: #000;
}

.division-topbar input[type="submit"] {
  -webkit-appearance: button;
  cursor: pointer;
}

.division-topbar input[type="search"] {
  -webkit-appearance: textfield;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}

.division-topbar *,
.division-topbar ::before,
.division-topbar ::after {
  box-sizing: border-box;
}

.division-topbar img {
  vertical-align: middle;
  height: auto;
  max-width: 100%;
}

.division-topbar a {
  text-decoration: none;
}

.clearfix::before,
.clearfix::after {
  content: ' ';
  display: table;
}

.clearfix::after {
  clear: both;
}

.clearfix {
  *zoom: 1;
}

.division-topbar {
  background-color: rgb(34, 34, 34);
  font-family: Arial, Helvetica, sans-serif;
  line-height: 1.5;
  position: relative;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #222;
}

.uiowa {
  line-height: 42px;
  display: block;
  float: left;
  opacity: .7;
  width: 177px;
}

.uiowa {
  display: block;
  float: left;
  opacity: 0.7;
  width: 177px;
  opacity: .7;
}

@media only screen and (min-width: 64.063em) {
  .uiowa {
    margin-left: 0px;
    margin-left: 0;
  }
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

.division-search {
  border-top-width: 1px;
  border-top-style: solid;
  border-top-color: rgb(0, 0, 0);
  -webkit-box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 0px inset;
  box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 0px inset;
  display: none;
  position: relative;
  left: 0px;
  bottom: 0px;
  border-top: 1px solid #000;
  -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
  -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
  left: 0;
  bottom: 0;
}

.division-search form {
  padding: 10px;
  margin: 0;
  position: relative;
}

@media only screen and (min-width: 64.063em) {
  .division-search {
    border-top-style: none;
    position: absolute;
    right: 13px;
    bottom: 7px;
    left: auto;
    -webkit-box-shadow: none;
    box-shadow: none;
    display: block !important;
    border-top: none;
    -moz-box-shadow: none;
  }

  .division-search form {
    padding: 0px;
    padding: 0;
  }
}

.division-search label {
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

.division-search form {
  margin: 0px;
  position: relative;
  padding: 10px;
  margin: 0;
}

.division-search input[type="search"].division-search-input {
  -webkit-appearance: textfield;
  box-sizing: border-box;
  background-color: rgb(255, 255, 255);
  border: 1px solid rgb(0, 0, 0);
  color: rgb(34, 34, 34);
  display: inline-block;
  font-size: 13px;
  font-family: arial, verdana, sans-serif;
  line-height: normal;
  padding: 5px 0px 4px 5px;
  position: relative;
  vertical-align: middle;
  width: 100%;
  margin: 4px 0px 0px;
  height: auto;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
  border-bottom-left-radius: 15px;
  transition: width 0.2s ease, background-color 0.2s ease;
  -webkit-transition: width 0.2s ease, background-color 0.2s ease;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #fff;
  border: 1px solid #000;
  color: #222;
  padding: 5px 0 4px 5px;
  margin-left: 0;
  margin-right: 0;
  margin-top: 4px;
  margin-bottom: 0;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
  -moz-transition: width 0.2s ease, background-color 0.2s ease;
}

@media only screen and (min-width: 64.063em) {
  .division-search input[type="search"].division-search-input {
    width: 120px;
  }
}

.division-search .division-search-btn {
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

.main .content {
  min-height: 320px;
}

@media only screen and (min-width: 64.063em) {
  .main .content {
    min-height: 600px;
  }
}

.gradient {
  background-color: rgb(255, 255, 255);
  position: relative;
  background-position: initial initial;
  background-repeat: initial initial;
  background: #ffffff;
}

@media only screen and (min-width: 64.063em) {
  .gradient {
    background-image: linear-gradient(to right, rgb(255, 255, 255) 60%, rgb(244, 244, 244) 40%);
    background-position: initial initial;
    background-repeat: initial initial;
    background: -moz-linear-gradient(left, #fff 60%, #f4f4f4 40%);
    background: -webkit-gradient(linear, left top, right top, color-stop(60%, #fff), color-stop(40%, #f4f4f4));
    background: -webkit-linear-gradient(left, #fff 60%, #f4f4f4 40%);
    background: -o-linear-gradient(left, #fff 60%, #f4f4f4 40%);
    background: -ms-linear-gradient(left, #fff 60%, #f4f4f4 40%);
    background: linear-gradient(to right, #fff 60%, #f4f4f4 40%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='$side-nav-bg',GradientType=1 );
  }
}

.white-cover {
  display: none;
}

@media only screen and (min-width: 64.063em) {
  .white-cover {
    background-color: rgb(255, 255, 255);
    border-right-width: 1px;
    border-right-style: solid;
    border-right-color: rgb(221, 221, 221);
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #fff;
    border-right: 1px solid #ddd;
  }
}

article {
  position: relative;
  z-index: 1000;
}

form label span {
  color: rgb(240, 65, 36);
  padding-right: 3px;
  color: #f04124;
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