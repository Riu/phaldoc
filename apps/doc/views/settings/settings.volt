{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Ustawienia konfiguracji</h3>
<p>Uwaga! Zmiana tych danych będzie mieć wpływ na (nie)poprawne działanie całej strony.</p>
{{ flashSession.output() }}
{{ form('settings/settings', 'method': 'post', 'class': 'form-horizontal') }}
<section class="form-group">
    <section class="col-lg-8">
    {{ text_area("data", "class": "form-control", "rows":"15") }}
    <span class="help-inline"></span>
    </section>
</section>


<section class="form-group">
     <section class="col-lg-4">
         <button type="submit" class="btn btn-success">Zapisz ustawienia</button>
    </section>
</section>
{{ end_form() }}
</section>
{% endblock %}
