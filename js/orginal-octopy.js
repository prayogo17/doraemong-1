$(function() {
    bs_input_file();
});

$(document).ready(function() {

    client();


    $('input[type="file"').bind('change', function() {

        var type = this.files[0].type; // image/jpg, image/png, image/jpeg...

        // allow jpg, png, jpeg, bmp, gif, ico
        var type_reg = /^image\/(jpg|png|jpeg|bmp|gif|ico)$/;

        if (!type_reg.test(type)) {
            toastr.warning('Only image allowed to upload.');
            return false;
        }

        var size = this.files[0].size / 1024;
        if (size > 512) {
            toastr.warning('Max attachment size : 512kb.');
            $(this).val('');
            $(this).next(this).find('input').val('');
        }
    });

    $('.panel-left').resizable({
        handleSelector: '.splitter',
        resizeHeight: false
    });

    $('.panel-top').resizable({
        handleSelector: '.splitter-horizontal',
        resizeWidth: false
    });

    $('select').select2({
        height: '38px'
    });

    var canvas = document.getElementById("signature");
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgba(255, 255, 255, 1)',
        penColor: 'rgb(0, 0, 0)'
    });

    $('#erase').click(function(event) {
        signaturePad.clear();
    });

    $('button#save').click(function(event) {
        $('input').each(function(index, el) {
            // console.log(el);
            console.log(el);
            if (el.name != '' && el.name != 'signature') {
                if (el.value == '') {
                    toastr.warning('Please fill out all fields.');
                    return false;
                }
            }

        });

        if (signaturePad.isEmpty()) {
            toastr.warning('Signature is empty');
        } else {
            $('input[name="signature"]').val(signaturePad.toDataURL());
            $('form').submit();
        }
    });

});

function client() {
    $('tbody').load('action.php', function() {
        $('table').DataTable({
            language: {
                sLengthMenu: '',
                sSearch: '',
                sSearchPlaceholder: 'Search...',
                sInfo: ''
            },

            sWrapper: "dataTables_wrapper form-inline dt-bootstrap",
            sFilterInput: "form-control input-sm",
            sLengthSelect: "form-control input-sm",
            sProcessing: "dataTables_processing panel panel-default",
            scrollX: true,
            drawCallback: function() {
                $('.dataTables_filter input').addClass('form-control').attr('style', 'width:auto;');
                $('.dataTables_scrollBody').niceScroll();
            }
        });
    });
}

function bs_input_file() {
    $(".input-file").before(
        function() {
            if (!$(this).prev().hasClass('input-ghost')) {
                var element = $("<input type='file' class='input-ghost' accept='image/*' size='512KB' style='visibility:hidden; height:0'>");
                element.attr("name", 'attachment[]');
                element.change(function() {
                    element.next(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function() {
                    element.click();
                });
                $(this).find("button.btn-reset").click(function() {
                    element.val(null);
                    $(this).parents(".input-file").find('input').val('');
                });
                $(this).find('input').css("cursor", "pointer");
                $(this).find('input').mousedown(function() {
                    $(this).parents('.input-file').prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}

function append(str) {
    var textarea = $('textarea');
    if (str == '') {
        return textarea.val('');
    }

    return textarea.val($.trim(textarea.val() + ' ' + str));
}