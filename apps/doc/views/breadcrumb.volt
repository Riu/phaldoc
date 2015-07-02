{% set crumbs = breadcrumb.render() %}
{% if crumbs.countcrumbs > 1 %}
<section class="container">
    <section class="row">
        <section class="col-lg-12">
        <ol class="breadcrumb">
            {% for index, item in crumbs.crumbs %}
            {% if crumbs.countcrumbs == item['i'] %}
                {% set link = item['title'] %}
            {% elseif index == 0 %}
                {% set link = link_to(item['url'], i18n._('b_title'), "title":i18n._('b_title')) %}
            {% else %}
                {% set link = link_to(item['url'],item['crumb'],"title":item['title']) %}
            {% endif %}
            <li>{{ link }}</li>
            {% endfor %}
        </ol>
        </section>
    </section>
</section>
{% endif %}