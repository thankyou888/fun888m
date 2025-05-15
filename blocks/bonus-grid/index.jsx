import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

registerBlockType('tailpress/bonus-grid', {
  edit() {
    return (
      <div {...useBlockProps()}>
        <p>Hello from Bonus Grid</p>
      </div>
    );
  },
  save: () => null,
});
