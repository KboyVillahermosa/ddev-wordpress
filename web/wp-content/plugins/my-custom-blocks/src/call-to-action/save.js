import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { heading, description, buttonText, buttonUrl, backgroundColor, textColor, alignment } = attributes;

    const blockProps = useBlockProps.save({
        style: {
            backgroundColor: backgroundColor,
            color: textColor,
            textAlign: alignment,
        },
    });

    return (
        <div {...blockProps} className="wp-block-create-block-call-to-action">
            <div className="cta-content">
                <RichText.Content
                    tagName="h2"
                    className="cta-heading"
                    value={heading}
                    style={{ color: textColor }}
                />

                <RichText.Content
                    tagName="p"
                    className="cta-description"
                    value={description}
                    style={{ color: textColor }}
                />

                {buttonUrl ? (
                    <a href={buttonUrl} className="cta-button">
                        <RichText.Content
                            tagName="span"
                            value={buttonText}
                        />
                    </a>
                ) : (
                    <span className="cta-button">
                        <RichText.Content
                            tagName="span"
                            value={buttonText}
                        />
                    </span>
                )}
            </div>
        </div>
    );
}
