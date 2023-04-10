<div id="backblaze-tab"></div>
<h2 data-i18n="backblaze.title"></h2>

<table id="backblaze-tab-table" style="max-width:475px;"><tbody></tbody></table>

<script>
$(document).on('appReady', function(){
    $.getJSON(appUrl + '/module/backblaze/get_data/' + serialNumber, function(data){
        var table = $('#backblaze-tab-table');
        $.each(data, function(key,val){
            var th = $('<th>').text(i18n.t('backblaze.column.' + key));
            var td = $('<td>').text(val);
            if (key === 'lastbackupcompleted') {
                td = $('<td>').text(moment.unix(val).fromNow());
            } else if (key === 'safety_frozen') {
                td = $('<td>').text(val == 1 ? "Yes" : "No");
                if (val == 1) {
                    td.css('color', 'red');
                }
            } else if (key === 'encrypted') {
                td = $('<td>').text(val == 1 ? "Yes" : "No");
            } else if (key === 'remainingnumbytesforbackup') {
                td = $('<td>').text(fileSize(val,2));
            } else if (key === 'totnumbytesforbackup') {
                td = $('<td>').text(fileSize(val,2));
            } else if (key === 'remainingnumfilesforbackup') {
                td = $('<td>').text(addThousandsSeparator(val));
            } else if (key === 'totnumfilesforbackup') {
                td = $('<td>').text(addThousandsSeparator(val));
            } else {
                td = $('<td>').text(val);
            }
            table.append($('<tr>').append(th, td));
        });
    });
});

function fileSize(size, decimals){
	// Check if number
	if(!isNaN(parseFloat(size)) && isFinite(size)){
		if(size == 0){ return '0 B'}
		if(decimals == undefined){decimals = 0};
		var i = Math.floor( Math.log(size) / Math.log(1000) );
		return ( size / Math.pow(1000, i) ).toFixed(decimals) * 1 + ' ' + ['', 'K', 'M', 'G', 'T', 'P', 'E'][i] + 'B';
	}
}

function addThousandsSeparator(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>

