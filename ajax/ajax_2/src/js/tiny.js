'use strict'

$(function(){

    $('textarea#content').tinymce({
        width:500,
        height: 500,
        menubar: false,
        valid_elements: 'p[style],strong,em,span[style],a[href],ul,ol,li',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        language: 'fr_FR'
    });
});