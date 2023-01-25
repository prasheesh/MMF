//choose no of passenger adult
$('body').on('click', '#passengerCount li', function () {

    $("#passengerCount li").removeClass('active');
    $(this).addClass('active');
});


/***
 * Number Of child
 */

$('body').on('click', '.passengerCountchild li', function () {

    $(".passengerCountchild li").removeClass('active');
    $(this).addClass('active');
});

/***
 * Number Of Infant
 */


$('body').on('click', '.passengerCountinfant li', function () {
    $(".passengerCountinfant li").removeClass('active');
    $(this).addClass('active');
    const adultsvalues = $("#passengerCount .active").data('val'),
        infantsvalues = $(".passengerCountinfant .active").data('val');

    if (adultsvalues >= infantsvalues) {
        $('.remove').empty();
        $('#saveTravelDetail').prop('disabled', false);
    } else {
        $('.remove').empty();
        $('#saveTravelDetail').prop('disabled', true);
        $('.errorinfant').append(`<span class='input-error remove' style='color:red;'>Number of infants cannot be more than adults</span>`);
    }


});

/***
 * Choose travel type
 */
$('body').on('click', '#chooseTravel li', function () {

    $("#chooseTravel li").removeClass('active');
    $(this).addClass('active');
});


/**
 * Modal Popup Save Changes and store to session storage
 */
$('body').on('click', '#saveTravelDetail', function () {

    sessionStorage.clear();

    /** Number of Adults **/

    var adultsVal = $("#passengerCount .active").data('val');
    var adultsId = $("#passengerCount .active").attr('id');

    sessionStorage.setItem('adultsVal', adultsVal);
    sessionStorage.setItem('adultsId', adultsId);

    /** End Number of Adults **/

    /**** Travel Class ****/

    var travelClassVal = $("#chooseTravel .active").data('val');
    var travelId = $("#chooseTravel .active").attr('id');

    sessionStorage.setItem('travelClassVal', travelClassVal);
    sessionStorage.setItem('travelId', travelId);

    /**** End Travel Class ****/


    /*** Number of Child ***/

    var childVal = $(".passengerCountchild .active").data('val');
    var childId = $(".passengerCountchild .active").attr('id');

    sessionStorage.setItem('childVal', childVal);
    sessionStorage.setItem('childId', childId);


    /*** End Number of Child ***/


    /*** Number of Infant ***/

    var infantVal = $(".passengerCountinfant .active").data('val');
    var infantId = $(".passengerCountinfant .active").attr('id');

    sessionStorage.setItem('infantVal', infantVal);
    sessionStorage.setItem('infantId', infantId);


    /*** End Number of Infant ***/

    $("input[name='travelClass']").val(travelClassVal);
    $("input[name='adultval']").val(adultsVal);

    $("input[name='childval']").val(childVal);
    $("input[name='infantval']").val(infantVal);

    travelName = travelvaluess(travelClassVal);

    /*****
     * Counting the all Passenger & Travel class for view display
     *****/

    const allpassenger = adultsVal + childVal + infantVal;

    if (allpassenger > 1) {
        $('#travelInfo').replaceWith('<div class="airport-name" id="travelInfo"><p><b>' +
            allpassenger + ' Travellers </b></p><p>' + travelName + '</p></div>');
        $('#travelInfo').replaceWith('<div class="airport-name travelInfo" id="travelInfo"><p><b>' +
            allpassenger + ' Travellers </b></p><p>' + travelName + '</p></div>');
    } else {
        $('#travelInfo').replaceWith('<div class="airport-name" id="travelInfo"><p><b>' +
            allpassenger + ' Traveller </b></p><p>' + travelName + '</p></div>');
        $('#travelInfo').replaceWith('<div class="airport-name travelInfo" id="travelInfo"><p><b>' +
            allpassenger + ' Traveller </b></p><p>' + travelName + '</p></div>');
    }

    /*****
     * Counting the all Passenger & Travel class for view display
     *****/

});

/**
 * End Modal Popup Save Changes and store to session storage         */


/**
 * show the number of travellers display when session is there
 */

const adultvalue = sessionStorage.getItem('adultsVal'),
    childvalue = sessionStorage.getItem('childVal'),
    travelvalues = sessionStorage.getItem('travelClassVal'),
    infantvalue = sessionStorage.getItem('infantVal');




if (adultvalue == null && childvalue == null && infantvalue == null && travelvalues == null) {
    const adultvalue = 1,
        childvalue = 0,
        infantvalue = 0,
        travelvalue = 'ECONOMY';

    travelName = travelvaluess(travelvalue);

    /**
     * Set Input Value in Front End
     */
    $("input[name='travelClass']").val(travelvalue);
    $("input[name='adultval']").val(adultvalue);
    $("input[name='childval']").val(childvalue);
    $("input[name='infantval']").val(infantvalue);
    /**
     * End Set Input Value in Front End
     */

    allpassengercount = parseInt(adultvalue) + parseInt(childvalue) + parseInt(infantvalue);
} else {
    allpassengercount = parseInt(adultvalue) + parseInt(childvalue) + parseInt(infantvalue);
    travelvalue = travelvalues;

    travelName = travelvaluess(travelvalue);

    /**
     * Set Input Value in Front End
     */
    $("input[name='travelClass']").val(travelvalue);
    $("input[name='adultval']").val(adultvalue);
    $("input[name='childval']").val(childvalue);
    $("input[name='infantval']").val(infantvalue);
    /**
     * End Set Input Value in Front End
     */
}

if (allpassengercount > 1) {
    $('#travelInfo').replaceWith('<div class="airport-name airport-name-search" id="travelInfo"><p><b>' +
        allpassengercount + ' Travellers </b></p><p>' + travelName + '</p></div>');
    $('#travelInfo').replaceWith('<div class="airport-name airport-name-search travelInfo" id="travelInfo"><p><b>' +
        allpassengercount + ' Travellers </b></p><p>' + travelName + '</p></div>');

} else {
    $('#travelInfo').replaceWith('<div class="airport-name airport-name-search" id="travelInfo"><p><b>' +
        allpassengercount + ' Traveller </b></p><p>' + travelName + '</p></div>');
    $('#travelInfo').replaceWith('<div class="airport-name airport-name-search travelInfo" id="travelInfo"><p><b>' +
        allpassengercount + ' Traveller </b></p><p>' + travelName + '</p></div>');
}
/**
 * End show the number of travellers display when session is there
 */


/**
 * When click on travel data get current values
 */
$('body').on('click', '.travellerData', function () {

    const adultsId = sessionStorage.getItem('adultsId'),
        childsId = sessionStorage.getItem('childId')
    infantsId = sessionStorage.getItem('infantId')
    travelId = sessionStorage.getItem('travelId');

    if (adultsId === null && travelId === null && childsId === null && infantsId === null) {
        return;

    } else {

        $("#passengerCount li").removeClass('active');
        $('#' + adultsId).addClass('active');

        $(".passengerCountchild li").removeClass('active');
        $('#' + childsId).addClass('active');

        $(".passengerCountinfant li").removeClass('active');
        $('#' + infantsId).addClass('active');

        $("#chooseTravel li").removeClass('active');
        $('#' + travelId).addClass('active');
    }
});

/**
* End When click on travel data get current values
*/


/**
 *
 * @param {*} travelvalue
 *
 * Travel Name get
 */
function travelvaluess(travelvalue) {

    if (travelvalue == 'PREMIUM_ECONOMY') {
        var travelName = "Premium Economy";
    } else if (travelvalue == 'ECONOMY') {
        var travelName = "Economy";
    } else if (travelvalue == 'BUSINESS') {
        var travelName = "Business";
    } else if (travelvalue == 'FIRST') {
        var travelName = "First Class";
    }
    return travelName;
}
