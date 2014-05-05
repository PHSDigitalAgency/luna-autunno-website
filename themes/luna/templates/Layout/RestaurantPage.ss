<article>
	<div class="row">
		<div class="span12">
			<h2>$MenuTitle</h2>
			<% if Content %>
			<div class="content">$Content</div>
			<% end_if %>
			<h3><% _t('RestaurantPage.MENU','Menu') %></h3>
		</div>
		<div id="menu" class="span8 scroll-pane">
			<div class="menu-content">$ContentMenu</div>
		</div>
		<% with getTranslation(en_US) %>
			<% if Images %>
			<div class="span4">
				<div id="carousel" class="carousel slide">
					<% if Images.Count > 1 %>
					<ol class="carousel-indicators">
					<% loop Images %>
						<li data-target="#carousel" data-slide-to="$Pos(0)"<% if Pos = 1 %> class="active"<% end_if %>></li>
					<% end_loop %>
					</ol>
					<% end_if %>
					<div class="carousel-inner">
						<% if Images %>
							<% loop Images %>
								<div class="item<% if Pos = 1 %> active<% end_if %>"><a href="$Image.URL" class="gallery" data-rel="gal">$Image.CroppedImage(370,420)</a></div>
							<% end_loop %>
						<% end_if %>
					</div>
				</div>
			</div>
			<% end_if %>
		<% end_with %>
	</div>
</article>