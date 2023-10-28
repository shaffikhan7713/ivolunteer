<footer class="tm-footer text-center">
    <p>Copyright &copy; 2023 Acrozzi</p>
</footer>
</div>
<script>
$(document).ready(function() {
    // Handle click on paging links
    $('.tm-paging-link').click(function(e) {
        e.preventDefault();

        var page = $(this).text().toLowerCase();
        $('.tm-gallery-page').addClass('hidden');
        $('#tm-gallery-page-' + page).removeClass('hidden');
        $('.tm-paging-link').removeClass('active');
        $(this).addClass("active");
    });
});
</script>
</body>

</html>