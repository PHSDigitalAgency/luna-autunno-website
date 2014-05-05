<footer>
<div class="line"></div>
	<div id="footer" class="row text-center">
	<% with PageByLang(luna-jsc,en_US) %>
		<% if Addresses %>
		<div class="span4">
			<div class="row">
				<div class="span4 group">
					<div class="row">
						<h4 class="span4"><a href="$Link" title="$Title">$Title</a></h4>
						<ul class="unstyled row">
							<% loop Addresses %>
							<li class="span2">
								<address>
								<% if City %><strong>$City</strong><br/><% end_if %>
								<% if Address %>$Address.RAW<br/><% end_if %>
								<% if Phone %>$Phone<br/><% end_if %>
								<% if Phone2 %>$Phone2<br/><% end_if %>
								<% if Email %><a href="mailto:$Email" class="email" title="<% sprintf(_t('Footer.EMAIL','Send us an email at %s'),$Email) %>">$Email</a><br/><% end_if %>
								</address>
							</li>
							<% end_loop %>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<% else %>
			<% with Up.Page(luna-jsc) %>
			<div class="span4">
				<div class="row">
					<div class="span4 group">
						<div class="row">
							<h4 class="span4"><a href="$Link" title="$Title">$Title</a></h4>
							<ul class="unstyled row">
								<% loop Addresses %>
								<li class="span2">
									<address>
									<% if City %><strong>$City</strong><br/><% end_if %>
									<% if Address %>$Address.RAW<br/><% end_if %>
									<% if Phone %>$Phone<br/><% end_if %>
									<% if Phone2 %>$Phone2<br/><% end_if %>
									<% if Email %><a href="mailto:$Email" class="email" title="<% sprintf(_t('Footer.EMAIL','Send us an email at %s'),$Email) %>">$Email</a><br/><% end_if %>
									</address>
								</li>
								<% end_loop %>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<% end_with %>
		<% end_if %>
	<% end_with %>
	<% with PageByLang(restaurants,en_US) %>
		<% if Children %>
		<div class="span4">
			<div class="row">
				<div class="span4 group">
					<div class="row">
						<h4 class="span4">$Children.First.Title</h4>
						<ul class="unstyled row">
							<% loop Children %>
								<% if NewGroup = true %>
								</ul>
								</div>
								</div>
								</div>
								</div>
								<div class="span4">
									<div class="row">
										<div class="span4 group">
											<div class="row">
												<h4 class="span4">$Title</h4>
												<ul class="unstyled row">
								<% end_if %>
								<li class="<% if NewGroup = true %>span4<% else %>span2<% end_if %>">
									<address>
									<% if City %><a href="$Link" title="$Name"><strong>$City</strong></a><br/><% end_if %>
									<% if Address %>$Address.RAW<br/><% end_if %>
									<% if Phone %>$Phone<br/><% end_if %>
									<% if Phone2 %>$Phone2<br/><% end_if %>
									<% if Email %><a href="mailto:$Email" class="email" title="<% sprintf(_t('Footer.EMAIL','Send us an email at %s'),$Email) %>">$Email</a><br/><% end_if %>
									</address>
								</li>
							<% end_loop %>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<% end_if %>
	<% end_with %>
	</div>
</footer>