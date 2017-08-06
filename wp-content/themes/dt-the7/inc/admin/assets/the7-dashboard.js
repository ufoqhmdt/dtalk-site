(function($){

    'use strict';

    $(function() {
        $('#the7-settings').on( 'submit.the7-dashboard-settings.save', function( event ) {
            event.preventDefault();

            $(this).find('.spinner').addClass('is-active');

            $.post(
                ajaxurl,
                $(this).serialize()
            ).done(function(data) {
                // Response here.
            }).fail(function (data) {
                // Response here.
            }).always(function() {
                window.location.reload();
            });
        });

        // Dependency.
        var dependency = {
            portfolio: ['slug', 'layout'],
            albums: ['slug'],
            team: ['slug']
        }
        Object.keys(dependency).forEach(function(setting) {
            $('#the7-post-type-'+setting).on('click', function () {
                var selector = dependency[setting].map(function(field) {
                    return '#the7-post-type-'+setting+'-'+field;
                }).join(',');
                var $elements = $(selector).closest('tr');

                if ($(this).is(':checked')) {
                    $elements.show('slow');
                } else {
                    $elements.hide('fast');
                }
            });
        });
    });

}(jQuery));
