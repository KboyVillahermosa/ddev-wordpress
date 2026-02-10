import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ColorPicker, SelectControl } from '@wordpress/components';

export default function Inspector({ attributes, setAttributes }) {
    const { buttonUrl, alignment, backgroundColor, textColor } = attributes;

    return (
        <InspectorControls>
            <PanelBody title={__('CTA Settings', 'call-to-action-block')}>
                <TextControl
                    label={__('Button URL', 'call-to-action-block')}
                    value={buttonUrl}
                    onChange={(value) => setAttributes({ buttonUrl: value })}
                    placeholder="https://example.com"
                />

                <SelectControl
                    label={__('Text Alignment', 'call-to-action-block')}
                    value={alignment}
                    options={[
                        { label: 'Left', value: 'left' },
                        { label: 'Center', value: 'center' },
                        { label: 'Right', value: 'right' },
                    ]}
                    onChange={(value) => setAttributes({ alignment: value })}
                />
            </PanelBody>

            <PanelBody title={__('Color Settings', 'call-to-action-block')} initialOpen={false}>
                <p>{__('Background Color', 'call-to-action-block')}</p>
                <ColorPicker
                    color={backgroundColor}
                    onChangeComplete={(value) => setAttributes({ backgroundColor: value.hex })}
                />

                <p style={{ marginTop: '20px' }}>{__('Text Color', 'call-to-action-block')}</p>
                <ColorPicker
                    color={textColor}
                    onChangeComplete={(value) => setAttributes({ textColor: value.hex })}
                />
            </PanelBody>
        </InspectorControls>
    );
}
