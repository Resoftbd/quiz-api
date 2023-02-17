
var twilioControl = function(){
    var speakerDevices = document.getElementById('speaker-devices');
    var ringtoneDevices = document.getElementById('ringtone-devices');
    var outputVolumeBar = document.getElementById('output-volume');
    var inputVolumeBar = document.getElementById('input-volume');
    var volumeIndicators = document.getElementById('volume-indicators');
    var callInfo = $('.call-info');
    var callType = $('.call-type');
    var contactInfo = $('.contact-info');
    var acceptButton = $('#button-accept');
    var rejectBUtton = $('#button-hangup');
    var closeWindow = $('.close-call');
    var dialer = $(".call-dialer-wrapper");
    var toggleAudioBtn = $('#microphone');

    function readyDevice() {
        Twilio.Device.ready(function (device) {
            log('Twilio.Device Ready!');
            document.getElementById('call-controls').style.display = 'block';
        });
    }

    function errorDevice() {
        Twilio.Device.error(function (error) {
            log('Twilio.Device Error: ' + error.message);
            callInfo.text('Hanging up...');
            contactInfo.text('Twilio.Device Error: ' + error.message);
            setTimeout(function() {
                dialer.hide()
            }, 5000);
        });
    }

    function connectCall(contact,from,timeLimit) {
        var params = {
            To: contact,
            From: from,
            TimeLimit: timeLimit
        };
        dialer.show();
        if ($("#dialer-box").is(":hidden")){
            $('.minimize').trigger('click');
        }
        callType.text('Outgoing Call');
        contactInfo.text(params.To);
        console.log('Calling ' + params.To + '...');
        console.log('Calling from ' + params.From + '...');
        Twilio.Device.connect(params);
    }

    function connectCallSuccess() {
        Twilio.Device.connect(function (conn) {
            log('Successfully established call!');
            rejectBUtton.show();
            callInfo.text('Connected');
            volumeIndicators.style.display = 'block';
            bindVolumeIndicators(conn);
            audioMute(conn);
            sendDigits(conn);
        });
    }

    function audioMute(connection) {
        toggleAudioBtn.click(function() {
            $("i", this).toggleClass("fa-microphone fa-microphone-slash");
            if (connection.isMuted()){
                connection.mute(false);
            }
            else connection.mute(true);
        });
    }

    function disconnected() {
        Twilio.Device.disconnect(function (conn) {
            log('Call ended.');
            rejectBUtton.hide();
            setTimeout(function() {
                dialer.hide()
            }, 5000);
            volumeIndicators.style.display = 'none';
        });
    }

    function incomingCall() {
        Twilio.Device.incoming(function (conn) {
            log('Incoming connection from ' + conn.parameters.From);
            dialer.show();
            acceptButton.show();
            rejectBUtton.show();
            callInfo.text('Incomming Call');
            callType.text('Incomming Call');
            contactInfo.text(conn.parameters.From);
            rejectBUtton.click(function () {
                conn.reject();
            });
            acceptButton.click(function () {
                conn.accept();
            });
            closeWindow.click(function () {
                conn.reject();
            });
        });
    }

    function audioControl() {
        Twilio.Device.audio.on('deviceChange', updateAllDevices);
        // Show audio selection UI if it is supported by the browser.
        if (Twilio.Device.audio.isSelectionSupported) {
            document.getElementById('output-selection').style.display = 'block';
        }
    }

    function hangupCall() {
        log('Hanging up...');
        callInfo.html('Hanging up...');
        acceptButton.hide();
        Twilio.Device.disconnectAll();
        setTimeout(function() {
            dialer.hide()
        }, 2000);
    }

    function getMediaDevice() {
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(updateAllDevices);
    }

    function bindVolumeIndicators(connection) {
          connection.volume(function(inputVolume, outputVolume) {
              var inputColor = 'red';
              if (inputVolume < .50) {
                  inputColor = 'green';
              } else if (inputVolume < .75) {
                  inputColor = 'yellow';
              }

              inputVolumeBar.style.width = Math.floor(inputVolume * 300) + 'px';
              inputVolumeBar.style.background = 'yellow';

              var outputColor = 'red';
              if (outputVolume < .50) {
                  outputColor = 'green';
              } else if (outputVolume < .75) {
                  outputColor = 'yellow';
              }

              outputVolumeBar.style.width = Math.floor(outputVolume * 300) + 'px';
              outputVolumeBar.style.background = 'red';
          });
      }

    function sendDigits(connection) {
            $.each(['0','1','2','3','4','5','6','7','8','9','star','pound'], function(index, value) {
                $('#button-' + value).click(function(){
                    if(connection) {
                        if (value=='star')
                            connection.sendDigits('*')
                        else if (value=='pound')
                            connection.sendDigits('#')
                        else
                            connection.sendDigits(value)
                        return false;
                    }
                });
            });
    }

    function updateAllDevices() {
          updateDevices(speakerDevices, Twilio.Device.audio.speakerDevices.get());
          updateDevices(ringtoneDevices, Twilio.Device.audio.ringtoneDevices.get());
      }

    function updateDevices(selectEl, selectedDevices) {
        selectEl.innerHTML = '';
        Twilio.Device.audio.availableOutputDevices.forEach(function(device, id) {
            var isActive = (selectedDevices.size === 0 && id === 'default');
            selectedDevices.forEach(function(device) {
                if (device.deviceId === id) { isActive = true; }
            });

            var option = document.createElement('option');
            option.label = device.label;
            option.setAttribute('data-id', id);
            if (isActive) {
                option.setAttribute('selected', 'selected');
            }
            selectEl.appendChild(option);
        });
    }

// Activity log
    function log(message) {
        var logDiv = document.getElementById('log');
        logDiv.innerHTML += '<p>&gt;&nbsp;' + message + '</p>';
        logDiv.scrollTop = logDiv.scrollHeight;
    }
// Set the client name in the UI
    function setClientNameUI(clientName) {
        var div = document.getElementById('client-name');
        div.innerHTML = 'Your client name: <strong>' + clientName +
            '</strong>';
    }

    return {
        init: function () {
            $.getJSON('dialer/token').done(function (data) {
                console.log('Token: ' + data.token);
                Twilio.Device.setup(data.token);
                acceptButton.hide();
                readyDevice();
                errorDevice();
                connectCallSuccess();
                incomingCall();
                disconnected();
                audioControl();
                getMediaDevice();
            }).fail(function () {
                $('.call').removeClass('btn-success').addClass('btn-danger').removeAttr('id');
                log('Could not get a token from server!');
            });
        },
        audio:function () {
            audioControl();
        },
        log: function (message) {
            log(message);
        },
        call: function (contact,from,timeLimit) {
            connectCall(contact,from,timeLimit);
        },
        hangup: function () {
            hangupCall();
        },
    }
}();


//
// $(function () {
//
// //const _token = document.head.querySelector("[property=csrf-token]").content;
//
