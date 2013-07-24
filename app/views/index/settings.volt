<section class="span12">
<h3>Settings</h3>
<p>Your deafault language is <strong>{{ lang.langname }}</strong>. That give you list of files in chosen language.</p>
{% if langs %}
<table class="table table-striped table-condensed table-bordered">
<thead>
<tr>
<th>Short name</th>
<th>Full name</th>
<th></th>
</tr>
</thead>
<tbody>
{% for items in langs %}
<tr>
<td>{{ items.lang }}</td>
<td>{{ items.langname }}</td>
<td>
{{ link_to('lang/' ~ items.lang,'Choose language','class':'btn btn-success btn-small') }} 
</td>
</tr>
{% endfor %}
</tbody>
</table>
{% else %}
<p>There is no languages in database.</p>
{% endif %}
</section>
