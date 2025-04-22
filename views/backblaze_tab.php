<div id="backblaze-tab"></div>
<div id="lister" style="font-size: large; float: right;">
    <a href="/show/listing/backblaze/backblaze" title="List">
        <i class="btn btn-default tab-btn fa fa-list"></i>
    </a>
</div>
<div id="report_btn" style="font-size: large; float: right;">
    <a href="/show/report/backblaze/backblaze" title="Report">
        <i class="btn btn-default tab-btn fa fa-th"></i>
    </a>
</div>
<h2><i class="fa fa-cloud-upload"></i> <span data-i18n="backblaze.title"></span></h2>

<table id="backblaze-tab-table" style="max-width:475px;"><tbody></tbody></table>

<script>
$(document).on('appReady', function(){
    var table = $('#backblaze-tab-table');
    $.getJSON(appUrl + '/module/backblaze/get_data/' + serialNumber, function(data){
        var rows = [];
        $.each(data, function(key, val){
            var th = $('<th>').text(i18n.t('backblaze.column.' + key));
            var td;
            switch (key) {
                case 'lastbackupcompleted':
                    td = $('<td>').text(moment.unix(val).fromNow());
                    break;
                case 'safety_frozen':
                    td = $('<td>').text(val == 1 ? "Yes" : "No");
                    if (val == 1) {
                        td.css('color', 'red');
                    }
                    break;
                case 'encrypted':
                    td = $('<td>').text(val == 1 ? "Yes" : "No");
                    break;
                case 'remainingnumbytesforbackup':
                case 'totnumbytesforbackup':
                    td = $('<td>').text(fileSize(val, 2));
                    break;
                case 'remainingnumfilesforbackup':
                case 'totnumfilesforbackup':
                    td = $('<td>').text(addThousandsSeparator(val));
                    break;
                default:
                    td = $('<td>').text(val);
            }
            rows.push($('<tr>').append(th, td));
        });
        table.append(rows);
    });
});

function fileSize(size, decimals){
	// Check if number
	if(!isNaN(parseFloat(size)) && isFinite(size)){
		if(size == 0){ return '0 B'}
		if(decimals == undefined){decimals = 0}
		var i = Math.floor( Math.log(size) / Math.log(1000) );
		return ( size / Math.pow(1000, i) ).toFixed(decimals) * 1 + ' ' + ['', 'K', 'M', 'G', 'T', 'P', 'E'][i] + 'B';
	}
}

function addThousandsSeparator(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>

