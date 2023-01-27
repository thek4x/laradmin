/*
 =========================================
 |                                       |
 |       Multi-Check checkbox            |
 |                                       |
 =========================================
 */

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}


/*
 =========================================
 |                                       |
 |           MultiCheck                  |
 |                                       |
 =========================================
 */

/*
 This MultiCheck Function is recommanded for datatable
 */

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function () {
        var e = $(this).closest("table").find("td:first-child .child-chk"), a = $(this).is(":checked");
        $(e).each(function () {
            a ? ($(this).prop("checked", !0), $(this).closest("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
            tb_var.on("change", "tbody tr .new-control", function () {
                $(this).parents("tr").toggleClass("active");
            });
}

$(function () {

    //sayfa açılışından 1 saniye sonra çalışıp permlere ait rolleri check edicek
    function permAddCheck() {
        $(".rplist").find('>div').each(function (index, element) {
            $element = $(element);
            secili = $element.find('.permCheck:checked').length
            if (secili > 0) {
                $element.find('.roleCheck').trigger('click')
                $element.find('.roleCheck').attr("checked", "checked")
            }
        });
    }

    function permClickRoleEvent() {
        $(".permCheck").click(function () {
            var parent = $(this).parents('.permParent');
            var group_check_length = parent.find('.permCheck:checked').length;
            if (group_check_length >= 1) {
                group_role = parent.prev('div').find('.roleCheck');
                if (!group_role.is(':checked')) {
                    group_role.attr("checked", "checked");
                    group_role.trigger('click');
                }
            } else {
                group_role.removeAttr("checked");
                group_role.trigger('click');
            }
        });
    }
    
    function selectext(element) {
        if ($(element).index() != -1) {
            new TomSelect(element, {
                create: true,
                render: {
                    option: function (data) {
                        const div = document.createElement('div');
                        div.className = 'd-flex align-items-center';

                        const span = document.createElement('span');
                        span.className = 'flex-grow-1';
                        span.innerText = data.text;
                        div.append(span);
                        return div;
                    }
                }
            });
        }
    }

    selectext(".custom-select");
    selectext(".groupedselect");


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    permClickRoleEvent();
    setTimeout(function () {
        permAddCheck();
    }, 1000);
});