jQuery(document).ready(function ($) {
    $('#university-search-form').on('submit', function (e) {
        e.preventDefault();
        let universityName = $('#university-name').val();
        $('#emblem-results').html('<p>Searching...</p>');

        $.ajax({
            url: emblemSearch.ajax_url,
            method: 'POST',
            data: {
                action: 'fetch_emblems',
                university_name: universityName,
                api_key: emblemSearch.api_key,
                cx: emblemSearch.cx
            },
            success: function (response) {
                let results = JSON.parse(response);
                if (results.items) {
                    let emblems = results.items.map((item, index) => `<img src="${item.link}" alt="Emblem ${index + 1}" />`);
                    $('#emblem-results').html(emblems.join(''));
                } else {
                    $('#emblem-results').html('<p>No emblems found.</p>');
                }
            },
            error: function () {
                $('#emblem-results').html('<p>Error fetching emblems.</p>');
            }
        });
    });
});
