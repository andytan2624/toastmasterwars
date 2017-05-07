var reportingModule = (function () {
    var init = function() {
        console.log('This is the test');
        $('.category-radio-button').click( function(e) { submitReportingForm(this) } );

    };

    var submitReportingForm = function(e) {
        console.log('JENNY');
        $(e).closest('form').submit();
    };

    return {
        init: init,
        submitReportingForm: submitReportingForm
    };
})();

reportingModule.init();
//# sourceMappingURL=reporting.js.map
