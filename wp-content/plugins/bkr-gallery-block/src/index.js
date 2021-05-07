import { registerBlockType } from "@wordpress/blocks"
import { MediaUpload, MediaUploadCheck, InspectorControls } from "@wordpress/block-editor";
import { Button, ColorPicker } from "@wordpress/components";

registerBlockType(
	"bkr-blocks/gallery-block", 
	{
		title: "BKR Gallery",
		category: "media",
		icon: "format-gallery",
		attributes: {
			images: {
				type: "array",
				default: []
			},
			button_location: {
				type: "string",
				default: "image"
			},
			thumbnails: {
				type: "string",
				default: "none"
			},
			indicators: {
				type: "string",
				default: "bullet"
			},
			fullscreen: {
				type: "bool",
				default: false
			},
			interval: {
				type: "int",
				default: 0
			},
			advanced_mode: {
				type: "bool",
				default: false
			}
		},

		edit ( props ) {
			const addImages = ( images ) => {
				images = images.map( ( image ) => {
					let already_have_image = false;
					let old_image_object = null;

					// Check if we already have the image in the attributes so that we don't overwrite any changes the user made
					props.attributes.images.map( ( existing_image ) => {
						if ( image.url === existing_image.object.url ) {
							already_have_image = true;
							old_image_object = existing_image;
						}
					} );

					if ( already_have_image ) {
						return {
							object: image,
							overlay_text: old_image_object.overlay_text,
							overlay_text_color: old_image_object.overlay_text_color,
							overlay_background: old_image_object.overlay_background,
							overlay_text_position: old_image_object.overlay_text_position,
							overlay_text_margins: old_image_object.overlay_text_margins,
						};
					} else {
						return {
							object: image,
							overlay_text: "",
							overlay_text_color: { rgb: { r: 255, g: 255, b: 255, a: 1 } },
							overlay_background: { rgb: { r: 0, g: 0, b: 0, a: 0.20 } },
							overlay_text_position: "",
							overlay_text_margins: ""
						};
					}
				} );
				props.setAttributes( { images: images } );
			};

			const changeOverlayText = ( value, index ) => {
				// "let images = props.attributes.images" won't work, because it is actually a reference, not a copy.
				// By modifying a reference, it changes the original object it refers to, and directly modifying "props.attributes"
				// does not change the state of the update button in gutenberg, you have to edit it through "props.setAttributes", BUT "props.setAttributes"
				// checks to see if the attributes that you are setting is different from the old attributes and since we edited the reference
				// it has already changed, so there is no way to change the state of the update button legitimately (that I can think of, I'm tired)
				// this hack below prevents referencing by cloning the ENTIRE object by stringifying and then parsing back to an object (which is bad),
				// but honestly, it works and I've been stuck on this for more than a day now.
				let images = JSON.parse(JSON.stringify(props.attributes.images));
				images[index].overlay_text = value;
				props.setAttributes( { images: images } );
			}

			const changeOverlayBackground = ( value, index ) => {
				let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
				images[index].overlay_background = value;
				props.setAttributes( { images: images } );
			}

			const changeOverlayTextColor = ( value, index ) => {
				let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
				images[index].overlay_text_color = value;
				props.setAttributes( { images: images } );
			}

			const changeOverlayTextPosition = ( value, index ) => {
				let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
				images[index].overlay_text_position = value;
				props.setAttributes( { images: images } );
			}

			const changeOverlayTextMargins = ( value, index ) => {
				let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
				images[index].overlay_text_margins = value;
				props.setAttributes( { images: images } );
			}

			const removeImage = ( index ) => {
				let images = JSON.parse( JSON.stringify( props.attributes.images ) ); // REFER TO COMMENT ABOVE FOR EXPLANATION
				images.splice( index, 1 )
				props.setAttributes( { images: images } );
			}

			const removeImages = () => {
				props.setAttributes( { images: [] } );
			};

			const toggleColorPicker = ( e ) => {

				let pickers = document.querySelectorAll( ".bkr-gallery-block-color_picker" );
				for ( let i = 0; i < pickers.length; i++ ) {
					if ( pickers[i].parentElement != e.target.parentElement ) {
						pickers[i].style.display = "none";
					}
				}

				let picker = e.target.parentElement.querySelector( ".bkr-gallery-block-color_picker" );

				if ( picker.style.display == "block" ) {
					picker.style.display = "none";
				} else {
					picker.style.display = "block";
				}
			}


			let controls = <InspectorControls>
						<div className="components-panel__body is-opened">
							<div className="bkr-gallery-block-inspector-controls-item">
								<label for="bkr-gallery-block-button_location">Button Location</label>
								<select id="bkr-gallery-block-button_location" onChange={ ( e ) => { props.setAttributes( { button_location: e.target.value } ) } }>
									<option value="image" selected={ ( props.attributes.button_location === "image" ) ? true : false }>Image</option>
									<option value="indicators" selected={ ( props.attributes.button_location === "indicators" ) ? true : false }>Indicators</option>
								</select>
							</div>
							<div className="bkr-gallery-block-inspector-controls-item">
								<label for="bkr-gallery-block-thumbnails">Thumbnails</label>
								<select id="bkr-gallery-block-thumbnails" onChange={ ( e ) => { props.setAttributes( { thumbnails: e.target.value } ) } }>
									<option value="none" selected={ ( props.attributes.thumbnails === "none" ) ? true : false }>None</option>
									<option value="wrap" selected={ ( props.attributes.thumbnails === "wrap" ) ? true : false }>Wrap</option>
									<option value="scroll" selected={ ( props.attributes.thumbnails === "scroll" ) ? true : false }>Scroll</option>
								</select>
							</div>
							<div className="bkr-gallery-block-inspector-controls-item">
								<label for="bkr-gallery-block-indicators">Indicators</label>
								<select id="bkr-gallery-block-indicators" onChange={ ( e ) => { props.setAttributes( { indicators: e.target.value } ) } }>
									<option value="none" selected={ ( props.attributes.indicators === "none" ) ? true : false }>None</option>
									<option value="bullet" selected={ ( props.attributes.indicators === "bullet" ) ? true : false }>Bullets</option>
									<option value="number" selected={ ( props.attributes.indicators === "number" ) ? true : false }>Numbered</option>
								</select>
							</div>
							<div className="bkr-gallery-block-inspector-controls-item">
								<label for="bkr-gallery-block-interval">Interval between slides (0 to disable)</label>
								<input id="bkr-gallery-block-interval" type="number" value={ props.attributes.interval } onChange={ ( e ) => { props.setAttributes( { interval: e.target.value } ) } } />
							</div>
							<div className="bkr-gallery-block-inspector-controls-item checkbox">
								<label for="bkr-gallery-block-fullscreen">Enable Fullscreen preview</label>
								<input id="bkr-gallery-block-fullscreen" type="checkbox" checked={ ( props.attributes.fullscreen ) ? true : false } onChange={ ( e ) => { props.setAttributes( { fullscreen: e.target.checked } ) } } />
							</div>
							<div className="bkr-gallery-block-inspector-controls-item checkbox">
								<label for="bkr-gallery-block-advanced_mode">Enable Advanced Mode</label>
								<input id="bkr-gallery-block-advanced_mode" type="checkbox" checked={ ( props.attributes.advanced_mode ) ? true : false } onChange={ ( e ) => { props.setAttributes( { advanced_mode: e.target.checked } ) } } />
							</div>
						</div>
					</InspectorControls>

			return (
				<>
					{ controls }
					<div>
						<div style={{ display: "flex", flexWrap: "wrap" }}>
						{
							(() => {
								if ( props.attributes.advanced_mode ) {
									return props.attributes.images.map( ( image, index ) => {
										return <div className="bkr-gallery-block-image_preview">
												<img src={ image.object.url } />
												<textarea placeholder="Overlay Text"                                                       onChange={ ( e ) => { changeOverlayText( e.target.value, index ) } }>{ image.overlay_text }</textarea>
												<div class="bkr-gallery-block-color_picker_container">
													<Button onClick={ ( e ) => toggleColorPicker( e ) } style={{ background: 'rgba(' + image.overlay_background.rgb.r + "," + image.overlay_background.rgb.g + "," + image.overlay_background.rgb.b + "," + image.overlay_background.rgb.a + ")"  }}>
														Overlay Background
													</Button>
													<ColorPicker className="bkr-gallery-block-color_picker" color={ image.overlay_background } onChangeComplete={ ( value ) => changeOverlayBackground( value, index ) }/>
												</div>
												<div class="bkr-gallery-block-color_picker_container">
													<Button onClick={ ( e ) => toggleColorPicker( e ) } style={{ background: 'rgba(' + image.overlay_text_color.rgb.r + "," + image.overlay_text_color.rgb.g + "," + image.overlay_text_color.rgb.b + "," + image.overlay_text_color.rgb.a + ")"  }}>
														Overlay Text Color
													</Button>
													<ColorPicker className="bkr-gallery-block-color_picker" color={ image.overlay_text_color } onChangeComplete={ ( value ) => changeOverlayTextColor( value, index ) }/>
												</div>
												<select onChange={ ( e ) => { changeOverlayTextPosition( e.target.value, index ); } }>
													<option value=""              selected={ ( image.position === "" )              ? true : false }>Overlay Text Position</option>
													<option value="top_left"      selected={ ( image.position === "top_left" )      ? true : false }>Top Left</option>
													<option value="top_center"    selected={ ( image.position === "top_center" )    ? true : false }>Top Center</option>
													<option value="top_right"     selected={ ( image.position === "top_right" )     ? true : false }>Top Right</option>
													<option value="middle_left"   selected={ ( image.position === "middle_left" )   ? true : false }>Middle Left</option>
													<option value="middle_center" selected={ ( image.position === "middle_center" ) ? true : false }>Middle Center</option>
													<option value="middle_right"  selected={ ( image.position === "middle_right" )  ? true : false }>Middle Right</option>
													<option value="bottom_left"   selected={ ( image.position === "bottom_right" )  ? true : false }>Bottom Left (default)</option>
													<option value="bottom_center" selected={ ( image.position === "bottom_center" ) ? true : false }>Bottom Center</option>
													<option value="bottom_right"  selected={ ( image.position === "bottom_left" )   ? true : false }>Bottom Right</option>
												</select>
												<Button onClick={ () => { removeImage( index ); } } isDestructive>
													Remove Image
												</Button>
											</div>
									} );
								} else {
									return props.attributes.images.map( ( image, index ) => {
										return <div className="bkr-gallery-block-image_preview">
												<img src={ image.object.url } />
												<textarea placeholder="Overlay Text" onChange={ ( e ) => { changeOverlayText( e.target.value, index ) } }>{ image.overlay_text }</textarea>
												<Button onClick={ () => { removeImage( index ); } } style={{ margin: "5px" }} isDestructive>
													Remove Image
												</Button>
											</div>
									} );
								}
							})()
						}
						</div>
						<MediaUploadCheck>
							<MediaUpload
							onSelect={ addImages }
							multiple={ true }
							value = { props.attributes.images.map( image => image.object.id ) }
							render = { ( { open } ) => (
								<Button onClick={ open } isPrimary>
									Add Images
								</Button>
							) }
							/>
						</MediaUploadCheck>
						<Button onClick={ removeImages } style={{ margin: "5px" }} isDestructive>
							Remove Images
						</Button>
					</div>
				</>
			);
		
		},

		save () {
			return null;
		}
	} );
