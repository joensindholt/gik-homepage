function initEvents() {

  // get events from api
  fetch('https://myathleticsclubapi.azurewebsites.net/api/events').then(response => {
    
    if (response.status !== 200) {
      console.log('Looks like there was a problem. Status Code: ' + response.status);
      return;
    }

    response.json().then(function(events) {
      
      // we are only interested in active events...sorted by date
      events = events.filter(e => !e.isOldEvent).sort((a, b) => a.date > b.date);

      // determine event to show...if any
      var selectedEvent = null;
      if (events.length > 0) {
        selectedEvent = events[0];
      }

      // tell vue to render the events
      var app = new Vue({
        el: '#events',
        data: {
          events: events.filter(e => !e.isOldEvent).sort((a, b) => a.date > b.date),
          selectedEvent: selectedEvent
        },
        methods: {
          showEventDetails: function (event) {
            this.selectedEvent = event;
          }
        }
      });
    });
  });  
}
