(function($, fwe) {


    var init = function() {
        var $eventOptionEl = $(this),
            $allDaySwitch = $eventOptionEl.find('[id="fw-option-general-event-all_day"] input'),
            $eventsPopup = $eventOptionEl.find('#fw-backend-option-fw-option-general-event-event_children-e-event_date_range');


        $allDaySwitch.on('change', function() {



            var momentFormat = 'YYYY/MM/DD HH:mm',
                allDay = false;

            if ($allDaySwitch.is(':checked')) {
                momentFormat = 'YYYY/MM/DD';
                allDay = true;
            }

            var fromInput = $('#fw-option-general-event-event_children-e-event_date_range-from');
            var toInput = $('#fw-option-general-event-event_children-e-event_date_range-to');

            var fromVal = fromInput.val();
            var toVal = toInput.val();

            var from = new Date(fromVal),
                to = new Date(toVal);


            if (allDay) {

                fromInput.attr('data-from-time', moment(from.toISOString()).format('HH:mm'))
                    .val(moment(from.toISOString()).format(momentFormat));
                toInput.attr('data-to-time', moment(to.toISOString()).format('HH:mm'))
                    .val(moment(to.toISOString()).format(momentFormat));

            } else {


                if (fromInput.attr('data-from-time')) {

                    var fromTime = moment(fromInput.attr('data-from-time'), 'HH:mm').toDate(),
                        toTime = moment(toInput.attr('data-to-time'), 'HH:mm').toDate();



                    from.setHours(fromTime.getHours());
                    to.setHours(toTime.getHours());
                    from.setMinutes(fromTime.getMinutes());
                    to.setMinutes(toTime.getMinutes());
                    fromInput.val(moment(from.toISOString()).format(momentFormat));
                    toInput.val(moment(to.toISOString()).format(momentFormat));
                }
                /*						

                						*/
            }


        });

    }

    fwe.on('fw:options:init', function(data) {
        data.$elements
            .find('.fw-option-type-thz-event:not(.fw-option-initialized)')
            .each(init)
            .addClass('fw-option-initialized');
    });

})(jQuery, fwEvents);