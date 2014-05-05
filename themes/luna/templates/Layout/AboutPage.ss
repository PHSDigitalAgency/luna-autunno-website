<div class="row">
	<div class="span7">
		<article>
			<h2>$Title</h2>
			<div class="content border">$Content</div>
		</article>
		$Form
		$PageComments
	</div>
	<% with getTranslation(en_US) %>
	<% if Images %>
	<div class="span5">
		<% loop Images %>
			<% if Image %>
			<p>$Image.SetWidth(470)</p>
			<% end_if %>
		<% end_loop %>
	</div>
	<% end_if %>
	<% end_with %>
</div>