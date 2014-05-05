<header>
	<div class="header">
		<% if Translations %>
		<div class="pull-right lang">
			<ul class="unstyled">
				<% loop Translations %>
				<li class="$Locale.RFC1766">
					<a href="$Link" hreflang="$Locale.RFC1766" title="$Title" class="flag $Locale.RFC1766"></a>
				</li>
				<% end_loop %>
			</ul>
		</div>
		<% end_if %>

		<% if ClassName = RestaurantPage %>
			<% if PubHeader %>
			<div class="pull-right pub text-center">
				<div class="border">
					$PubHeader.RAW
				</div>
			</div>
			<% end_if %>
		<% end_if %>

		<div<%--  class="pull-left" --%>>
			<h1 class="hide-header">$SiteConfig.Title</h1>
			<% if $SiteConfig.Tagline %><p class="hide-header">$SiteConfig.Tagline</p><% end_if %>
			<div class="logo">
				<% if LogoImage %>
					$LogoImage
				<% else %>
					<% if ClassName = ProductPage %>
						<% with PageByLang(luna-jsc,en_US) %>
							<% if LogoImage %>
								$LogoImage
							<% end_if %>
						<% end_with %>
					<% else %>
						<% with PageByLang(home,en_US) %>
							<% if LogoImage %>
								$LogoImage
							<% end_if %>
						<% end_with %>
					<% end_if %>
				<% end_if %>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="navbar-extended<% if CouleurMenu = black %> navbar-extended-inverse<% end_if%>"></div>
	<div class="navbar<% if CouleurMenu = black %> navbar-inverse<% end_if%>">
		<div class="navbar-inner">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<% include Navigation %>
		</div>
	</div>
</header>