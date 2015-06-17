<section class="navbar navbar-default navbar-static-top">
    <section class="container">
        <section class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ link_to('','Phaldoc','class':'navbar-brand') }}
        </section>
        <section class="collapse navbar-collapse bs-navbar-collapse">
        <ul class="nav navbar-nav pull-left">
        <li>{{ link_to('projects','<i class="glyphicon glyphicon-tags"></i> '~ i18n._('projects_title')) }}</li>
        <li>{{ link_to('settings','<i class="glyphicon glyphicon-tower"></i> '~ i18n._('settings_title')) }}</li>
        <li>{{ link_to('activity','<i class="glyphicon glyphicon-stats"></i> '~ i18n._('activity_title')) }}</li>
        </ul>
<ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ i18n._('phaldoc_changelg') }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>{{ link_to('lg/pl','Polski') }}</li>
            <li>{{ link_to('lg/en','English') }}</li>
          </ul>
        </li>
      </ul>
        </section>
    </section>
</section>
