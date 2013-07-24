<section class="span12">
<h3>Add language</h3>
{{ flashSession.output() }}
{{ form('languages/create', 'method': 'post') }}
<fieldset>
<label>Short lang name (2 letters)</label>
{{ text_field("lang", "size": 2, "class":"span1") }}
<label>Name of language</label>
{{ text_field("langname", "size": 32, "class":"span6") }}
<label><button type="submit" class="btn btn-success cb">Add lang</button></label>
</fieldset>
{{ end_form() }}
</section>
