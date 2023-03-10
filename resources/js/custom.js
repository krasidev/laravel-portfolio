/**
 * jQuery columnCount plugin
 */
(function ($) {
    $.fn.columnCount = function (options) {
        var gridBreakpoints = {
            xl: '(min-width: 1200px)',
            lg: '(min-width: 992px)',
            md: '(min-width: 768px)',
            sm: '(min-width: 576px)'
        };

        var counts = $.extend({
            xl: 0, lg: 0, md: 0, sm: 0, xs: 1
        }, options);

        var breakpoints = [];
        var maxColumnCount = 1;

        for (i in counts) {
            if (counts[i] && i != 'xs') {
                breakpoints.push({
                    media: window.matchMedia(gridBreakpoints[i]),
                    count: counts[i]
                });

                if (counts[i] > maxColumnCount) {
                    maxColumnCount = counts[i];
                }
            }
        }

        return this.each(function () {
            var row = $(this);
            var cols = row.find('> [class*="col"]');
            var prependCols = '';

            for (var c = 0; c < maxColumnCount; c++) {
                prependCols += '<div class="col d-none"><div class="row"></div></div>';
            }

            row.prepend(prependCols);

            function responsiveMedia() {
                var col = counts['xs'];

                for (var i in breakpoints) {
                    if (breakpoints[i]['media'].matches) {
                        col = breakpoints[i]['count'];
                        break;
                    }
                }

                if (typeof col !== 'undefined') {
                    row.find('> .col').removeClass('d-none');
                    row.find('> .col:nth-child(n+' + (col + 1) + ')').addClass('d-none');

                    for (var i = 0; i < cols.length; i++) {
                        $(cols[i]).appendTo(
                            row.find('> .col:nth-child(' + ((i % col) + 1) + ') > .row')
                        );
                    }
                }
            }

            for (var i in breakpoints) {
                breakpoints[i]['media'].addListener(responsiveMedia);
            }

            responsiveMedia();
        });
    };
})(jQuery);

/**
 * Function that initializes a button to delete text in an input field.
 */
$(document).on('input propertychange', '.has-clear input[type="text"]', function () {
    $(this).closest('.has-clear').find('.btn-clear');
}).on('click', '.btn-clear', function () {
    $(this).closest('.has-clear').find('input[type="text"]').val('').trigger('propertychange').focus();
});

/**
 * Function that initializes a image after upload.
 */
$(document).on('change', '[type="file"]', function (e) {
    var url = URL.createObjectURL(e.target.files[0]); 

    $(this).parent().find('img').attr('src', url);
    URL.revokeObjectURL(url);
});

/**
 * Function that initializes a blur effect on main content when side nav is open on a mobile resolution.
 */
window.navbarNavInit = function () {
    var buttonNavbarNav = $('[data-target="#navbarNav"]');
    var navbarNav = $('#navbarNav');
    var main = $('#panel main');

    navbarNav.on('show.bs.collapse hide.bs.collapse', function (e) {
        if ($(this).is(e.target)) {
            main.toggleClass('blur', !$(this).hasClass('show'));
        }
    });

    main.on('click', function () {
        if (buttonNavbarNav.is(':visible') && navbarNav.is(':visible')) {
            navbarNav.collapse('hide');
        }
    });
};

/**
 * Function that initializes a search box in side nav.
 */
window.navbarNavSearchInit = function () {
    var panelSideNavGroupULs = $('#panel-side-nav-group ul');
    var panelSideNavGroupULsLinks = panelSideNavGroupULs.find('a');

    $('#panel-side-nav-search').on('keyup propertychange', function () {
        var text = $(this).val().toUpperCase();

        panelSideNavGroupULs.toggleClass('searching', text != '');
        panelSideNavGroupULsLinks.map(function () {
            if (text != '' && this.text.trim().toUpperCase().indexOf(text) > -1) {
                var items = $(this).parents('li');

                items.find('[data-toggle="collapse"]').removeClass('collapsed').attr('aria-expanded', true);
                items.addClass('show-search').find('.collapse').addClass('show');
            } else {
                var link = $(this);

                if (link.attr('data-toggle') == 'collapse') {
                    link.addClass('collapsed').attr('aria-expanded', false);
                }

                link.parent().removeClass('show-search').find('.collapse').removeClass('show');
            }
        });
    });
};

$(function () {
    navbarNavInit();
    navbarNavSearchInit();
});
