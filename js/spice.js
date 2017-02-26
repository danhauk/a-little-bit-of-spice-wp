;(function($) {

var searchPageCount = 2;

var spice = {
	init: function() {
		var handler;

		// $( '.search-container .cards-container' ).masonry( {
		// 	columnWidth: '.card',
		// 	itemSelector: '.card'
		// });
		spice.infiniteSearch();
		spice.bindEvents();
	},

	bindEvents: function() {
		$( '.ct-comment-trigger, .btn-comment' ).on( 'click', spice.openComments );
		$( '.ctmodal .close-panel' ).on( 'click', spice.closeComments );
		$( '.share-more' ).on( 'hover', spice.shareMore );
		$( '.share-icons' ).on( 'mouseleave', spice.shareMoreHide );
		$( '.share-on-mobile' ).on( 'click', spice.shareMobile );
		$( '.endless_container .load-more a').on( 'click', spice.loadMoreSearch );
		$( '.dfilter' ).on( 'change', spice.courseCuisineFilter );
	},

	openComments: function() {
		$( '.ctmodal' ).show().css( 'opacity', 1 );
		$( '.ctmodal .overlay-content' ).removeClass( 'easeInRight-leave' ).addClass( 'easeInRight-appear' );
	},

	closeComments: function() {
		$( '.ctmodal .overlay-content' ).removeClass( 'easeInRight-appear' ).addClass( 'easeInRight-leave' );
		$( '.ctmodal' ).css( 'opacity', 0 );
		setTimeout( function() {
			$( '.ctmodal' ).hide();
		}, 300 );
	},

	shareMore: function() {
		$( '.ct-post-nav-content' ).addClass( 'share-expanded' );
		$( '.ct-post-actions .actions' ).addClass( 'expanded' );
	},

	shareMoreHide: function() {
		$( '.ct-post-nav-content' ).removeClass( 'share-expanded' );
		$( '.ct-post-actions .actions' ).removeClass( 'expanded' );
	},

	shareMobile: function() {
		if ( $( '.ct-post-nav-content' ).hasClass( 'share-expanded' ) ) {
			spice.shareMoreHide();
		} else {
			spice.shareMore();
		}
	},

	loadMoreSearch: function(e) {
		e.preventDefault();

		loadArticle(searchPageCount);
		searchPageCount++;
	},

	infiniteSearch: function() {
	  $(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
				loadArticle(searchPageCount);
				searchPageCount++;
			}
	  });
	},

	courseCuisineFilter: function() {
		var filter = $(this).data( 'filter' ),
				value = $(this).val();

		var currentUrl = $(location).attr('href'),
				filterParam = getUrlParameter( filter );

		if ( filterParam != undefined ) {
			// parameter currently exists
			// replace it
    	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      		sURLVariables = sPageURL.split('&'),
      		sParameterName,
      		i,
					newUrlParams;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				// if the parameter name equals what we're looking for (filter)
				// replace the value
				if ( sParameterName[0] === filter) {
					sURLVariables[i] = filter + '=' + value;
				}
			}

			newUrlParams = sURLVariables.join( '&' );
			window.location.search = newUrlParams;
		} else {
			// parameter does not exist
			// add it to the current url
			var newUrl = currentUrl + '&' + filter + '=' + value;
			location.href = newUrl;
		}
	}
}

$( document ).ready( spice.init );

})(jQuery);
