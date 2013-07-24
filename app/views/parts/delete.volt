<section class="span12">
<h3>Delete part?</h3>
{% if part.is_tree == '1' %}
<p>I'm sorry, but you can't remove this part because it has tree of documents.</p>
{% else %}
<p>Do you really want to remove part <strong>{{ doc.title }}</strong>?</p>
{{ form('parts/delete/' ~ part.id, 'method': 'post') }}
<button type="submit" class="btn btn-danger cb">Delete</button>
{{ link_to('parts/' ~ part.file_id,'No, go back!','class':'btn') }}
{{ hidden_field("file_id", "value": part.file_id) }}
{{ end_form() }}
{% endif %}
</section>
