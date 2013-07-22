<section class="span12">
<h3>Delete: {{ file.rst }}.rst ?</h3>
{% if file.is_parent == '1' %}
<p>I'm sorry, but you can't remove this file because it has some {{ link_to('files/' ~ file.id,'subdocuments') }} .</p>
{% else %}
<p>Do you really want to remove this file?</p>
{{ form('files/delete/' ~ file.id, 'method': 'post') }}
<button type="submit" class="btn btn-danger cb">Delete</button>
{{ link_to('files/' ~ file.parent_id,'No, go back!','class':'btn') }}
{{ hidden_field("parent_id", "value": file.parent_id) }}
{{ end_form() }}
{% endif %}
</section>
