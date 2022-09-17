/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import {
	InnerBlocks,
	BlockControls,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from '@wordpress/block-editor';
import { ToolbarButton } from '@wordpress/components';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 * @return {WPElement} Element to render.
 */

const ALLOWED_BLOCKS = [
	'core/heading',
	'core/paragraph',
	'core/list',
	'core/button',
];
const TEMPLATE = [
	['core/heading', { placeholder: 'Featured Content Title' }],
	['core/paragraph', { placeholder: 'Featured Content Text' }],
	['core/button', { placeholder: 'Featured Content CTA' }],
];
const ALLOWED_MEDIA_TYPES = ['image'];

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps({
		className: 'featured-content',
	});
	const { image } = attributes;

	return (
		<div {...blockProps}>
			<BlockControls>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={(media) => {
							const url = media.sizes.hasOwnProperty('bp-card-lg')
								? media.sizes['bp-card-lg'].url
								: 'https://via.placeholder.com/850x575/FF0000/FFFFFF?text=Source+Image+Must+Be+At+Least+850x575';
							const id = media.sizes.hasOwnProperty('bp-card-lg')
								? media.id
								: 0;
							const alt = media.sizes.hasOwnProperty('bp-card-lg')
								? media.alt
								: 'Featured Content Placeholder Image';
							setAttributes({
								image: {
									id,
									url,
									alt,
								},
							});
						}}
						allowedTypes={ALLOWED_MEDIA_TYPES}
						value={image.id}
						render={({ open }) => (
							<ToolbarButton onClick={open}>
								{__('Choose Image', 'blueprint')}
							</ToolbarButton>
						)}
					/>
				</MediaUploadCheck>
			</BlockControls>
			<div className="featured-content__wrap">
				<img
					className="featured-content__image"
					src={image.url}
					alt={image.alt}
				/>
				<div className="featured-content__box">
					<InnerBlocks
						allowedBlocks={ALLOWED_BLOCKS}
						template={TEMPLATE}
					/>
				</div>
			</div>
		</div>
	);
}
