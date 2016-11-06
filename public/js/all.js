jQuery(document).ready(function ($) {
    // Set the Options for "Bloodhound" suggestion engine
    var engine = new Bloodhound({
        remote: {
            url: '/findUser?q=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $(".typeaheadinput").typeahead({
        hint: true,
        highlight: true,
        minLength: 2
    }, {
        source: engine.ttAdapter(),

        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'usersList',
        display: 'first_name',
        // COULD HAVE SOEMTHING TO DO WITH SETTING RETURN TYPE AS JSONP
        // the key from the array we want to display (name,id,email,etc...)
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            header: [
                '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function (data) {
                return '<div class="list-group-item">' + data.first_name + ' ' + data.last_name + '</div>'
            }
        }
    });

    $('#attendance').bind('typeahead:select', function (ev, suggestion) {
        $('#attendance_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
        $('#attendance_ids').val(suggestion.id + '|' + $('#attendance_ids').val());
        $('.typeaheadinput').typeahead('val', '');

    });

    $('#apologies').bind('typeahead:select', function (ev, suggestion) {
        $('#apologies_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
        $('#apologies_ids').val(suggestion.id + '|' + $('#apologies_ids').val());
        $('.typeaheadinput').typeahead('val', '');
    });

    $('#absent').bind('typeahead:select', function (ev, suggestion) {
        $('#absent_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
        $('#absent_ids').val(suggestion.id + '|' + $('#absent_ids').val());
        $('.typeaheadinput').typeahead('val', '');
    });

    $('#visitors').bind('typeahead:select', function (ev, suggestion) {
        $('#visitors_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
        $('#visitors_ids').val(suggestion.id + '|' + $('#visitors_ids').val());
        $('.typeaheadinput').typeahead('val', '');
    });

    $('#doing_table_topics').bind('typeahead:select', function (ev, suggestion) {
        $('#doing_table_topics_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
        $('#doing_table_topics_ids').val(suggestion.id + '|' + $('#doing_table_topics_ids').val());
        $('.typeaheadinput').typeahead('val', '');
    });

    $('#table_topics_evaluators').bind('typeahead:select', function (ev, suggestion) {
        $('#table_topics_evaluators_list').append('<li>' + suggestion.first_name + ' ' + suggestion.last_name + '</li>');
        $('#table_topics_evaluators_ids').val(suggestion.id + '|' + $('#table_topics_evaluators_ids').val());
        $('.typeaheadinput').typeahead('val', '');
    });


});

$('#meeting_start_time').timepicker();
$('#meeting_end_time').timepicker();
$('.speech-time').timepicker({
    'showMeridian': false,
    'defaultTime': false
});
//# sourceMappingURL=all.js.map
