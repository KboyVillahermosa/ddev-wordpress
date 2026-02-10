import { useBlockProps } from '@wordpress/block-editor';
import { useEffect } from 'react';
import Inspector from '../components/copyright-date/Inspector';

export default function Edit({ attributes, setAttributes }) {
    const { fallbackCurrentYear, showStartingYear, startingYear } = attributes;

    const currentYear = new Date().getFullYear().toString();

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
            <Inspector attributes={attributes} setAttributes={setAttributes} />
            <p {...useBlockProps()}>© {displayDate}</p>
        </>
    );
}
