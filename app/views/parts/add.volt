<section class="span12">
<h3>Add part</h3>
<p>
{{ link_to('parts/' ~ file.parent_id,'<i class="icon-arrow-up icon-white"></i> go to parts list','class':'btn btn-info') }}
</p>
<p>You add part of file: <strong>{{ file.rst }}.rst</strong></p>
{{ flashSession.output() }}
{{ form('parts/create/' ~ file.id, 'method': 'post') }}
<fieldset>
<label>Part title</label>
{{ text_field("title", "size": 32, "class":"span6") }}
<label>Type</label>
{{ select("type", ['2':'Sub title 2', '3':'Sub title 3']) }}
{{ hidden_field("ordinal", "value": ordinal) }}
<label><button type="submit" class="btn btn-success cb">Add part</button></label>
</fieldset>
{{ end_form() }}
</section>
