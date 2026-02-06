import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import { useEffect } from 'react';

export default function Edit({ attributes, setAttributes }) {
    const { fallbackCurrentYear, showStartingYear, startingYear } = attributes;

    // Get the current year and make sure it's a string.
    const currentYear = new Date().getFullYear().toString();

    // When the block loads, set the fallbackCurrentYear attribute to the
    // current year if it's not already set.
    useEffect(() => {
        if (currentYear !== fallbackCurrentYear) {
            setAttributes({ fallbackCurrentYear: currentYear });
        }
    }, [currentYear, fallbackCurrentYear, setAttributes]);

    let displayDate;

    if (showStartingYear && startingYear) {
        displayDate = startingYear + '–' + currentYear;
    } else {
        displayDate = currentYear;
    }

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Settings', 'copyright-date-block')}>
                    <ToggleControl
                        checked={!!showStartingYear}
                        label={__(
                            'Show starting year',
                            'copyright-date-block'
                        )}
                        onChange={() =>
                            setAttributes({
                                showStartingYear: !showStartingYear,
                            })
                        }
                    />
                    {showStartingYear && (
                        <TextControl
                            __next40pxDefaultSize
                            label={__(
                                'Starting year',
                                'copyright-date-block'
                            )}
                            value={startingYear || ''}
                            onChange={(value) =>
                                setAttributes({ startingYear: value })
                            }
                        />
                    )}
                </PanelBody>
            </InspectorControls>
            <p {...useBlockProps()}>© {displayDate}</p>
        </>
    );
}
