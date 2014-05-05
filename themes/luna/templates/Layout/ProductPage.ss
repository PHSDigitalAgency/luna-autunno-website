<div class="row">
	<div class="span12">
		<h2>$Title</h2>
		<% with getTranslation(en_US) %>
		<% if Images %>
		<div class="row">
			<ul class="unstyled">
			<% loop Images %>
				<% if Image %>
				<li class="span2 clearfix"><a class="gallery product" href="$Image.URL" data-rel="gallery">$Image.SetSize(150,170)</a></li>
				<% end_if %>
			<% end_loop %>
			</ul>
		</div>
		<% end_if %>
		<% end_with %>
		<div class="content">$Content</div>
	</div>
</div>