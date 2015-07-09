{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Dodaj nowy element do pliku {{ file.rst }}</h3>
<p>Podaj typ oraz uzupełnij pole lementu.</p>
{{ flashSession.output() }}
{{ form('projects/addfile/' ~ project.id~ '/' ~ file.id, 'method': 'post', 'class': 'form-horizontal') }}
<section class="form-group">
    <section class="col-lg-4">
    {{ select("element", elements, "class": "form-control") }}
    <span class="help-inline"></span>
    </section>
</section>
<section class="form-group">
    <section class="col-lg-8">
    {{ text_area("data", "class": "form-control", "rows":"10") }}
    <span class="help-inline"></span>
    </section>
</section>
<section class="form-group">
     <section class="col-lg-4">
         <button type="submit" class="btn btn-success">Dodaj nowy element</button>
    </section>
</section>
{{ end_form() }}
</section>
{% endblock %}
