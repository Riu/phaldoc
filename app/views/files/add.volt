<section class="span12">
<h3>Add file</h3>
<p>
{% if file.parent_id > 1 %}
You can't add file in this file.<br>
{{ link_to('files/' ~ file.parent_id,'<i class="icon-arrow-up icon-white"></i> go to parent file','class':'btn btn-info') }}
{% else %}

{% endif %}
</p>
</section>
