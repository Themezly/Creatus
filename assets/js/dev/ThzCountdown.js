 /**
 * @plugin		ThzCountdown
 * @version		1.0.0
 * @package		Thz Framework
 * @copyright	Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author		Themezly
 * @license		MIT License (MIT) http://www.opensource.org/licenses/mit-license.php
 * @websites	http://www.themezly.com | http://www.youjoomla.com
 */
(function($) {
    $.fn.ThzCountdown = function(options, callback) {


        return this.each(function() {

            var settings = JSON.parse($(this).attr('data-settings'));

            // date is not set
            if (!settings.date) {
                $.error('Date is not defined.');
            }

            // incorrect date
            if (!Date.parse(settings.date)) {
                $.error('Please insert folowing date format; 12/24/2012 12:00:00.');
            }


            // Save container
            var container = $(this);

            /**
             * Change client's local date to match offset timezone
             * @return {Object} Fixed Date object.
             */

            var currentDate = function() {
                // get client's current date
                var date = new Date();

                // turn date to utc
                var utc = date.getTime() + (date.getTimezoneOffset() * 60000);

                // set new Date object
                var new_date = new Date(utc + (3600000 * settings.offset));

                return new_date;
            };

            /**
             * Main countdown function that calculates everything
             */
            function countdown() {
                var target_date = new Date(settings.date), // set target date
                    current_date = currentDate(); // get fixed current date

                // difference of dates
                var difference = target_date - current_date;

                // if difference is negative than it's pass the target date
                if (difference < 0) {
                    // stop timer
                    clearInterval(interval);

                    if (callback && typeof callback === 'function') callback();

                    return;
                }

                // basic math variables
                var _second = 1000,
                    _minute = _second * 60,
                    _hour = _minute * 60,
                    _day = _hour * 24;

                // calculate dates
                var days = Math.floor(difference / _day),
                    hours = Math.floor((difference % _day) / _hour),
                    minutes = Math.floor((difference % _hour) / _minute),
                    seconds = Math.floor((difference % _minute) / _second);

                // based on the date change the reference text
                var text_days = (days === 1) ? settings.day : settings.days,
                    text_hours = (hours === 1) ? settings.hour : settings.hours,
                    text_minutes = (minutes === 1) ? settings.minute : settings.minutes,
                    text_seconds = (seconds === 1) ? settings.second : settings.seconds;

                // fix dates so that it will show two digits
                days = (String(days).length >= 2) ? days : '0' + days;
                hours = (String(hours).length >= 2) ? hours : '0' + hours;
                minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
                seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

                // set to DOM
                container.find('.thz-cd-d').text(days);
                container.find('.thz-cd-h').text(hours);
                container.find('.thz-cd-m').text(minutes);
                container.find('.thz-cd-s').text(seconds);

                container.find('.thz-cd-dt').text(text_days);
                container.find('.thz-cd-ht').text(text_hours);
                container.find('.thz-cd-mt').text(text_minutes);
                container.find('.thz-cd-st').text(text_seconds);
            }
            // start

            var interval = setInterval(countdown, 1000);
        });

    };

})(jQuery);