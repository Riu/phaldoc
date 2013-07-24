<section class="span12">
<h3>Edit: {{ doc.title }}</h3>
<p>
{{ link_to('parts/' ~ part.file_id,'<i class="icon-arrow-up icon-white"></i> go to parts list','class':'btn btn-info') }}
</p>
{{ flashSession.output() }}
{{ form('parts/save/' ~ part.id, 'method': 'post') }}
<fieldset>
<label>Part title</label>
{{ text_field("title", "size": 32, "class":"span6") }}
{{ text_area("value", "class": "span11", "rows": 10) }}
<label>Type</label>
{% if part.ordinal > 1 %}
{{ select("type", ['2':'Sub title 2', '3':'Sub title 3']) }}
{% else %}
{{ select("type", ['1':'Main title']) }}
{% endif %}
<label>Status</label>
{{ select("status", ['1':'current version', '2':'out-of-date', '3':'new part', '4':'subparts to update']) }}
<label><button type="submit" class="btn btn-success cb">Save part</button></label>
</fieldset>
{{ end_form() }}

</section>
