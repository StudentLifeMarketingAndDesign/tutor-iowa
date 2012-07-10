<ul>
 	<% control Menu(1) %>	  
  		<li><a href="$Link" title="Go to the $Title.XML page" class="$LinkingMode"><span>$MenuTitle.XML</span></a></li>
   	<% end_control %>
   	<% if CurrentMember %>
   		<li>
   			<a href="home/logout" title="Logout">Logout</a>
   		</li>
   	<% else %>
   		<li>
   			<a href="Security/login" title="Login">Login</a>
   		</li>
   	<% end_if %>
 </ul>