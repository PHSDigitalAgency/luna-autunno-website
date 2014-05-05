<div class="row">
	<div class="span10">
		<h2 class="hide">$Title</h2>
		<div class="content">$Content</div>
		<div class="row">
			<div class="span12">
				<ul id="type-selection" class="unstyled inline">
					<li class="active">
						<a href="#<% _t('ALLPRODUCTS','All Products') %>" class="all-products"><strong><% _t('ProductPageHolder.ALLPRODUCTS','All Products') %></strong></a> - 
					</li>
					<% loop TypeProduct %>
					<li>
						<a href="#$Title.XML" class="$ProductClass"><strong>$Title</strong></a><% if Last %><% else %> - <% end_if %>
					</li>
					<% end_loop %>
				</ul>
			</div>
		</div>
		<div class="row">
			<ul id="product-selection" class="unstyled inline scroll-pane">
			<% loop Children %>
				<% if TypeProduct %>
				<li class="span2 clearfix $TypeProduct.ProductClass">
					
					<% with getTranslation(en_US) %>
						<%-- if Images.First.Image --%>
							<%-- <a href="$Up.Link" class="clearfix">$Images.First.Image.SetSize(150,170)</a> --%>
						<%-- end_if --%>
						<% loop Images %>
							<a href="$Image.URL" class="clearfix gallery<%if Pos = 1 %><% else %> hide<% end_if %>" data-title="$Up.Title.XML - $Up.Up.TypeProduct.Title.XML" data-rel="$Up.Up.TypeProduct.Title.XML">$Image.SetSize(150,170)</a>
						<% end_loop %>
					<% end_with %>

					<a class="link" href="$Link">$Title</a>
					$Content
				</li>
				<% end_if %>
			<% end_loop %>
			</ul>
		</div>
		$Form
		$PageComments
	</div>
	<% with getTranslation(en_US) %>
	<% if Images %>
	<div class="span2">
		<div id="carousel" class="carousel slide">
		<% if Images.Count > 1 %>
			<ol class="carousel-indicators">
			<% loop Images %>
				<li data-target="#carousel" data-slide-to="$Pos(0)"<% if Pos = 1 %> class="active"<% end_if %>></li>
			<% end_loop %>
			</ol>
		<% end_if %>
			<div class="carousel-inner">
			<% loop Images %>
				<div class="item<% if Pos = 1 %> active<% end_if %>">$Image.CroppedImage(170,420)</div>
			<% end_loop %>
			</div>
		</div>
	</div>
	<% end_if %>
	<% end_with %>
</div>