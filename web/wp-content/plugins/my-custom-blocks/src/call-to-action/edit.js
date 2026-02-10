import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import './editor.scss';
import Inspector from '../components/call-to-action/Inspector';

export default function Edit({ attributes, setAttributes }) {
    const { heading, description, buttonText, backgroundColor, textColor, alignment } = attributes;

    const blockProps = useBlockProps({
        style: {
            backgroundColor: backgroundColor,
            color: textColor,
            textAlign: alignment,
        },
    });

    return (
        <>
            <Inspector attributes={attributes} setAttributes={setAttributes} />

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
