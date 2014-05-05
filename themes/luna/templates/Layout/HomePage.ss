<% if Form %>
<div class="row">
	<div class="span12">
	$Form
	</div>
</div>
<% end_if %>
<div class="row">
	<div class="span12">
		<h2><% _t('HomePage.EVENTS','Events') %></h2>
	</div>
	<div class="span5">
		<% if Events %>
			<% include EventList %>
		<% else %>
			<p><% _t('HomePage.NOEVENTS','There are no events') %>.</p>
		<% end_if %>
	</div>
	<div class="span7">
		<div id="carousel" class="carousel slide">
		<% with getTranslation(en_US) %>
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
						<div class="item<% if Pos = 1 %> active<% end_if %>"><a href="$Image.URL" class="gallery" data-rel="gal">$Image.CroppedImage(670,420)</a></div>
					<% end_loop %>
				<% end_if %>
				</div>
		<% end_with %>
		</div>
	</div>
</div>