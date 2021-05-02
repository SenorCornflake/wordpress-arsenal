import { registerBlockType } from "@wordpress/blocks"
import { MediaUpload, MediaUploadCheck, InspectorControls } from "@wordpress/block-editor";
import { Button } from "@wordpress/components";

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
							// overlay_width: old_image_object.overlay_width,
							// overlay_height: old_image_object.overlay_height,
							overlay_text_position: old_image_object.overlay_text_position,
							overlay_text_margins: old_image_object.overlay_text_margins,
						};
					} else {
						return {
							object: image,
							overlay_text: "",
							overlay_text_color: "",
							overlay_background: "",
							// overlay_width: "",
							// overlay_height: "",
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

		//	const changeOverlayWidth = ( value, index ) => {
		//		let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
		//		images[index].overlay_width = value;
		//		props.setAttributes( { images: images } );
		//	}

		//	const changeOverlayHeight = ( value, index ) => {
		//		let images = JSON.parse(JSON.stringify(props.attributes.images)); // REFER TO COMMENT ABOVE FOR EXPLANATION
		//		images[index].overlay_height = value;
		//		props.setAttributes( { images: images } );
		//	}

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
												{ //<input type="text" placeholder="Overlay Background"   value={ image.overlay_background }   onChange={ ( e ) => { changeOverlayBackground( e.target.value, index ) } } />
												}
												<select                                                                                    onChange={ ( e ) => { changeOverlayBackground( e.target.value, index ); } }>
													<option value=""          selected={ ( image.overlay_background === "" )          ? true : false }>Overlay Backround</option>
													<option value="#ff000040" selected={ ( image.overlay_background === "#ff000040" ) ? true : false }>Red</option>
													<option value="#00ff0040" selected={ ( image.overlay_background === "#00ff0040" ) ? true : false }>Green</option>
													<option value="#0000ff40" selected={ ( image.overlay_background === "#0000ff40" ) ? true : false }>Blue</option>
													<option value="#00000040" selected={ ( image.overlay_background === "#00000040" ) ? true : false }>Black</option>
													<option value="#ffffff40" selected={ ( image.overlay_background === "#ffffff40" ) ? true : false }>White</option>
												</select>
												{//<input type="text" placeholder="Overlay Text Color"   value={ image.overlay_text_color }   onChange={ ( e ) => { changeOverlayTextColor( e.target.value, index ) } } />
												}
												<select                                                                                    onChange={ ( e ) => { changeOverlayTextColor( e.target.value, index ); } }>
													<option value=""          selected={ ( image.overlay_text_color === "" )          ? true : false }>Overlay Text Color</option>
													<option value="#ff0000" selected={ ( image.overlay_text_color === "#ff0000" ) ? true : false }>Red</option>
													<option value="#00ff00" selected={ ( image.overlay_text_color === "#00ff00" ) ? true : false }>Green</option>
													<option value="#0000ff" selected={ ( image.overlay_text_color === "#0000ff" ) ? true : false }>Blue</option>
													<option value="#000000" selected={ ( image.overlay_text_color === "#000000" ) ? true : false }>Black</option>
													<option value="#ffffff" selected={ ( image.overlay_text_color === "#ffffff" ) ? true : false }>White</option>
												</select>
												{//<input type="text" placeholder="Overlay Width"        value={ image.overlay_width }        onChange={ ( e ) => { changeOverlayWidth( e.target.value, index ) } } />
												}
												{//<input type="text" placeholder="Overlay Height"       value={ image.overlay_height }        onChange={ ( e ) => { changeOverlayHeight( e.target.value, index ) } } />
												}
												{//<input type="text" placeholder="Overlay Text Margins" value={ image.overlay_text_margins } onChange={ ( e ) => { changeOverlayTextMargins( e.target.value, index ) } } />
												}
												<select                                                                                    onChange={ ( e ) => { changeOverlayTextPosition( e.target.value, index ); } }>
													<option value=""             selected={ ( image.position === "" )                   ? true : false }>Overlay Text Position</option>
													<option value="top_left"     selected={ ( image.position === "top_left" )           ? true : false }>Top Left</option>
													<option value="top_center"     selected={ ( image.position === "top_center" )       ? true : false }>Top Center</option>
													<option value="top_right"    selected={ ( image.position === "top_right" )          ? true : false }>Top Right</option>
													<option value="middle_left"     selected={ ( image.position === "middle_left" )     ? true : false }>Middle Left</option>
													<option value="middle_center"     selected={ ( image.position === "middle_center" ) ? true : false }>Middle Center</option>
													<option value="middle_right"    selected={ ( image.position === "middle_right" )    ? true : false }>Middle Right</option>
													<option value="bottom_left"  selected={ ( image.position === "bottom_right" )       ? true : false }>Bottom Left</option>
													<option value="bottom_center"  selected={ ( image.position === "bottom_center" )     ? true : false }>Bottom Center</option>
													<option value="bottom_right" selected={ ( image.position === "bottom_left" )        ? true : false }>Bottom Right</option>
												</select>
												<Button onClick={ () => { removeImage( index ); } } style={{ margin: "5px", display: "flex", justifyContent: "center" }} isDestructive>
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
								<Button onClick={ open } style={{ margin: "5px" }} isPrimary>
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
