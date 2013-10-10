/// <reference path="jquery-1.10.2.min.js"/>
$(document).ready(function () {
    $(document).delegate('.ani_1', 'mouseenter', function (e) {
        var t = $(e.currentTarget);
        t.animate({ left: '+=3' },60);
        t.animate({ top: '+=3' }, 60);
        t.animate({ left: '-=3' }, 60);
        t.animate({ top: '-=3' }, 60);
    });
});