define([
    'jquery',
], function ($) {
    'use strict';

    return function (config, element) {
        var input = $(config.keySearch);
        var table = $(config.table);

        input.on('input', function () {
            var filter = input.val().toUpperCase();
            var tr = table.find('tr');

            tr.each(function () {
                var key = $(this).find('td:eq(1)');
                var keyText = key.text().toUpperCase();

                if (keyText.indexOf(filter) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    };
});
