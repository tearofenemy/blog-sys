@section('script')
    <script lang="js">
    $(function() {
        $('ul.pagination').addClass('no-margin pagination-xs');
        $('select#category_id').addClass('form-control');

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

        //text editor init
        var simplemde_excerpt = new SimpleMDE({ element: document.getElementById("excerpt") });
        var simplemde_body = new SimpleMDE({ element: document.getElementById("body") });

        //date time picker init
        $('#datetimepicker1').datetimepicker({
            format: "Y-M-D HH:mm:ss",
            showClear: true
        });

        // save post as draft
        $("#draft-btn").click(function(e) {
            e.preventDefault();
            $("#published_at").val("");
            $("#post-form").submit();
        })
    });
</script>

@endsection
