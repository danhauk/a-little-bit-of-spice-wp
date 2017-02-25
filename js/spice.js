;(function($) {

var spice = {
	init: function() {
		var handler;

		$( '.search-container .cards-container' ).masonry( {
			columnWidth: '.card',
			itemSelector: '.card'
		});
		spice.bindEvents();
	},

	bindEvents: function() {
		$( '.ct-comment-trigger, .btn-comment' ).on( 'click', spice.openComments );
		$( '.ctmodal .close-panel' ).on( 'click', spice.closeComments );
		$( '.share-more' ).on( 'hover', spice.shareMore );
		$( '.share-icons' ).on( 'mouseleave', spice.shareMoreHide );
		$( '.share-on-mobile' ).on( 'click', spice.shareMobile );
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
	}
}

$( document ).ready( spice.init );

})(jQuery);
