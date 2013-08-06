<section class="navbar navbar-inverse navbar-fixed-top">
	<section class="navbar-inner">
		<section class="container">
		<section class="row">
			<section class="span12">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				{{ link_to('','PHALDOC','class':'brand') }}
				<section class="nav-collapse collapse">
				<ul class="nav pull-right">
				<li>{{ link_to('about','About','title':'About PHALDOC') }}</li>
				<li>{{ link_to('languages','Languages','title':'Languages') }}</li>
				<li>{{ link_to('json','Json','title':'Json') }}</li>
				<li>{{ link_to('settings','Settings','title':'Settings') }}</li>
				</ul>
				</section>
			</section>
		</section>
		</section>
	</section>
</section>
<section class="container">
	<section class="row">
{{ content() }}
	</section>
</section>
<footer id="footer">
	<section class="container">
		<section class="row">
			<section class="span12">
				<section class="footer">
		      			<p>Created by {{ link_to('https://github.com/Riu','Riu','title':'Riu') }}, in Phalcon {{ version() }}. Memory used: <?php echo number_format(memory_get_usage() / 1048576, 2) ?> mb.</p>
				</section>
			</section>
		</section>
	</section>
</footer>
