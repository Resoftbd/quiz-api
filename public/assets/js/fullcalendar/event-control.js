var EventControl = function() {

    var EventObj = {};
    EventObj.getStartTime = function (modal) {
        var dateString = $('#m_datepicker_1_modal').val();
        console.log(dateString);
        var time = modal.find('#time').val();
        console.log(dateString,time);
        var momentObj = moment(dateString, 'MMMM D, YYYY');
        return momentObj.format('YYYY-MM-DD')+'T'+time+':00';
    }
    EventObj.getEndTime = function (modal,startTime) {
        var durationLength = modal.find('#duration').val();
        var startTime = moment(startTime);
        var hour = moment(durationLength,'h:m').format('H');
        var min = moment(durationLength,'h:m').format('m');

        var newEndTime = startTime.clone();

        if(hour != 0){
            newEndTime = newEndTime.add(hour, 'h');
        }
        if (min != 0){
            newEndTime =  newEndTime.add(min, 'm');
        }
        return newEndTime.format('YYYY-MM-DDTHH:mm:ss');
    }
    EventObj.setValue = function (modal) {
        var title = modal.find('#title').val();
        var placeholder = modal.find('#title').attr('placeholder');
        var note = modal.find('#note').val();
        EventObj.title = title ? title : placeholder;
        EventObj.note = note ? note : 'Activity Note';
        EventObj.start = this.getStartTime(modal);
        EventObj.end = this.getEndTime(modal, this.start);
    }
    return {
        start: function(modal,clientId) {
            clientId = clientId || "myNewActivity";
            var event = modal.find('#m_calendar').fullCalendar( 'clientEvents',clientId);
            EventObj.setValue(modal);
            event[0].title = EventObj.title;
            event[0].description = EventObj.note;
            event[0].start = EventObj.start;
            event[0].end = EventObj.end;
            if (clientId != "myNewActivity"){
                event[0].editable = true;
                event[0].startEditable = true;
                event[0].durationEditable = true;
            }
            modal.find('#m_calendar').fullCalendar('updateEvent', event[0]);
        },
        setStartDate:function (modal) {
            EventObj.setValue(modal);
            var startDate = EventObj.getStartTime(modal);
            console.log(startDate);
            modal.find('#m_calendar').fullCalendar('gotoDate', startDate);
        }
    };
}();
