import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import { PanelBody, TextControl, ColorPicker, SelectControl } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
    const { heading, description, buttonText, buttonUrl, backgroundColor, textColor, alignment } = attributes;

    const blockProps = useBlockProps({
        style: {
            backgroundColor: backgroundColor,
            color: textColor,
            textAlign: alignment,
        },
    });

    return (
        <>
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

            <div {...blockProps} className="wp-block-create-block-call-to-action">
                <div className="cta-content">
                    <RichText
                        tagName="h2"
                        className="cta-heading"
                        value={heading}
                        onChange={(value) => setAttributes({ heading: value })}
                        placeholder={__('Enter heading...', 'call-to-action-block')}
                        style={{ color: textColor }}
                    />

                    <RichText
                        tagName="p"
                        className="cta-description"
                        value={description}
                        onChange={(value) => setAttributes({ description: value })}
                        placeholder={__('Enter description...', 'call-to-action-block')}
                        style={{ color: textColor }}
                    />

                    <RichText
                        tagName="span"
                        className="cta-button"
                        value={buttonText}
                        onChange={(value) => setAttributes({ buttonText: value })}
                        placeholder={__('Button text...', 'call-to-action-block')}
                    />
                </div>
            </div>
        </>
    );
}
