{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Usuwanie pliku z projektu {{ project.project }}</h3>
<p>Na pewno chcesz usunąć plik <strong>{{ file.rst }}</strong> ?</p>
{{ flashSession.output() }}
</article>
{{ form('projects/deletefile/' ~ project.id~ '/' ~ file.id, 'method': 'post', 'class': 'form-horizontal') }}
        {{ hidden_field("id") }}
        {{ hidden_field("fid") }}
        {{ hidden_field("parent") }}
        <section class="form-group">
            <section class="col-lg-4">
                <button type="submit" class="btn btn-success btn-lg">Tak, usuń</button>
            </section>
        </section>
{{ end_form() }}
</section>
{% endblock %}
