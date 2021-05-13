var menu = document.querySelector( ".kat-site-header-navigation" );
var show = document.querySelector( ".kat-site-header-navigation-show" );
var hide = document.querySelector( ".kat-site-header-navigation-hide" );


show.addEventListener( "click", function () {
	menu.classList.add( "visible" );
} );

hide.addEventListener( "click", function () {
	menu.classList.remove( "visible" );
} );

menu.addEventListener( "click", function ( e ) {
	if ( e.target.matches( ".kat-site-header-navigation" ) ) {
		menu.classList.remove( "visible" );
	}
} );

