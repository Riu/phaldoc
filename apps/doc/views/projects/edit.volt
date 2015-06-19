{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h2>Edycja modułu</h2>
<p>Zmeniasz ustawienia projektu <em>{{ project.term }}</em>.</p>
{{ flashSession.output() }}
{{ form('projects/edit/' ~ project.id, 'method': 'post', 'class': 'form-horizontal') }}
<section class="form-group">
    <label class="col-lg-4 control-label" for="fullname">Nazwa projektu:</label>
    <section class="col-lg-6">
    {{ text_field("project", "size": 160,"placeholder": "Projekt...","class": "form-control") }}
    <span class="help-inline"></span>
    </section>
</section>
<section class="form-group">
    <label class="col-lg-4 control-label" for="fullname">Krótki opis:</label>
    <section class="col-lg-4">
    {{ text_field("describe", "size": 160,"placeholder": "Opis...","class": "form-control") }}
    <span class="help-inline"></span>
    </section>
</section>
<section class="form-group">
    <label class="col-lg-4 control-label" for="inputPassword">Status modułu:</label>
    <section class="col-lg-3">
    {{ text_field("version", "size": 160,"placeholder": "Wersja...","class": "form-control") }}
    </section>
</section>

<section class="form-group">
     <section class="col-lg-offset-4 col-lg-4">
         <button type="submit" class="btn btn-success">Zapisz zmiany</button>
    </section>
</section>
{{ end_form() }}
</section>
{% endblock %}
