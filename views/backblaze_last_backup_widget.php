<div class="col-lg-4 col-md-6">

	<div class="panel panel-default" id="backblaze-lastbackup-widget">

		<div class="panel-heading" data-container="body">

			<h3 class="panel-title"><i class="fa fa-calendar"></i>
			    <span data-i18n="backblaze.widget.lastbackupcompleted_title"></span>
			    <list-link data-url="/show/listing/backblaze/backblaze"></list-link>
			</h3>

		</div>

		<div class="panel-body text-center">

			<a tag="twoweeksplus" class="btn btn-danger disabled">
				<span class="bigger-150"> 0 </span><br>
				14 <span data-i18n="date.day_plural"></span> +
			</a>
			<a tag="oneweekplus" class="btn btn-warning disabled">
				<span class="bigger-150"> 0 </span><br>
				< 14 <span data-i18n="date.day_plural"></span>
			</a>
			<a tag="fresh" class="btn btn-success disabled">
				<span class="bigger-150"> 0 </span><br>
				< 7 <span data-i18n="date.day"></span>
			</a>

		</div>

	</div><!-- /panel -->

</div><!-- /col -->

<script>
$(document).on('appReady', function(e, lang) {

	var panelBody = $('#backblaze-lastbackup-widget div.panel-body');

	$(document).on('appUpdate', function(e, lang) {

	    $.getJSON( appUrl + '/module/backblaze/getLastBackupStats', function( data ) {

	    	if(data.error){
	    		//alert(data.error);
	    		return;
	    	}
			var uptimeList = [
				{tag: 'fresh', search: 'lastbackupcompleted_fresh'},
				{tag: 'oneweekplus', search: 'lastbackupcompleted_oneweekplus'},
				{tag: 'twoweeksplus', search: 'lastbackupcompleted_twoweeksplus'}
			]
			$.each(uptimeList, function(i, item){
				panelBody.find('a[tag="'+item.tag+'"]')
					.attr('href', appUrl + '/show/listing/backblaze/backblaze#' + item.search)
					.toggleClass('disabled', !data[item.tag])
					.find('span.bigger-150').text(data[item.tag] || 0)
			})

	    });
	});
});

</script>
