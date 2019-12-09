jQuery('.nav-tabs a.nav-item').click(function(e){
    e.preventDefault();
    jQuery('.tab-pane, .nav-item').removeClass('active');
    tabContentSelector = jQuery(this).attr('data-target');
    jQuery(this).tab('show');
    jQuery(tabContentSelector).addClass('active');
});