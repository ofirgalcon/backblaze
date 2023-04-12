var formatBZYesNoNice = function(col, row){
    var cell = $('td:eq('+col+')', row),
        value = cell.text()
    value = value == '0' ? mr.label(i18n.t('no'), 'success') :
        (value === '1' ? mr.label(i18n.t('yes'), 'danger') : '')
    cell.html(value)
}

// Filters

var safety_frozen_filter = function(colNumber, d){
    // Look for 'not_safety_frozen' keyword
    if(d.search.value.match(/^not_safety_frozen$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'safety_frozen' keyword
    if(d.search.value.match(/^safety_frozen$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var encrypted = function(colNumber, d){
    // Look for 'not_safety_frozen' keyword
    if(d.search.value.match(/^not_encrypted$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'safety_frozen' keyword
    if(d.search.value.match(/^encrypted$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var lastBackupFilter = function(colNumber, d){

    var currentTime = Math.floor(Date.now() / 1000);
    if(d.search.value.match(/^lastbackupcompleted_fresh$/))
    {
         var thresh = (currentTime - 604800);
        // var thresh = 1672570389;
        
        // Add column specific search
         d.columns[colNumber].search.value = '> ' + (parseInt(thresh));
        // Clear global search
        d.search.value = '';
    }

    if (d.search.value.match(/^lastbackupcompleted_oneweekplus$/)) {
        var thresh1 = (currentTime - 604801);
        var thresh2 = (currentTime - 1209600);
    
        // Add column specific search
        d.columns[colNumber].search.value = 'BETWEEN ' + (parseInt(thresh2)) + ' AND ' + (parseInt(thresh1));
        // Clear global search
        d.search.value = '';
    }
    


    
    if(d.search.value.match(/^lastbackupcompleted_twoweeksplus$/))
    {
         var thresh = (currentTime - 1209601);
        
        // Add column specific search
         d.columns[colNumber].search.value = '< ' + (parseInt(thresh));
        // Clear global search
        d.search.value = '';
    }

}
