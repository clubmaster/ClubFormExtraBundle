$(document).ready(function() {

    if (autoSubmit) {
        $(id).on('typeahead:selected', function (e, datum) {
            $(id+'_hidden').val(datum.id);
            $(id).closest('form').submit();
        });
    }

    if ('function' != typeof typeaheadReplace) {
        typeaheadReplace = function(url, query) {
            return url.replace(/%QUERY/, query);
        }
    }

    var fetch = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 100,
        remote: {
            url: fetchUrl+'?q=%QUERY',
            replace: typeaheadReplace
        }
    });
    fetch.initialize();

    $(id).typeahead({
        highlight: true,
        minLength: minLength,
        hint: true
    }, {
        name: 'fetch',
        displayKey: displayValue,
        source: fetch.ttAdapter(),
        templates: {
            empty: [
                '<div class="empty-message">',
                'We could not find any matches for your search',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile(handlebar)
        }
    });
});
