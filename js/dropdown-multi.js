
if ($(".dropdown-multi").length) {
    $(".dropdown-multi").dropdown({
    input: '<input type="text" maxLength="25" placeholder="" size="15" readonly>',
    multipleMode: "label",
    limitCount: 999,
    searchable: true,
    });
}