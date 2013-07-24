<section class="span12">
<h3>{{ title }}</h3>
{{ flashSession.output() }}
<p>
{% if id > 1 %}
{{ link_to('files/' ~ parent,'<i class="icon-arrow-up icon-white"></i> go to files list','class':'btn btn-info') }} 
{% else %}
{{ link_to('','<i class="icon-arrow-up icon-white"></i> go to files list','class':'btn btn-info') }} 
{% endif %}
{% if lang == '1' %}
{{ link_to('parts/add/' ~ id,'<i class="icon-plus icon-white"></i> add new part','class':'btn btn-success') }}
{% endif %}
</p>
{% if count %}
<table class="table table-striped table-condensed table-bordered">
<thead>
<tr>
<th>#</th>
<th>Title</th>
<th>Info</th>
{% if lang == '1' %}
<th></th>
<th></th>
{% endif %}
</tr>
</thead>
<tbody>
{% for part in parts %}
<tr>
<td>{{ part.ordinal }} </td>
<td>{{ link_to('parts/edit/' ~ part.id,part.title) }} </td>
<td>
{% if part.status == '1' %}
<span class="label label-success">current version</span>
{% elseif part.status == '2' %}
<span class="label label-important">out-of-date</span>
{% elseif part.status == '3' %}
<span class="label label-info">new part</span>
{% else %}
<span class="label label-warning">subparts to update</span>
{% endif %}

{% if part.is_tree == '1' %}
<span class="label label-inverse">has tree</span>
{% endif %}
</td>

<td>
{{ link_to('parts/edit/' ~ part.id,'<i class="icon-edit icon-white"></i>','class':'btn btn-mini btn-info') }}
</td>
{% if lang == '1' %}
<td>
{% if part.is_tree != '1' %}
{{ link_to('parts/delete/' ~ part.id,'<i class="icon-remove-sign icon-white"></i>','class':'btn btn-mini btn-danger') }}
{% endif %} 
</td>
<td>
{% if part.ordinal > '1' %}
{{ link_to('parts/move/' ~ part.id,'<i class="icon-arrow-up icon-white"></i>','class':'btn btn-inverse btn-mini') }} 
{% endif %}
</td>
{% endif %}
</tr>
{% endfor %}
</tbody>
</table>
{% else %}
<p>It looks that there is no parts in database.</p>
{% endif %}
</section>
