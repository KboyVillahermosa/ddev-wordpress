import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';

export default function Inspector({ attributes, setAttributes }) {
    const { showStartingYear, startingYear } = attributes;

    return (
        <InspectorControls>
            <PanelBody title={__('Settings', 'copyright-date-block')}>
                <ToggleControl
                    checked={!!showStartingYear}
                    label={__('Show starting year', 'copyright-date-block')}
                    onChange={() =>
                        setAttributes({
                            showStartingYear: !showStartingYear,
                        })
                    }
                />
                {showStartingYear && (
                    <TextControl
                        __next40pxDefaultSize
                        label={__('Starting year', 'copyright-date-block')}
                        value={startingYear || ''}
                        onChange={(value) =>
                            setAttributes({ startingYear: value })
                        }
                    />
                )}
            </PanelBody>
        </InspectorControls>
    );
}
