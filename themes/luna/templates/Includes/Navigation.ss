<div class="nav-collapse collapse">
	<ul class="nav">
		<% loop $Menu(1) %>
			<% if ClassName = RestaurantPageHolder %>
				<li class="<% if $LinkOrSection = section %>active<% else %>link<% end_if %> dropdown"{$Top.StyleMenuBar}>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						$MenuTitle.XML
						<b class="caret"></b>
					</a>
					<% if Children %>
					<ul class="dropdown-menu">
						<% loop Children %>
						<li class="<% if $LinkingMode = current %>active<% else %>link<% end_if %>">
							<a href="$Link">$MenuTitle.XML</a>
						</li>
						<% end_loop %>
					</ul>
					<% end_if %>
			<% else %>
			<li class="<% if $LinkingMode = current %>active<% else %>link<% end_if %>"{$Top.StyleMenuBar}>
					<a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
			<% end_if %>
			</li>
		<% end_loop %>
	</ul>
</div>