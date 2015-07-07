{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>Edycja informacji o języku</h3>
<p>Zmeniasz ustawienia języka <em>{{ langs.langname }}</em>.</p>
{{ flashSession.output() }}
{{ form('settings/edit/' ~ langs.id, 'method': 'post', 'class': 'form-horizontal') }}
<section class="form-group">
    <label class="col-lg-4 control-label" for="fullname">Nazwa języka:</label>
    <section class="col-lg-6">
    {{ text_field("langname", "size": 160,"placeholder": "Jezyk...","class": "form-control") }}
    <span class="help-inline"></span>
    </section>
</section>
<section class="form-group">
    <label class="col-lg-4 control-label" for="fullname">Skrót języka:</label>
    <section class="col-lg-4">
    {{ text_field("lang", "size": 160,"placeholder": "Skrót...","class": "form-control") }}
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
