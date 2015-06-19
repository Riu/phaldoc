{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>{{ i18n._('projects_title') }}</h3>
<p>Lista projektów dla których tworzona jest dokumentacja oraz tłumaczenie dokumentacji.</p>
{{ flashSession.output() }}
{% if projects is empty %}
<p>Nie ma jeszcze żadnych projektów</p>
{% else %}
<table class="table table-striped">
<thead><tr>
<th>ID</th>
<th>Nazwa</th>
<th>Opis</th>
<th>Wersja</th>
</tr>
</thead>
<tbody>
{% for project in projects %}
<tr>
<td>{{ project.id }}</td>
<td>{{ link_to('projects/view/' ~ project.id, '<strong>' ~ project.project ~ '</strong>', 'title':'Edytuj moduł ' ~ project.project ) }}</td>
<td>{{ project.describe }}</td>
<td>{{ project.version }}</td>
</tr>
{% endfor %}
</tbody>
</table>
{% endif %}
<p>{{ link_to('projects/add', '<i class="fa fa-plus"></i> Dodaj nowy projekt', "class":"btn btn-success btn-lg") }}</p>
</section>
{% endblock %}

