@section('script')
    <script>
    $(function() {
        $('ul.pagination').addClass('no-margin pagination-xs');

        //copy val from title to slug fith regex
        $('#title').on('blur', function() {
            var title_value = this.value.toLowerCase().trim();
            var slug = $('#slug'),
                slugVal = title_value.replace(/[^a-z0-9-]+/g, "-")
                                    .replace(/\-\-+/g, "-")
                                    .replace(/^-+|-+$/g, "")
                                    .replace(/&/g, "-and-");
            slug.val(slugVal);
        });

        $('#close_session_msg').click(function() {
            $('.alert-danger').fadeOut(300);
        });
    });
</script>

@endsection
