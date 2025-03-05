var quill;
function clearEditorContent() {
    if (quill) {
        quill.setContents([]);
    }
}
function setQuillData(data) {
    if (quill) {
        quill.clipboard.dangerouslyPasteHTML(data);
        // quill.setContents(data);
    }
}
function insertQuillDataToCurserPosition(data) {
    if (quill) {
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, data);
    }
}
$(document).ready(function() {
    $('.btnPause').hide();
    $('.btnStop').hide();

    // $('.sidebar').css('min-height', $(window).height() - $('.headerbar').height() - 107);
    // $('.sidebar').css('min-height', $(window).height());
    $(document).on("click", ".collapse_side_bar", function() {
        $('.sidebar_div').toggle('slow');
    });

    $('.dateRange').each(function(){
        $(this).daterangepicker({
            "autoApply": true,
        }, function(start, end, label) {
          console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    });

    $(document).on("click", ".collapsable_btn", function() {
        $(this).closest('.collapsable_div').find('.collapsable_content').toggle('slow');
        var arrow = $(this).closest('.collapsable_div').find('.collapsable_arrow').attr('src');
        if (arrow.indexOf('arrow-down-grey.svg') != -1) {
            $(this).closest('.collapsable_div').find('.collapsable_arrow').attr('src', './assets/images/arrow-up-grey.svg');
        } else {
            $(this).closest('.collapsable_div').find('.collapsable_arrow').attr('src', './assets/images/arrow-down-grey.svg');
        }
    });

    $(document).on("click", ".btnColorPicker", function() {
        $(this).closest('.colorPickerDiv').find('.inputColorPicker').trigger('click');
    });

    $(document).on("change", ".inputColorPicker", function() {
        var color = $(this).val();
        $(this).closest('.colorPickerDiv').find('.btnColorPicker').css('background',color);
    });

    $(document).on("click", ".btnupload", function() {
        $(this).closest('.uploadDiv').find('.uploadfile').trigger('click');
    });



    var toolbarOptions = [
        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values

        ['bold', 'italic'], // toggled buttons

        [{
            'align': []
        }],
        [{
            'color': []
        }],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        ['link', 'image'],
    ];
    var options = {
        modules: {
            toolbar: toolbarOptions,
        },
        theme: 'snow'
    };
    if ($('.quilleditor').length) {
        var options = {
            theme: 'snow',
        };
        quill = new Quill('.quilleditor', options);

        quill.on('text-change', function(delta, oldDelta, source) {
            $('#email_body').val(quill.root.innerHTML);
        });
    }

});