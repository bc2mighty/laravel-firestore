$(document).ready(function() {
    $("#category").change(function() {
        var category = $(this).val();
        $(".col-sm-12.col-md-12.col-lg-6.list-product").css({'display': 'none'});
        $(`.col-sm-12.col-md-12.col-lg-6.list-product[product-category=${category}]`).css({'display': 'block'});
    });
});