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
<label>Type</label>
{{ select("type", ['2':'Sub title 2', '3':'Sub title 3']) }}

<label><button type="submit" class="btn btn-success cb">Add part</button></label>
</fieldset>
{{ end_form() }}

</section>
