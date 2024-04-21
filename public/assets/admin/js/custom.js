$(".window-dismiss").click(function () {
    $(".window-wrapper").hide();
});
$(document).ready(function () {
    $(".tree-item-parent").click(function () {
        $(this).next(".tree-child").slideToggle("slow");
    });

});


$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
//$(".toggle-notification").click(function () {
//    $(".rich-content").show().fadeOut(3000);
//});
$('#demo-wrapper ul li').on('click', function () {
    var path = $(this).data('path');
    $('.color-choice-red').attr('href', path);
});


$(".btn-print").click(function () {
    var canvas = $(this).parent().find(".bar-to-print");
    var imgRend = document.getElementById("imgRender");
    var imgPath = canvas[0].toDataURL("image/png");
    imgRend.src = imgPath;
    ImagetoPrint(imgPath);
    PrintImage(imgPath);
});

function ImagetoPrint(imgPath) {
    return "<html><head><script>function step1(){\n" +
        "setTimeout('step2()', 10);}\n" +
        "function step2(){window.print();window.close()}\n" +
        "</scri" + "pt></head><body onload='step1()'>\n" +
        "<img src='" + imgPath + "' /></body></html>";
}

function PrintImage(imgPath) {
    Pagelink = "about:blank";
    var pwa = window.open(Pagelink, "_same");
    pwa.document.open();
    pwa.document.write(ImagetoPrint(imgPath));
    pwa.document.close();
}

$(".repeat").click(function () {
    $('.clone-col').not('.cloned').clone().addClass('cloned').appendTo('.clone-row');
});
$(".repeat-color").click(function () {
    $('.clone-col-color').not('.cloned').clone().addClass('cloned').appendTo('.clone-row-color');
});
/* page loder js */
$(window).on('load', function () {
    $(".loader-container").fadeOut("slow");
});
//advanced search show hide
$('.advanced-search-btn').click(function (event) {
    event.preventDefault();
    $(".table-advanced-search").toggleClass("d-flex");
});
//$('.rich-content').delay(2000).show(0);
//$('.rich-content').delay(4000).hide(0);

$(".expandable-icon").click(function () {
    $('.dropdown-tr ').toggleClass('dropdown-tr-visible');
});
//file upload name
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
$(".btn-import").click(function () {
    $(".import-container").show()
});
$(".content-box-togler").click(function () {
    $(".content-box-onclick").show();
});

$(document).ready(function () {
    $(".report-print-btn").click(function () {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {mode: mode, popClose: close};
        $("div.printableTable").printArea(options);
    });
    $("#viewModal .modal-footer").hide("500");
    //$(".btn-edit").click(function (e) {
    //    e.preventDefault();
    //    $("input,.form-control").prop("disabled", false);
    //    $(".btn-edit-hide").show("500");
    //    $("#viewModal .modal-footer").show("500");
    //    $(".btn").removeClass("disabled");
    //});
    $(".btn-edit-hide .btn-danger").click(function (e) {
        e.preventDefault();
        $("input,.form-control").prop("disabled", true);
        $(".btn-edit-hide").hide("500");
    });
});
// Clone Vendor Contact

//$(document).ready(function () {
//    $(".btn-clone-contact-add").click(function () {
//        var $cln = $('.clone-this-add').html();
//        $($cln).appendTo('#cloned-contact-add').addClass("cloned-content");
//        $('#cloned-contact-add').find(".cloned-content").each(function (index, value) {
//            $(this).attr("id", "cloned-" + (index + 1));
//
//
//        });
//        $(".btn-remove-row").click(function () {
//            if (confirm("Are you sure you want to remove this contact ?")) {
//                $(this).parent('.cloned-content').remove();
//            }
//            else {
//            }
//        });
//    });
//    $(".btn-clone-contact-edit").click(function () {
//        var $cln = $('.clone-this-edit').html();
//        $($cln).appendTo('#cloned-contact-edit').addClass("cloned-content");
//        $('#cloned-contact-1').find(".cloned-content").each(function (index, value) {
//            $(this).attr("id", "cloned-" + (index + 1));
//
//
//        });
//        $(".btn-remove-row").click(function () {
//            if (confirm("Are you sure you want to remove this contact ?")) {
//                $(this).parent('.cloned-content').remove();
//            }
//            else {
//            }
//        });
//    });
//    $(".btn-remove-row").click(function () {
//        if (confirm("Are you sure you want to remove this contact ?")) {
//            $(this).parent().remove();
//        }
//        else {
//        }
//    });
//});

//// Dual Box
$(document).ready(function () {
//    var groupDataArray = [
//        {
//            "groupName": "City A",
//            "groupData": [
//                {
//                    "area": "Area 1",
//                    "value": 122
//                },
//                {
//                    "area": "Area 2",
//                    "value": 643
//                },
//                {
//                    "area": "Area 3",
//                    "value": 422
//                },
//                {
//                    "area": "Area 4",
//                    "value": 622
//                }
//            ]
//        },
//        {
//            "groupName": "City B",
//            "groupData": [
//                {
//                    "area": "Area 1",
//                    "value": 122
//                },
//                {
//                    "area": "Area 2",
//                    "value": 643
//                },
//                {
//                    "area": "Area 3",
//                    "value": 422
//                },
//                {
//                    "area": "Area 4",
//                    "value": 622
//                }
//            ]
//        },
//        {
//            "groupName": "City C",
//            "groupData": [
//                {
//                    "area": "Area 1",
//                    "value": 122
//                },
//                {
//                    "area": "Area 2",
//                    "value": 643
//                },
//                {
//                    "area": "Area 3",
//                    "value": 422
//                },
//                {
//                    "area": "Area 4",
//                    "value": 622
//                }
//            ]
//        }
//    ];
//
//    var settings3 = {
//        "groupDataArray": groupDataArray,
//        "groupItemName": "groupName",
//        "groupArrayName": "groupData",
//        "itemName": "area",
//        "valueName": "value",
//        "callable": function (items) {
//            console.dir(items)
//        }
//    };
//
//    $("#area").Transfer(settings3);
//    $("#area1").Transfer(settings3);

    //var groupDataArray1 = [
    //    {
    //        "groupName": "Area From Selected Route A",
    //        "groupData": [
    //            {
    //                "street": "Street 1",
    //                "value": 122
    //            },
    //            {
    //                "street": "Street 2",
    //                "value": 643
    //            },
    //            {
    //                "street": "Street 3",
    //                "value": 422
    //            },
    //            {
    //                "street": "Street 4",
    //                "value": 622
    //            }
    //        ]
    //    },
    //    {
    //        "groupName": "Area From Selected Route  B",
    //        "groupData": [
    //            {
    //                "street": "Street 1",
    //                "value": 122
    //            },
    //            {
    //                "street": "Street 2",
    //                "value": 643
    //            },
    //            {
    //                "street": "Street 3",
    //                "value": 422
    //            },
    //            {
    //                "street": "Street 4",
    //                "value": 622
    //            }
    //        ]
    //    },
    //    {
    //        "groupName": "Area From Selected Route  C",
    //        "groupData": [
    //            {
    //                "street": "Street 1",
    //                "value": 122
    //            },
    //            {
    //                "street": "Street 2",
    //                "value": 643
    //            },
    //            {
    //                "street": "Street 3",
    //                "value": 422
    //            },
    //            {
    //                "street": "Street 4",
    //                "value": 622
    //            }
    //        ]
    //    }
    //];
    //
    //var settings3 = {
    //    "groupDataArray": groupDataArray1,
    //    "groupItemName": "groupName",
    //    "groupArrayName": "groupData",
    //    "itemName": "street",
    //    "valueName": "value",
    //    "callable": function (items) {
    //        console.dir(items)
    //    }
    //};
    //
    //$("#street").transfer(settings3);
    //$("#street1").transfer(settings3);
});
$(".modal-price-close").click(function () {
    setTimeout(function () {
        $("body").addClass("modal-open");
    }, 400);
});
// Product
// Select 2
$(document).ready(function () {
    $('select').select2({
        // minimumResultsForSearch: Infinity
    });
});
// Accordion with toggle
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa-sort-up fa-sort-down');
}

$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
$(".index-filter a").click(function (e) {
    e.preventDefault();
    $(this).toggleClass("active");
});
$(".btn-bulk-upload").click(function (e) {
    e.preventDefault();
    $(".show-bulk").toggle('500');
});

$(".modal-body-sc").scroll(function () {
    var scrollPos = $(this).scrollTop();
    if (scrollPos > 100) {
        $('.div-top').addClass('fixed-div-top');
        $('.modal-body-sc').css("padding-top", "170px")
    } else {
        $('.div-top').removeClass('fixed-div-top');
        $('.modal-body-sc').css("padding-top", "0px")
    }
});
$('.main-nav-menu a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(this).attr('href');
    $(target).css('left','-'+$(window).width()+'px');
    var left = $(target).offset().left;
    $(target).css({left:left}).animate({"left":"0px"}, "10");

});

$('.main-nav-menu a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(this).attr('href');
    $(target).css('left', '-' + $(window).width() + 'px');
    var left = $(target).offset().left;
    $(target).css({left: left}).animate({"left": "0px"}, "10");
});

$(".notif-close-ico").click(function () {
    $(this).parents(".rich-content").hide();

});
$(".respo-mnu-tp").click(function () {
    $(".user-auth-info-ys").toggleClass("user-auth-info-blk");
});

!function ($) {
    "use strict";
    var a = {
        accordionOn: ["xs"]
    };
    $.fn.responsiveTabs = function (e) {
        var t = $.extend({}, a, e),
            s = "";
        return $.each(t.accordionOn, function (a, e) {
            s += " accordion-" + e
        }), this.each(function () {
            var a = $(this),
                e = a.find("> li > a"),
                t = $(e.first().attr("href")).parent(".tab-content"),
                i = t.children(".tab-pane");
            a.add(t).wrapAll('<div class="responsive-tabs-container" />');
            var n = a.parent(".responsive-tabs-container");
            n.addClass(s), e.each(function (a) {
                var t = $(this),
                    s = t.attr("href"),
                    i = "",
                    n = "",
                    r = "";
                t.parent("li").hasClass("active") && (i = " active"), 0 === a && (n = " first"), a === e.length - 1 && (r = " last"), t.clone(!1).addClass("accordion-link" + i + n + r).insertBefore(s)
            });
            var r = t.children(".accordion-link");
            e.on("click", function (a) {
                a.preventDefault();
                var e = $(this),
                    s = e.parent("li"),
                    n = s.siblings("li"),
                    c = e.attr("href"),
                    l = t.children('a[href="' + c + '"]');
                s.hasClass("active") || (s.addClass("active"), n.removeClass("active"), i.removeClass("active"), $(c).addClass("active"), r.removeClass("active"), l.addClass("active"))
            }), r.on("click", function (t) {
                t.preventDefault();
                var s = $(this),
                    n = s.attr("href"),
                    c = a.find('li > a[href="' + n + '"]').parent("li");
                s.hasClass("active") || (r.removeClass("active"), s.addClass("active"), i.removeClass("active"), $(n).addClass("active"), e.parent("li").removeClass("active"), c.addClass("active"))
            })
        })
    }
}(jQuery);


$('.responsive-tabs').responsiveTabs({
    accordionOn: ['xs', 'sm']
});

$(document).on('click', '.menu-respo', function () {
    $(".main-nav-menu").addClass("mobile-menu-active");
    $("body").addClass("openBackdrop");
});
$(document).on('click', '.btn-close-nav-phone', function () {
    $(this).parents(".main-nav-menu").removeClass("mobile-menu-active");
    $("body").removeClass("openBackdrop");
});

$(".modal-body-sc").scroll(function () {
    var scrollPos = $(this).scrollTop();
    var scrollHeightSearch = $(".row-search-ht").height();
    var divTopHt = $(".div-top").height();
    if (scrollPos > scrollHeightSearch) {
        $('.div-top').addClass('fixed-div-top');
        $('.modal-body-sc').css("padding-top", divTopHt)
    } else {
        $('.div-top').removeClass('fixed-div-top');
        $('.modal-body-sc').css("padding-top", "0px")
    }
});


$(document).on("click", ".pw-show-hide-js", function () {
    var inCvd = $(this).parents(".form-group").find(".form-control");

    var findIco = $(this).find(".fa");

    if (inCvd.attr("type") == "password") {
        inCvd.attr("type", "text");
        $(findIco).addClass("fa-eye").removeClass("fa-eye-slash");
    } else {
        inCvd.attr("type", "password");
        $(findIco).addClass("fa-eye-slash").removeClass("fa-eye");
    }
});
