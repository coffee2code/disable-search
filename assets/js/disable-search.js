wp?.domReady( () => {
	if ( wp.blocks.getBlockType( 'core/search' ) ) {
		wp.blocks.unregisterBlockType('core/search');
	}
} );
