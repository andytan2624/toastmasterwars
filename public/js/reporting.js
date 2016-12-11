var reportingModule = (function () {
    var init = function() {
        $('.category-radio-button').click( function(e) { submitReportingForm(this) } );
    };

    var submitReportingForm = function(e) {
        $(e).closest('form').submit();
    };

    return {
        init: init,
        submitReportingForm: submitReportingForm
    };
})();

reportingModule.init();