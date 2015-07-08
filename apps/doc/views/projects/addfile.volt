{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Dodaj nowy plik w projekcie {{ project.project }}</h3>
<p>Podaj nazwę nowego pliku.</p>
{{ flashSession.output() }}
{{ form('projects/addfile/' ~ project.id, 'method': 'post', 'class': 'form-horizontal') }}
<section class="form-group">
    <label class="col-lg-4 control-label" for="fullname">Nazwa pliku (tylko litery, bez polskich znaków):</label>
    <section class="col-lg-6">
    {{ text_field("rst", "size": 160,"placeholder": "Nazwa pliku...","class": "form-control") }}
    <span class="help-inline"></span>
    </section>
</section>

<section class="form-group">
     <section class="col-lg-offset-4 col-lg-4">
         <button type="submit" class="btn btn-success">Dodaj plik</button>
    </section>
</section>
{{ end_form() }}
</section>
{% endblock %}
