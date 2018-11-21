$(function() {
	bs_input_file();
});

$(document).ready(function() {

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
    	drawCallback: function () {
          	$('.dataTables_filter input').addClass('form-control').attr('style', 'width:auto;');
          	$('.dataTables_scrollBody').niceScroll();
        }
    });

    // $('.panel-right').niceScroll();


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

});

function bs_input_file() {
    $(".input-file").before(
        function() {
            if (!$(this).prev().hasClass('input-ghost')) {
                var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                element.attr("name", $(this).attr("name"));
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