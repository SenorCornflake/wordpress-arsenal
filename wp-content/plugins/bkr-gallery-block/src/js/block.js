let galleries = document.querySelectorAll( ".bkr-gallery-block" );

// Courtesy of "https://stackoverflow.com/questions/8126466/how-do-i-reset-the-setinterval-timer"
function Timer(fn, t) {
    var timerObj = setInterval(fn, t);

    this.stop = function() {
        if (timerObj) {
            clearInterval(timerObj);
            timerObj = null;
        }
        return this;
    }

    // start timer using current settings (if it's not already running)
    this.start = function() {
        if (!timerObj) {
            this.stop();
            timerObj = setInterval(fn, t);
        }
        return this;
    }

    // start with new or original interval, stop current interval
    this.reset = function(newT = t) {
        t = newT;
        return this.stop().start();
    }
}


const focus = function(gallery, index) {
	let image_containers = gallery.querySelectorAll( ".bkr-gallery-block-image-container" );
	let indicators = gallery.querySelectorAll( ".bkr-gallery-block-indicators span" );
	let thumbnails = gallery.querySelectorAll( ".bkr-gallery-block-thumbnails img" );

	let current = gallery.querySelector( '.bkr-gallery-block-image-container.current' );
	let current_indicator = gallery.querySelector( '.bkr-gallery-block-indicators span.current' );
	let current_thumbnail = gallery.querySelector( '.bkr-gallery-block-thumbnails img.current' );

	if ( current ) {
		current.classList.remove( "current" );
	}

	if ( current_indicator ) {
		current_indicator.classList.remove( "current" );
	}

	if ( current_thumbnail ) {
		current_thumbnail.classList.remove( "current" );
	}

	if ( index == image_containers.length ) {
		gallery.dataset.current = 0;
		image_containers[0].classList.add( "current" );
		if ( indicators.length > 0 ) {
			indicators[0].classList.add( "current" );
		}
		if ( thumbnails.length > 0 ) {
			thumbnails[0].classList.add( "current" );
		}
	} else if ( index == -1 ) {
		gallery.dataset.current = image_containers.length - 1;
		image_containers[image_containers.length - 1].classList.add( "current" );
		if ( indicators.length > 0 ) {
			indicators[image_containers.length - 1].classList.add( "current" );
		}
		if ( thumbnails.length > 0 ) {
			thumbnails[0].classList.add( "current" );
		}
	} else {
		gallery.dataset.current = index;
		image_containers[index].classList.add( "current" );
		if ( indicators.length > 0 ) {
			indicators[index].classList.add( "current" );
		}
		if ( thumbnails.length > 0 ) {
			thumbnails[index].classList.add( "current" );
		}
	}
}

// Set the gallery height to the largest image for a better user experience
const setGalleryHeight = function ( gallery, images ) {
	let largest_height = 0;
	
	for ( let i = 0; i < images.length; i++ ) {
		if ( images[i].height > largest_height ) {
			largest_height = images[i].height;
			gallery.dataset.largest_image = images[i].src;
		}
	}

	gallery.querySelector(".bkr-gallery-block-images").style.minHeight = largest_height + "px";
	console.log( gallery );
}



for ( let i = 0; i < galleries.length; i++ ) {
	let gallery = galleries[i];
	let images = gallery.querySelectorAll( ".bkr-gallery-block-images img" );
	let indicators = gallery.querySelectorAll( ".bkr-gallery-block-indicators span" );
	let thumbnails = gallery.querySelectorAll( ".bkr-gallery-block-thumbnails img" );
	let overlays = gallery.querySelectorAll( ".bkr-gallery-block-image-overlay" );

	let next_btn = gallery.querySelector( ".bkr-gallery-block-next-btn" );
	let prev_btn = gallery.querySelector( ".bkr-gallery-block-prev-btn" );
	let close_btn = gallery.querySelector( ".bkr-gallery-block-close-btn" );

	if ( images.length == 0 ) {
		continue;
	}


	// Set close button event if user has fullscreen enabled
	if ( gallery.dataset.fullscreen == "true" ) {
		close_btn.addEventListener( "click", function() {
			gallery.classList.toggle( "fullscreen" );
		} );
	}

	for ( let i = 0; i < images.length; i++ ) {
		// When the all the images load, resize the gallery's height to match the largest image (if done immediately all images' heights will be "0")
		images[i].addEventListener( "load", function () {
			setGalleryHeight( gallery, images );
		});

		// Toggle the fullscreen if user has it enabled
		if ( gallery.dataset.fullscreen == "true" ) {
			images[i].style.cursor = "pointer";
			images[i].addEventListener( "click", function() {
				gallery.classList.toggle( "fullscreen" );
			} )
		}
	}

	if ( gallery.dataset.fullscreen == "true" ) {
		for ( let i = 0; i < overlays.length; i++ ) {
			overlays[i].style.cursor = "pointer";
			overlays[i].addEventListener( "click", function () {
				gallery.classList.toggle( "fullscreen" );
			} );
		}
	}

	// Set gallery height when the user is finished resizing the window
	let resize_timer;

	window.addEventListener( "resize", function () {
		clearTimeout(resize_timer);
		resize_timer = setTimeout( function() {
			setGalleryHeight( gallery, images );
		}, 250 );
	});

	// Focus the first image b default
	focus(gallery, 0);

	// Go to next image at regular intervals defined by the user, later we reset it when user manually advances to another image
	let timer = null;

	if ( gallery.dataset.interval != 0 ) {
		timer = new Timer( function() {
			focus( gallery, parseInt( gallery.dataset.current ) + 1 );
		}, gallery.dataset.interval * 1000 );
	}

	// Check if the buttons are defined because it's possible the user set the
	// button location to "indicators" but disabled the indicators as well
	if ( prev_btn ) {
		prev_btn.addEventListener( "click", () => {
			focus( gallery, parseInt(gallery.dataset.current) - 1 );
			if ( timer ) {
				timer.reset();
			}
		} );
	}

	if ( next_btn ) {
		next_btn.addEventListener( "click", () => {
			focus( gallery, parseInt(gallery.dataset.current) + 1 );
			if ( timer ) {
				timer.reset();
			}
		} );
	}

	// Click event for the indicators
	for ( let i = 0; i < indicators.length; i++ ) {
		indicators[i].addEventListener( "click", function() {
			focus( gallery, i );
			if ( timer ) {
				timer.reset();
			}
		} );
	}

	// Click event for the thumbnails
	for ( let i = 0; i < thumbnails.length; i++ ) {
		thumbnails[i].addEventListener( "click", function() {
			focus( gallery, i );
			if ( timer ) {
				timer.reset();
			}
		} );
	}
}
