/**
 * Created by Clara on 14/02/2016.
 */

$('#enderecoModal').on('show.bs.modal', function (event) {
    //$(this).data('modal-body', null);
    //var button = $(event.relatedTarget) // Button that triggered the modal
    //var id= button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
   // var modal = $(this)
    //modal.find('.modal-title').text('Endereço ');

    var url = $('#enderecoFuncionario').attr('href')+'.json';
    $('.modal-body').load(url);

});

$('#dependenteModal').on('show.bs.modal', function (event) {
    $(this).find('.modal-body').html('Dependente:');
});

$(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function () {

    $('#deleteFuncionario').on('click', function () {
        var entityId = $(this).attr('data-whatever');
        $('.remove_item').attr('data-entity-id', entityId);
    });

    $(".remove_item").click(function () {
        var entityId = $(this).attr('data-entity-id');
        var itemId = 'item-' + entityId;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: Routing.generate('funcionario_remove', {"id": entityId}),
            success: function () {
                $('#' + itemId).fadeOut();
            }
        });
        return false;
    });


});

function del(urlToDelete) {
    $.ajax({
        url: urlToDelete,
        type: 'DELETE',
        success: function(results) {
            // Refresh the page
            location.reload();
        }
    });
}

//$(document).ready(function() {
//    $('#enderecoFuncionario').on('click', function(e) {
//        // prevents the browser from "following" the link
//        e.preventDefault();
//
//        var $anchor = $(this);
//        var url = $('#enderecoFuncionario').attr('href')+'.json';
//
//        $.post(url, null, function(data) {
//            if (data.attending) {
//                var message = 'See you there!';
//            } else {
//                var message = 'We\'ll miss you!';
//            }
//
//            $anchor.after('<span class="label label-default">&#10004; '+message+'</span>');
//            $anchor.hide();
//        });
//    });
//});
