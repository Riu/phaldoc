{% extends "template.volt" %}
{% block content %}
<article>
<h2>Usuwanie projektu</h2>
<p>Na pewno chcesz usunąć projekt <strong>{{ project.term }}</strong> ?</p>
{{ flashSession.output() }}
</article>
{{ form('projects/delete/' ~ project.id, 'method': 'post', 'class': 'form-horizontal') }}
        {{ hidden_field("id") }}
        <section class="form-group">
            <section class="col-lg-4">
                <button type="submit" class="btn btn-success btn-lg">Tak, usuń</button>
            </section>
        </section>
{{ end_form() }}
{% endblock %}
