{% extends "template.volt" %}
{% block content %}
<section class="col-lg-12">
<h3>{{ project.project }} - {{ file.rst }}</h3>
<p>Lista elementów pliku {{ file.rst }}.</p>
{{ flashSession.output() }}
{% if liness is empty %}
<p>Nie ma jeszcze żadnych elementów</p>
{% else %}
<table class="table table-striped">
<thead><tr>
<th>ID</th>
<th>Nazwa</th>
<th></th>
</tr>
</thead>
<tbody>
{% for file in files %}
<tr>
<td>{{ file.id }}</td>
<td>{{ link_to('projects/viewfile/' ~ file.project_id ~ '/' ~ file.id, '<strong>' ~ file.rst ~ '</strong>', 'title':'Edytuj plik ' ~ file.rst ) }}</td>
<td>{{ link_to('projects/viewfile/' ~ file.project_id ~ '/' ~ file.id, 'Przeglądaj elementy tego pliku', 'title':'Przeglądaj elementy tego pliku', "class":"btn btn-primary btn-sm" ) }} {{ link_to('projects/editfile/' ~ file.project_id ~ '/' ~ file.id, 'Edytuj plik', 'title':'Edytuj plik', "class":"btn btn-info btn-sm" ) }} {{ link_to('projects/deletefile/' ~ file.project_id ~ '/' ~ file.id, 'Usuń plik', 'title':'Usuń plik', "class":"btn btn-warning btn-sm" ) }}
{% if file.ordinal > 1 %}
 {{ link_to('projects/movefile/' ~ file.project_id ~ '/' ~ file.id, 'Przesuń do góry <i class="glyphicon glyphicon-chevron-up"></i>', 'title':'Przesuń plik plik', "class":"btn btn-success btn-sm" ) }}
{% endif %}
</td>
</tr>
{% endfor %}
</tbody>
</table>
{% endif %}
<p>{{ link_to('projects/addline/' ~ file.project_id ~ '/' ~ file.id, '<i class="fa fa-plus"></i> Dodaj nowy element', "class":"btn btn-success") }}</p>
</section>
{% endblock %}

