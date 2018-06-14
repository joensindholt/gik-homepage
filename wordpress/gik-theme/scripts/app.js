var app = {
    //apiUrl: 'http://localhost:5000'
    apiUrl: "https://myathleticsclubapi.azurewebsites.net"
};
/** * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * Events box
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * */
app.initEvents = function () {
    $.ajax(app.apiUrl + "/api/events")
        .done(function (events) {
        // we are only interested in active events...sorted by date
        var now = new Date();
        var today = new Date();
        today.setUTCHours(0, 0, 0, 0);
        events = events
            .filter(function (e) {
            var eventEndDateOffset = new Date(e.date);
            eventEndDateOffset.setDate(eventEndDateOffset.getDate() + 1);
            var isActive = today < eventEndDateOffset;
            return isActive;
        })
            .sort(function (a, b) { return a.date > b.date; });
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
        var eventsApp = new Vue({
            el: "#events",
            data: {
                events: events,
                selectedEvent: selectedEvent,
                registrations: null,
                registrationsVisible: false
            },
            methods: {
                showEventDetails: function (event) {
                    this.selectedEvent = event;
                    this.registrationsVisible = false;
                    this.getRegistrations();
                },
                getRegistrations: function () {
                    var _this = this;
                    if (this.selectedEvent) {
                        $.ajax(app.apiUrl +
                            "/api/events/" +
                            this.selectedEvent.id +
                            "/registrations")
                            .done(function (registrations) {
                            _this.registrations = registrations.sort(function (a, b) {
                                return a.name.localeCompare(b.name);
                            });
                        })
                            .fail(function (xhr, status, err) {
                            console.error("Looks like there was a problem. Status Code: ", xhr, status, err);
                        });
                    }
                    else {
                        this.registrations = null;
                    }
                },
                toggleRegistrations: function () {
                    this.registrationsVisible = !this.registrationsVisible;
                },
                moment: function () {
                    var args = [];
                    for (var _i = 0; _i < arguments.length; _i++) {
                        args[_i] = arguments[_i];
                    }
                    return moment.apply(void 0, args);
                },
                eventDate: function (date) {
                    return new Date(date).getDate();
                },
                eventMonthShort: function (date) {
                    return moment(date).format("MMM");
                },
                registerLink: function (eventId) {
                    return app.apiUrl + "/#/events/" + eventId;
                },
                prettyLastRegistrationDate: function (event) {
                    var registrationPeriodEndDateMoment = moment(app.dateService.parseServerDate(event.registrationPeriodEndDate)).add(1, 'days').subtract(1, 'seconds');
                    // Use moment to get a pretty "in x days" text
                    var fromNow = registrationPeriodEndDateMoment.fromNow();
                    // Special handling of "i dag" and "i går"
                    if (registrationPeriodEndDateMoment.isSame(moment(), 'day')) {
                        fromNow = 'i dag';
                    }
                    if (registrationPeriodEndDateMoment.isSame(moment().add(1, 'days'), 'day')) {
                        fromNow = 'i morgen';
                    }
                    if (registrationPeriodEndDateMoment.isSame(moment().subtract(1, 'days'), 'day')) {
                        fromNow = 'i går';
                    }
                    return (moment(event.registrationPeriodEndDate).format("D. MMMM YYYY") + " (" + fromNow + ")");
                },
                isOpenForRegistration: function (event) {
                    var now = new Date();
                    var registrationPeriodEndDateOffset = new Date(event.registrationPeriodEndDate);
                    registrationPeriodEndDateOffset.setDate(registrationPeriodEndDateOffset.getDate() + 1);
                    return (new Date(event.registrationPeriodStartDate) <= now &&
                        now <= registrationPeriodEndDateOffset);
                }
            },
            computed: {
                selectedEventMultilineAddress: function () {
                    return this.selectedEvent.address.replace(", \n", "<br/>");
                }
            },
            mounted: function () {
                this.getRegistrations();
            }
        });
        app.eventsApp = eventsApp;
    })
        .fail(function (xhr, status, err) {
        console.error("Looks like there was a problem. Status Code: ", xhr, status, err);
    });
};
/** * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * Results box
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * */
app.initResults = function () {
    // get results from api
    $.ajax(app.apiUrl + "/api/results")
        .done(function (results) {
        // tell vue to render the results
        var resultsApp = new Vue({
            el: "#results",
            data: {
                results: results,
                eventIndex: 0
            },
            methods: {
                moment: function () {
                    var args = [];
                    for (var _i = 0; _i < arguments.length; _i++) {
                        args[_i] = arguments[_i];
                    }
                    return moment.apply(void 0, args);
                },
                showPreviousEvent: function () {
                    this.eventIndex++;
                    this.getOffsetResults();
                },
                showNextEvent: function () {
                    if (this.eventIndex == 0) {
                        return;
                    }
                    this.eventIndex--;
                    this.getOffsetResults();
                },
                getOffsetResults: function () {
                    var _this = this;
                    $.ajax(app.apiUrl + "/api/results/" + this.eventIndex)
                        .done(function (results) {
                        _this.results = {
                            lastEvent: results,
                            medalsThisYear: _this.results.medalsThisYear
                        };
                    })
                        .fail(function (xhr, status, err) {
                        console.error("Looks like there was a problem. Status Code: ", xhr, status, err);
                    });
                }
            },
            computed: {}
        });
        app.resultsApp = resultsApp;
    })
        .fail(function (xhr, status, err) {
        console.error("Looks like there was a problem. Status Code: ", xhr, status, err);
    });
};
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
/** * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * Enrollment form
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * */
app.initEnrollment = function () {
    var enrollmentApp = new Vue({
        el: "#enrollmentForm",
        data: {
            enrollment: {
                membershipType: "",
                email: "",
                members: [{ name: "", birthDate: "" }],
                comments: ""
            },
            validated: false,
            validationErrors: {
                email: false,
                members: [{ name: false, birthDate: false }]
            },
            isValid: true,
            isSubmitting: false,
            submitted: false
        },
        methods: {
            addMember: function () {
                this.validationErrors.members.push({ name: false, birthDate: false });
                this.enrollment.members.push({ name: "", birthDate: "" });
            },
            removeMember: function (index) {
                this.enrollment.members.splice(index, 1);
                this.validationErrors.members.splice(index, 1);
            },
            updateDatePickers: function () {
                var vm = this;
                $('[data-toggle="datepicker"]')
                    .datepicker({
                    date: moment()
                        .subtract(10, "years")
                        .format("DD-MM-YYYY"),
                    startView: 2,
                    autoHide: true,
                    language: "da-DK",
                    format: "dd-mm-yyyy"
                })
                    .on("pick.datepicker", function (e) {
                    // Update Vue member birthdate when a date is picked
                    var index = $('[data-toggle="datepicker"]').index(this);
                    var date = moment(e.date).format("DD-MM-YYYY");
                    vm.enrollment.members[index].birthDate = date;
                });
            },
            submit: function (event) {
                var _this = this;
                event.preventDefault();
                this.validate();
                if (!this.isValid) {
                    this.validated = true;
                    return;
                }
                this.submitted = false;
                this.isSubmitting = true;
                $.ajax({
                    type: "POST",
                    url: app.apiUrl + "/api/enroll",
                    data: JSON.stringify(this.enrollment),
                    contentType: "application/json",
                    success: function () {
                        _this.submitted = true;
                    },
                    error: function () {
                        _this.submitted = false;
                    },
                    complete: function () {
                        _this.isSubmitting = false;
                    }
                });
            },
            validate: function () {
                this.isValid = true;
                this.validationErrors = {
                    membershipType: false,
                    email: false,
                    members: []
                };
                // membership type is required
                if (this.enrollment.membershipType.length === 0) {
                    this.isValid = false;
                    this.validationErrors.membershipType = "Vælg venligst et medlemskab";
                }
                // email is required
                if (this.enrollment.email.length === 0) {
                    this.isValid = false;
                    this.validationErrors.email = "Indtast venligst din email";
                }
                else if (!/.+@.+\..+/.test(this.enrollment.email)) {
                    // email must be an email
                    this.isValid = false;
                    this.validationErrors.email = "Indtast venligst en gyldig email";
                }
                // name and birthdate is required on all members
                for (var memberIndex in this.enrollment.members) {
                    this.validationErrors.members.push({});
                    var member = this.enrollment.members[memberIndex];
                    if (member.name === "") {
                        this.isValid = false;
                        this.validationErrors.members[memberIndex].name =
                            "Indtast venligst et navn";
                    }
                    // birthdate is required
                    if (member.birthDate === "") {
                        this.isValid = false;
                        this.validationErrors.members[memberIndex].birthDate =
                            "Indtast venligst en fødselsdato";
                    }
                    else if (!/\d{2}-\d{2}-\d{4}/.test(member.birthDate)) {
                        // birthdate must be in the format 'DD-MM-YYYY'
                        this.isValid = false;
                        this.validationErrors.members[memberIndex].birthDate =
                            "Indtast venligst en gyldig dato";
                    }
                    else if (!moment(member.birthDate, "DD-MM-YYYY")._isValid) {
                        // birthdate must be a valid date
                        this.isValid = false;
                        this.validationErrors.members[memberIndex].birthDate =
                            "Indtast venligst en gyldig dato";
                    }
                }
            },
            readMembershipTypeFromUrl: function () {
                var type = this.getUrlParameterByName("type");
                if (type) {
                    this.setMembershipType(type);
                }
            },
            setMembershipType: function (type) {
                console.log("setting membership type", type, this);
                this.enrollment.membershipType = type;
            },
            getUrlParameterByName: function (name) {
                var url = window.location.href;
                name = name.replace(/[\[\]]/g, "\\$&");
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"), results = regex.exec(url);
                if (!results)
                    return null;
                if (!results[2])
                    return "";
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            },
            onMembershipTypeChange: function () {
                this.updateMemberCountLimit();
            },
            updateMemberCountLimit: function () {
                if (this.enrollment.membershipType !== "familiemedlemskab") {
                    if (this.enrollment.members.length > 1) {
                        this.enrollment.members = [this.enrollment.members[0]];
                    }
                }
            }
        },
        updated: function () {
            this.updateDatePickers();
            this.updateMemberCountLimit();
        },
        mounted: function () {
            this.updateDatePickers();
            this.readMembershipTypeFromUrl();
        }
    });
    app.enrollmentApp = enrollmentApp;
};
/** * * * * * * * * * * * * * * * * * * * * * * * * * *
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
        if (location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $("html, body").animate({
                    scrollTop: target.offset().top
                }, 1000, function () {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) {
                        // Checking if the target was focused
                        return false;
                    }
                    else {
                        $target.attr("tabindex", "-1"); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    }
                });
            }
        }
    });
});
/** * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * Utils
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * */
app.dateService = {
    parseServerDate: function (dateString) {
        if (!dateString) {
            return null;
        }
        return new Date(dateString);
    },
    parseDateAsCopenhagenTime: function (dateString) {
        if (!dateString) {
            return null;
        }
        // If we get a date with timezone we ignore it by removing the time zone indicator
        if (dateString[dateString.length - 1] === 'Z') {
            dateString = dateString.substring(0, dateString.length - 1);
        }
        return new Date(dateString + '+' + app.dateService.getTimezoneOffsetString());
    },
    getTimezoneOffsetString: function () {
        var timezoneOffset = new Date().getTimezoneOffset();
        if (timezoneOffset === -120) {
            return '0200';
        }
        else if (timezoneOffset === -60) {
            return '0100';
        }
        throw new Error('Could not resolve timezone offset string');
    }
};
