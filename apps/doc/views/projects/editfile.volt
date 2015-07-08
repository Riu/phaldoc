{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Edycja pliku w projekcie {{ project.project }}</h3>
<p>Zmeniasz ustawienia pliku <em>{{ file.rst }}</em>.</p>
{{ flashSession.output() }}
{{ form('projects/editfile/' ~ project.id~ '/' ~ file.id, 'method': 'post', 'class': 'form-horizontal') }}
<section class="form-group">
    <label class="col-lg-4 control-label" for="fullname">Nazwa pliku (tylko litery, bez polskich znaków):</label>
    <section class="col-lg-6">
    {{ text_field("rst", "size": 160,"placeholder": "Nazwa pliku...","class": "form-control") }}
    <span class="help-inline"></span>
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
