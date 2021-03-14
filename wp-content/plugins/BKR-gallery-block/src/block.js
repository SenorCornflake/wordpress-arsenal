import { registerBlockType } from "@wordpress/blocks";
import { MediaUpload, MediaUploadCheck } from "@wordpress/block-editor";
import { Button } from "@wordpress/components";

import ImageSlider from "./slider-ui.js";

const edit = (props) => {
	const addMedia = (media) => {
		props.setAttributes({ media })
	}
	return (
		<>
			<div style={{ display: "flex", flexWrap: "wrap" }}>
			{
				props.attributes.media.map((image) => <img src={ image.url } style={{ maxWidth: "150px", border: "solid 1px #222222", margin: "5px", padding: "2px" }} />)
			}
			</div>
			<MediaUploadCheck>
				<MediaUpload 
					onSelect={ addMedia }
					multiple
					value = { props.attributes.media.map(image => image.id) }
					render = { ( { open } ) => (
						<Button onClick={ open } isPrimary>
							Add/Edit Images
						</Button>
					) }
				/>
			</MediaUploadCheck>
		</>
	);
		
}

const save = (props) => {
	const urls = props.attributes.media.map(image => image.url);
	return <ImageSlider urls={ urls } />;
}

registerBlockType(
	"bkr-gallery-block/gallery-block",
	{
		title: "BKR Gallery",
		icon: "format-gallery",
		category: "common",
		attributes: {
			media: {
				type: "array",
				default: []
			}
		},
		edit: edit,
		save: save
	}
);
