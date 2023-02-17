var CalendarListView = function(activities) {

    function setEventData(element,pageName,eventId,contactId,taskId) {
        element.find('.fc-content').addClass('user-activity');
        element.find('.fc-content').data('page', pageName);
        element.find('.fc-content').data('id', eventId);
        element.find('.fc-content').data('contact', contactId);
        element.find('.fc-content').data('task', taskId);
    }

    return {
        //main function to initiate the module
        init: function(activities) {
            var myCalendar = $('#m_calendar');
            var dom = $('.modal-body');
            var domDuration = $('.modal-body').find('#duration')
            var domTime = $('.modal-body').find('#time')
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var current = moment().format('HH:00:00');
            var end = moment().add(2,'h').format('HH:00:00');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');


            myCalendar.fullCalendar({
                header: {
                    left: 'agendaDay',
                    center: 'title',
                    right: 'prev,next'
                },
                dragRevertDuration: 0,
                slotDuration: '00:30:00',
                snapDuration: '00:15:00',
                defaultView: 'agendaDay',
                editable: true,
                eventStartEditable: true,
                eventDurationEditable: true,
                nowIndicator:true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                height: 600,
                allDaySlot: false,
                scrollTime: current,
                events: activities,
                eventRender: function(event, element) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', event.description);
                        element.data('placement', 'top');
                        mApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                    }
                },
                eventDrop: function( event, jsEvent, ui, view ) {
                    $('.modal-body').find('#time').val(event.start.format('HH:mm')).trigger('change');
                },
                eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
                    var start  = event.start.format('DD/MM/YYYY HH:mm:ss');
                    var end = event.end.format('DD/MM/YYYY HH:mm:ss');

                    var ms = moment(start,"DD/MM/YYYY HH:mm:ss").diff(moment(end,"DD/MM/YYYY HH:mm:ss"));
                    var d = moment.duration(ms);
                    var s = d.format("HH:mm");
                    s = s.replace("-", "");
                    if (s > '08:00')
                    {
                        if (dom.find("option[value='" + s + "']").length) {
                            domDuration.val(s).trigger('change');
                        } else {
                            var newOption = new Option(s, s, true, true);
                            domDuration.append(newOption).trigger('change');
                        }
                    }
                    domDuration.val(s).trigger('change');

                }
            });

        },

        monthView: function(activities, openActivityPopUp) {
            var myCalendar = $('#month_calendar');
            myCalendar.fullCalendar('destroy');
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var current = moment().format('HH:00:00');
            var end = moment().add(2,'h').format('HH:00:00');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');


            myCalendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                slotDuration: '00:30:00',
                snapDuration: '00:15:00',
                nowIndicator:true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                allDaySlot: false,
                selectable: true,
                events: activities,
                eventRender: function(event, element) {
                    if (element.hasClass('fc-day-grid-event')) {
                        setEventData(element, 'calendar',event.id,event.contact,event.task);
                        element.data('content', event.description+' with '+event.name);
                        element.data('placement', 'top');
                        mApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div><div class="fc-description"> with <strong>' + event.name + '</strong></div>');
                        setEventData(element,'calendar',event.id,event.contact,event.task);
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div><div class="fc-description"> with <strong>' + event.name + '</strong></div>');
                        setEventData(element,'calendar',event.id,event.contact,event.task);
                    }
                },
                select: function(start, end, jsEvent, view) {
                    var allDay = !start.hasTime && !end.hasTime;
                    // openActivityPopUp(page = null, contactId = 1, date=null);
                    //  alert(["Event Start date: " + moment(start).format()]);
                    openActivityPopUp(null, null, moment(start).format('YYYY-MM-DD'));
                }
            });

        }
    };
}();