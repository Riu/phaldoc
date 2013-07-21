<section class="span12">
<h2>Files</h2>
{% if count %}
<table class="table table-striped">
<thead>
<tr>
<th>Short name</th>
<th>Full name</th>
<th>Type</th>
<th></th>
</tr>
</thead>
<tbody>
{% for file in files %}
<tr>
<td>{{ file.title }}</td>
<td>{{ file.rst }}</td>
{% if file.type == '1' %}
<td>Main file</td>
{% elseif file.type == '2' %}
<td>Reference</td>
{% else %}
<td>API</td>
{% endif %}
<td>
{{ link_to('lang/' ~ file.id,'Choose language','class':'btn btn-success btn-small') }} 
</td>
</tr>
{% endfor %}
</tbody>
</table>
{% else %}
<p>It looks that there is no files in database. Click {{ link_to('setup', 'here') }} and generate list of files.</p>
{% endif %}
</section>
