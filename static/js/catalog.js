$(function() {
    var count = 1;
    $(".catalog .prev_page").click(function() {
        count--;
        if (count == 0)
            count = 10;
        $(".catalog img").attr("src", "img/catalog/separate_version/" + count + ".jpg");
    });
    $(".catalog .next_page").click(function() {
        count++;
        if (count == 11)
            count = 1;
        $(".catalog img").attr("src", "img/catalog/separate_version/" + count + ".jpg");
    });

});