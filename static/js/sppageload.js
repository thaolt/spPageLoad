var spPageLoadClass = function () {
	var realContent = '';
	var styleSheets = [];
	var scripts = [];
	
	this.initBindings = function() {
		$.pjax.defaults.scrollTo = false;
		$(document).pjax('a',$('.ow_page_wrap'), {
			timeout: 6000,
			fragment: 'realbody'
		});	

		$('script[src]').each(function(index,script){
			var src = $(script).attr('src');
			if ($.inArray(src,scripts) == -1) {
				scripts.push(src);
			}
		});

		$('link[href]').each(function(index,styleSheet){
			var src = $(styleSheet).attr('href');
			if ($.inArray(src,styleSheets) == -1) {
				styleSheets.push(src);
			}
		});
	}

	// $(document).on('pjax:beforeReplace', function(options,contents) {

	// });
	$(document).on('pjax:beforeSend', function(option, xhr) {
		xhr.setRequestHeader('X-Requested-With', {toString: function(){ return ''; }});
	});
	$(document).on('pjax:error', function(options, xhr, textStatus, error) {

	});
	$(document).on('pjax:start', function(options, xhr) {
		if (xhr)
			xhr.setRequestHeader('X-Requested-With', {toString: function(){ return ''; }});
	});	
		
};

$(document).ready(function(){
	if ($.support.pjax) {
		if (typeof window.spPageLoad == 'undefined') {
			window.spPageLoad = new spPageLoadClass();
			window.spPageLoad.initBindings();
		}
	}
});

