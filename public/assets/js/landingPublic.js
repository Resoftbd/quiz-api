var rankingCon_5 = $('.rankingCon-5');
// console.log(typeof isPublic);
$(document).ready(function(){
    rankingCon_5.each(function(){
        var element = $(this);
        var parent = element;
        var rank = _parseInt(parent.attr('data-rate'));
        var hidden = 'notOpen';
        var shown = 'open';
        for (var i = 1; i <= 5; i++) {
            if (i <= rank) {
                parent.find('.box-' + i).addClass(shown).removeClass(hidden);
            }
            else {
                parent.find('.box-' + i).removeClass(shown).addClass(hidden);
            }
        }
        if(typeof isPublic === 'undefined'){
            var landingPages = parent.closest('.landingPages');
            landingPages.find('.rankingConEditable').html(rank);
        }
    });
});
rankingCon_5.find('.img').click(function(event){
    if(typeof isPublic === 'undefined'){
        event.preventDefault();
        var element = $(this);
        var parent = element.closest('.rankingCon-5');
        var rank = _parseInt(element.attr('data-rank'));
        parent.attr('data-rate',rank);
        var landingPages = parent.closest('.landingPages');
        landingPages.find('.rankingConEditable').html(rank);
    }
});
rankingCon_5.find('.box').mouseover(function(){
    var element = $(this);
    var parent = element.closest('.rankingCon-5');
    var rank = _parseInt(element.find('.img').attr('data-rank'));
    var hidden = 'notOpen';
    var shown = 'open';
    for(var i = 1; i <= 5; i++){

        if(i <= rank){
            parent.find('.box-'+i).addClass(shown).removeClass(hidden);
        }
        else{
            parent.find('.box-'+i).removeClass(shown).addClass(hidden);
        }
    }
});
rankingCon_5.mouseout(function(){
    var element = $(this);
    var parent = element
    var rank = _parseInt(parent.attr('data-rate'));
    var hidden = 'notOpen';
    var shown = 'open';
    for (var i = 1; i <= 5; i++) {
        if (i <= rank) {
            parent.find('.box-' + i).addClass(shown).removeClass(hidden);
        }
        else {
            parent.find('.box-' + i).removeClass(shown).addClass(hidden);
        }
    }

});