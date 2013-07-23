<section class="span12">
<h3>Add file</h3>
{% if file.parent_id > 1 %}
<p>You can't add file in this file.<br>
{{ link_to('files/' ~ file.parent_id,'<i class="icon-arrow-up icon-white"></i> go to parent file','class':'btn btn-info') }}</p>
{% else %}
	<p>You add subdocument for <strong>{{ file.rst }}.rst</strong></p>
	{{ form('files/create/' ~ file.id, 'method': 'post') }}
	<fieldset>
	<label>File name</label>
	{{ text_field("rst", "size": 32, "class":"span6") }}
	<label>Title of subdocument</label>
	{{ text_field("title", "size": 32, "class":"span6") }}
	{{ hidden_field("type", "value": file.type) }}
	{{ hidden_field("ordinal", "value": ordinal) }}
	<label><button type="submit" class="btn btn-success cb">Add file</button></label>
	</fieldset>
	{{ end_form() }}
{% endif %}

</section>
