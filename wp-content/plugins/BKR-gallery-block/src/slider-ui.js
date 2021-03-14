export default function ImageSlider({ urls }) {
	// Create all the images
	let images = urls.map((url) => {
		return <img src={ url } />
	});

	return <>
		<div className="bkr-gallery-block">
			<div className="bkr-gallery-block-images">
				{ images }
				<button className="bkr-gallery-block-prev">&lt;- Previous</button>
				<button className="bkr-gallery-block-next">Next -&gt;</button>
			</div>
		</div>
	</>;
}
