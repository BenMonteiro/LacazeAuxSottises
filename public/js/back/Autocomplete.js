export default class Autocomplete {

    constructor() {
        this.autocomplete();
    }

    autocomplete() {
        $(document).ready(function () {
            $('.js-company-autocomplete').each(function () {
                var autocompleteUrl = $(this).data('autocomplete-url');
                $(this).autocomplete({
                    hint: false
                }, [{
                    source: function (query, cb) {
                        $.ajax({
                            url: autocompleteUrl + '?query=' + query
                        }).then(function (data) {
                            cb(data.companies);
                        });
                    },
                    displayKey: 'name',
                    debounce: 500
                }]);
            });
        });
    }
}