<div>
    <script src="https://cdn.tiny.cloud/1/he4tkwjgmx2j7r2l5pv1e9eoi0iqj84uvsdxvxiung4wq051/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: 'lists link image preview code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | preview code',
            branding: false,
            setup: function(editor) {
                editor.on('input', function() {
                    if (typeof updatePreview === 'function') {
                        updatePreview();
                    }
                });
                editor.on('change', function() {
                    if (typeof updatePreview === 'function') {
                        updatePreview();
                    }
                });
            },
            init_instance_callback: function(editor) {
                if (typeof updatePreview === 'function') {
                    updatePreview();
                }
            }
        });
    </script>
</div>
