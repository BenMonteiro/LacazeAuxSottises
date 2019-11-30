jQuery('.nav-tabs a').click(function(e){
    e.preventDefault();
    jQuery('.tab-pane, .nav-link').removeClass('active');
    tabContentSelector = jQuery(this).attr('data-target');
    jQuery(this).tab('show');
    jQuery(tabContentSelector).addClass('active');
});