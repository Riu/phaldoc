{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>{{ i18n._('settings_title') }}</h3>
<p>Lista języków.</p>
{{ flashSession.output() }}
{% if langs is empty %}
<p>Nie ma jeszcze żadnych języków</p>
{% else %}
<table class="table table-striped">
<thead><tr>
<th>ID</th>
<th>Nazwa</th>
<th>Skrót</th>
<th></th>
</tr>
</thead>
<tbody>
{% for lang in langs %}
<tr>
<td>{{ lang.id }}</td>
<td>{{ link_to('settings/edit/' ~ lang.id, '<strong>' ~ lang.langname ~ '</strong>', 'title':'Edytuj język ' ~ lang.langname ) }}</td>
<td>{{ lang.lang }}</td>
<td>{{ link_to('settings/edit/' ~ lang.id, 'Edytuj jezyk', 'title':'Edytuj język', "class":"btn btn-info btn-sm" ) }} {{ link_to('settings/delete/' ~ lang.id, 'Usuń język', 'title':'Usuń język', "class":"btn btn-warning btn-sm" ) }}</td>
</tr>
{% endfor %}
</tbody>
</table>
{% endif %}
<p>{{ link_to('settings/add', '<i class="fa fa-plus"></i> Dodaj nowy język', "class":"btn btn-success btn-lg") }} {{ link_to('settings/settings', '<i class="fa fa-plus"></i> Zmień ustawienia w pliku konfiguracyjnym', "class":"btn btn-default pull-right btn-lg") }}</p>
</section>
{% endblock %}

