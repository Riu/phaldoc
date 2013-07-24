<section class="span12">
<h3>Languages</h3>
{{ flashSession.output() }}
<p>
{{ link_to('languages/add','<i class="icon-plus icon-white"></i> add new language','class':'btn btn-success') }}
</p>
{% if count %}
<table class="table table-striped table-condensed table-bordered">
<thead>
<tr>
<th>Short name</th>
<th>Full name</th>
<th></th>
</tr>
</thead>
<tbody>
{% for lang in langs %}
<tr>
<td>{{ lang.lang }}</td>
<td>{{ lang.langname }}</td>
<td>
{% if lang.id != '1' %}
{{ link_to('languages/delete/' ~ file.file_id,'<i class="icon-remove-sign icon-white"></i>','class':'btn btn-mini btn-danger') }}
{% endif %}
</td>
</tr>
{% endfor %}
</tbody>
</table>
{% endif %}
</section>
