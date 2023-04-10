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

