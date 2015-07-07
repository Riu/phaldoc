{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Usuwanie języka</h3>
<p>Na pewno chcesz usunąć język <strong>{{ langs.langname }}</strong> ?</p>
{{ flashSession.output() }}
</article>
{{ form('settings/delete/' ~ langs.id, 'method': 'post', 'class': 'form-horizontal') }}
        {{ hidden_field("id") }}
        <section class="form-group">
            <section class="col-lg-4">
                <button type="submit" class="btn btn-success btn-lg">Tak, usuń</button>
            </section>
        </section>
{{ end_form() }}
</section>
{% endblock %}
