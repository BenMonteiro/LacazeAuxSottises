export default class PerformanceForm {

    // This class allow to add a performance form included in company form

    constructor() {
        this.collectionHolder = $('div.perfs');
        this.addPerfButton = $('<button type="button" class="add_perf_link">Ajouter une représentation</button>');
        this.newLinkLi = $('<li class="list-unstyled"></li>').append(this.addPerfButton);

        this.addTag();
    }

    // setup an "add a tag" link
    addTag() {
        jQuery(document).ready(function () {
            // Get the ul that holds the collection of tags
            this.collectionHolder = $('div.perfs');

            for (let $x = 0; $x < 10000; $x++) {
                this.collectionHolder.find('div#company_performances_' + $x).each(function () {
                    let tagFormLi = $('div#company_performances_' + $x)
                    this.addTagFormDeleteLink(tagFormLi);
                }.bind(this));
            }

            // add the "add a tag" anchor and li to the tags ul
            this.collectionHolder.append(this.newLinkLi);

            // count the current form inputs we have (e.g. 2), use that as the new
            // index when inserting a new item (e.g. 2)
            this.collectionHolder.data('index', this.collectionHolder.find(':input').length);

            this.addPerfButton.on('click', function () {
                // add a new tag form (see next code block)
                this.addPerfForm(this.collectionHolder, this.newLinkLi);
            }.bind(this));
        }.bind(this));
    }

    addPerfForm() {
        // Get the data-prototype explained earlier
        let prototype = this.collectionHolder.data('prototype');

        // get the new index
        let index = this.collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        let newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        this.collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        let $newFormLi = $('<li class="list-unstyled"></li>').append(newForm);
        this.newLinkLi.before($newFormLi);

        this.addTagFormDeleteLink($newFormLi);
    }

    addTagFormDeleteLink(tagFormLi) {
        let $removeFormButton = $('<button type="button">Supprimer la représentation</button>');
        tagFormLi.append($removeFormButton);

        $removeFormButton.on('click', function (e) {
            // remove the li for the tag form
            tagFormLi.remove();
        });
    }
}