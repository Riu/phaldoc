<section class="span12">
<h2>Setup</h2>
{% if part == "1" %}
<p>Good :). Now, click {{ link_to('setup/2', 'here') }} and generate all parts of fails. This operation need some time.</p>
{% elseif part == "2" %}
<p>It looks that there is all ok. Go {{ link_to('', 'index page') }}</p>
{% else %}
<p>First you need click {{ link_to('setup/1', 'here') }} and generate list of files.</p>
{% endif %}
</section>
