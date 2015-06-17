<section class="container">
    <section class="row">
        <section class="col-lg-12">
            <section class="copyright">
                <p>{{ i18n._('footer_statsfor') }} Phaldoc. {{ i18n._('footer_memoryusage') }} <b><?php echo number_format(memory_get_usage() / 1048576, 2) ?> mb</b>. {{ i18n._('footer_version') }} <b>{{ version() }}</b></p>
            </section>
        </section>
    </section>
</section>
