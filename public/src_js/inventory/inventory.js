$('#add-warehouse').click(function() {

    var div =$("div.warehouse.init")
        .first()
        .clone();
    div.insertBefore($('div.row-fluid.more_warehouses'));
    //     .find("input").attr("name",function(i,oldVal) {
    //     return oldVal.replace(/\[(\d+)\]/,function(_,m){
    //         return "[" + (+m + 1) + "]";
    //     });
    // });

    return false;

});

// $("a").click(function() {
//
//     var append = $("div.input.text")
//         .first()
//         .clone();
//
//     append.insertBefore($("div.here.active'"));
//
//     return false;
//
// });