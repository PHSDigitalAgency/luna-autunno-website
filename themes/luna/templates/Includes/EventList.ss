<ul id="events" class="media-list unstyled">
  <% loop Events %>
  <li class="media">
    <article>
      <% if Image %>
      <a class="pull-left img" href="$Image.URL" style='background-image:url("$Image.SetHeight(420).URL")' data-width="$Image.SetHeight(420).Width" data-height="$Image.SetHeight(420).Height"></a>
      <% end_if %>
      <div class="media-body">
        <div class="media-heading">
          <h4>$Title</h4>
          <p class="dates"><strong>$DateRange</strong><% if AllDay %> <i class="icon-time"></i> <small><% _t('ALLDAY','All Day') %></small><% else %><% if StartTime %> <i class="icon-time"></i> <small>$TimeRange</small><% end_if %><% end_if %></p>
        </div>
        <div class="event-detail">$Content2</div>
        <a href="$Link" class="more"><% _t('READMORE','Read more') %></a>
      </div>
    </article>
  </li>
  <% end_loop %>
</ul>
<% if MoreEvents %>
<p><a href="$MoreLink" class="calendar-view-more"><% _t('Calendar.VIEWMOREEVENTS','View more events...') %></a></p>
<% end_if %>