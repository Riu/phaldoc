<section class="span12">
<h3>{{ title }}</h3>
<p>
{% if id > 1 %}
{{ link_to('files/' ~ parent,'<i class="icon-arrow-up icon-white"></i> go to parent list','class':'btn btn-info') }} 
{% endif %}
{% if lang == '1' %}
{{ link_to('files/add/' ~ parent,'<i class="icon-plus icon-white"></i> add new file','class':'btn btn-success') }}
{% endif %}
</p>
{% if count %}
<table class="table table-striped table-condensed table-bordered">
<thead>
<tr>
<th>#</th>
<th>Title</th>
<th>Parts</th>
<th>Info</th>
{% if lang == '1' %}
{% if id == '1' %}
<th></th>
{% endif %}
<th></th>
<th></th>
{% endif %}
</tr>
</thead>
<tbody>
{% for file in files %}
<tr>
<td>{{ file.ordinal }} </td>
<td>{{ link_to('parts/' ~ file.file_id,file.title) }} </td>
<td>
{% if file.is_parent == '1' %}
{{ link_to('files/' ~ file.file_id,'<i class="icon-folder-open icon-white"></i> view subdocuments','class':'btn btn-info btn-small btn-subs') }} 
<br>
{% endif %}
{{ link_to('parts/' ~ file.file_id,'<i class="icon-th-list"></i> view parts of files','class':'btn btn-mini') }} 
</td>
<td>
{% if file.status == '1' %}
<span class="label label-success">current version</span>
{% elseif file.status == '2' %}
<span class="label label-important">out-of-date</span>
{% elseif file.status == '3' %}
<span class="label label-info">new part</span>
{% else %}
<span class="label label-warning">subparts to update</span>
{% endif %}

<span class="label label-inverse">{{ file.rst }}</span>
{% if file.type == '1' %}
<span class="label">Main file</span>
{% elseif file.type == '2' %}
<span class="label">Reference</span>
{% else %}
<span class="label">API</span>
{% endif %}
</td>
{% if lang == '1' %}
{% if id == '1' %}
<th>{{ link_to('files/add/' ~ file.file_id,'<i class="icon-plus-sign icon-white"></i>','class':'btn btn-mini btn-success') }}</th>
{% endif %}
<td>
{% if file.file_id > '1' %}
{% if file.is_parent != '1' %}
{{ link_to('files/delete/' ~ file.file_id,'<i class="icon-remove-sign icon-white"></i>','class':'btn btn-mini btn-danger') }}
{% endif %} 
{% endif %}
</td>
<td>
{% if file.ordinal > '1' %}
{{ link_to('files/move/' ~ file.file_id,'<i class="icon-arrow-up icon-white"></i>','class':'btn btn-inverse btn-mini') }} 
{% endif %}
</td>
{% endif %}
</tr>
{% endfor %}
</tbody>
</table>
{% else %}
<p>It looks that there is no files in database. Click {{ link_to('setup', 'here') }} and generate list of files.</p>
{% endif %}
</section>
