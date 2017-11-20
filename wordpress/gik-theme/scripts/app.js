let app = {};

app.initEvents = () => {

  // get events from api
  fetch('https://myathleticsclubapi.azurewebsites.net/api/events').then(response => {

    if (response.status !== 200) {
      console.log('Looks like there was a problem. Status Code: ' + response.status);
      return;
    }

    response.json().then(function (events) {

      // we are only interested in active events...sorted by date
      var now = new Date();
      var today = new Date();
      today.setUTCHours(0, 0, 0, 0);

      events = events.filter(e => {
        var eventEndDateOffset = new Date(e.date);
        eventEndDateOffset.setDate(eventEndDateOffset.getDate() + 1);
        var isActive = today < eventEndDateOffset;
        return isActive;
      })
        .sort((a, b) => a.date > b.date);

      // determine event to show...if any
      var selectedEvent = null;
      if (events.length > 0) {
        selectedEvent = events[0];
      }

      // resolve "today"
      var now = new Date();
      var today = new Date();
      today.setUTCHours(0, 0, 0, 0);

      // tell vue to render the events
      var app = new Vue({
        el: '#events',
        data: {
          events: events,
          selectedEvent: selectedEvent
        },
        methods: {
          showEventDetails: function (event) {
            this.selectedEvent = event;
          },

          moment: function (...args) {
            return moment(...args);
          },

          eventDate: function (date) {
            return new Date(date).getDate();
          },

          eventMonthShort: function (date) {
            return moment(date).format('MMM');
          },

          registerLink: function (eventId) {
            return 'https://myathleticsclubapi.azurewebsites.net/#/events/' + eventId
          },

          prettyLastRegistrationDate: function (event) {
            return moment(event.registrationPeriodEndDate).format('D. MMMM YYYY') + ' (' + moment(event.registrationPeriodEndDate).fromNow() + ')';
          },

          isOpenForRegistration: function (event) {
            var now = new Date();
            var registrationPeriodEndDateOffset = new Date(event.registrationPeriodEndDate);
            registrationPeriodEndDateOffset.setDate(registrationPeriodEndDateOffset.getDate() + 1);
            return new Date(event.registrationPeriodStartDate) <= now && now <= registrationPeriodEndDateOffset;
          }
        },
        computed: {
          selectedEventMultilineAddress: function () {
            return this.selectedEvent.address.replace(', \n', '<br/>');
          }
        }
      });
    });
  });
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * *
*
* API "Events" Response 
*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * 
[
  {
    "id": "4aaf5de354febcbd",
    "organizationId": "gik",
    "title": "Øst DM",
    "date": "2017-06-17T00:00:00Z",
    "address": "Østerbro Stadion, \nGunnar Nu Hansens Plads 7, 2100 Ø",
    "link": "http://atletik.sparta.dk/files/2017/04/Invitation-Øst-DM-2017.pdf",
    "disciplines": [
      {
        "ageGroup": "7",
        "disciplines": [
        {	        
	      "id": "60",
	      "name": "60m"
	    }]
      },
      {
        "ageGroup": "8",
        "disciplines": []
      },
      ...
    ],
    "registrationPeriodStartDate": "2017-05-03T00:00:00Z",
    "registrationPeriodEndDate": "2017-06-03T00:00:00Z",
    "info": "Tilmelding kun efter aftale med trænerne",
    "isOldEvent": true,
    "maxDisciplinesAllowed": 3
  }
]
*/

/* * * * * * * * * * * * * * * * * * * * * * * * * * * *
*
* Smooth Scroll
*
* * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Select all links with hashes
$(function () {
  $('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function (event) {
      // On-page links
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
        &&
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000, function () {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            };
          });
        }
      }
    });
});
