<footer class="footer">
    <div class="footer-container">
        <p class="text-muted">	&copy; Andy Tan <?php echo date('Y'); ?></p>
    </div>
</footer>

@yield('modals')

<!-- JavaScripts -->
{!! Html::script('/components/jquery/dist/jquery.min.js') !!}
{!! Html::script('/components/bootstrap/dist/js/bootstrap.min.js') !!}

@yield('js_scripts')

</body>
</html>
