var $collectionHolder;

// setup an "add a tag" link
var $addPerfButton = $('<button type="button" class="add_perf_link">Ajouter une représentation</button>');
var $newLinkLi = $('<li class="list-unstyled"></li>').append($addPerfButton);

jQuery(document).ready(function () {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('div.perfs');


    for (let $x = 0; $x < 10000; $x++) {
        $collectionHolder.find('div#company_performances_' + $x).each(function () {
            addTagFormDeleteLink($(this));
        });
    }

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPerfButton.on('click', function (e) {
        // add a new tag form (see next code block)
        addPerfForm($collectionHolder, $newLinkLi);
    });
});

function addPerfForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li class="list-unstyled"></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button">Supprimer la représentation</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function (e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}