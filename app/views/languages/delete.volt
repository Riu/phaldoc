<section class="span12">
<h3>Delete: {{ lang.langname }} ?</h3>
{% if lang.id == '1' %}
<p>I'm sorry, but you can't remove this language.</p>
{% else %}
<p>Do you really want to remove this language?</p>
{{ form('languages/delete/' ~ lang.id, 'method': 'post') }}
<button type="submit" class="btn btn-danger cb">Delete</button>
{{ link_to('languages','No, go back!','class':'btn') }}
{{ hidden_field("id", "value": lang.id) }}
{{ end_form() }}
{% endif %}
</section>
