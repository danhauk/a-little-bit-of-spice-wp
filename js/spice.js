;(function($) {

var spice = {
	init: function() {
		var handler;

		spice.bindEvents();
	},

	bindEvents: function() {
		$( '.ct-comment-trigger, .btn-comment' ).on( 'click', spice.openComments );
		$( '.ctmodal .close-panel' ).on( 'click', spice.closeComments );
		$( '.share-more' ).on( 'hover', spice.shareMore );
		$( '.share-icons' ).on( 'mouseleave', spice.shareMoreHide );
	},

	openComments: function() {
		$( '.ctmodal' ).show();
		$( '.ctmodal .overlay-content' ).addClass( 'easeInRight-appear' );
	},

	closeComments: function() {
		$( '.ctmodal .overlay-content' ).removeClass( 'easeInRight-appear' ).addClass( 'easeInRight-leave' );
		$( '.ctmodal' ).css( 'opacity', 0 );
		setTimeout( function() {
			$( '.ctmodal' ).hide();
		}, 300 );
	},

	shareMore: function() {
		$( '.ct-post-actions .actions' ).addClass( 'expanded' );
	},

	shareMoreHide: function() {
		$( '.ct-post-actions .actions' ).removeClass( 'expanded' );
	}
}

$( document ).ready( spice.init );

})(jQuery);
