export default class Autocompletion {

    constructor() {
        this.client = algoliasearch('JNL7T0ADY0', 'e46ae6402cc97f42088db2fcd5b14a0c')
        this.index = this.client.initIndex('Company');
        this.companies
        this.dataTransmission();
        this.searchCompany();
    }

    dataTransmission() {
        this.index.clearIndex((err, content) => {
            if (err) throw err;

            console.log(content);
        });

        let companies = $.ajax({
            type: "POST",
            url: "/admin/performance/companies",
            data: "companies",
            dataType: "json",
            success: function (response) {

            }
        });

        this.index.addObjects(companies, (err, content) => {
            console.log(content);
        });
    }



    searchCompany() {
        $('#performance_company').autocomplete({
            hint: false
        }, [{
            source: $.fn.autocomplete.sources.hits(this.index, {
                hitsPerPage: 5
            }),
            displayKey: 'firstname',
            templates: {
                suggestion: function (suggestion) {
                    return suggestion._highlightResult.name.value;
                }
            }
        }])


    };
}