import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl, Placeholder } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit({ attributes, setAttributes }) {
    const { postType, taxonomies, postsPerPage } = attributes;

    // Fetch all post types
    const postTypes = useSelect((select) => {
        const allPostTypes = select(coreStore).getPostTypes({ per_page: -1 });
        return allPostTypes?.filter((type) => type.viewable && type.slug !== 'attachment') || [];
    }, []);

    // Fetch taxonomies for the selected post type
    const availableTaxonomies = useSelect((select) => {
        if (!postType) return [];
        const postTypeObj = select(coreStore).getPostType(postType);
        if (!postTypeObj) return [];

        const allTaxonomies = select(coreStore).getTaxonomies({ per_page: -1 });
        return allTaxonomies?.filter((tax) => postTypeObj.taxonomies.includes(tax.slug)) || [];
    }, [postType]);

    // Fetch terms for available taxonomies
    const termsList = useSelect((select) => {
        if (!availableTaxonomies.length) return [];

        const results = [];
        availableTaxonomies.forEach(tax => {
            const terms = select(coreStore).getEntityRecords('taxonomy', tax.slug, { per_page: -1 });
            if (terms) {
                results.push({
                    taxonomy: tax,
                    terms: terms
                });
            }
        });
        return results;
    }, [availableTaxonomies]);

    const postTypeOptions = [
        { label: __('Select Post Type', 'my-custom-blocks'), value: '' },
        ...postTypes.map((type) => ({
            label: type.name,
            value: type.slug,
        }))
    ];

    const blockProps = useBlockProps();

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title={__('Query Settings', 'my-custom-blocks')}>
                    <SelectControl
                        label={__('Select Post Type', 'my-custom-blocks')}
                        value={postType}
                        options={postTypeOptions}
                        onChange={(newValue) => {
                            setAttributes({ postType: newValue, taxonomies: [] });
                        }}
                    />

                    {termsList.length > 0 && termsList.map(({ taxonomy, terms }) => (
                        <div key={taxonomy.slug} style={{ marginBottom: '20px' }}>
                            <p style={{ fontWeight: 600, marginBottom: '8px', borderBottom: '1px solid #eee' }}>{taxonomy.name}</p>
                            {terms.map(term => (
                                <label key={term.id} style={{ display: 'flex', alignItems: 'center', marginBottom: '8px', cursor: 'pointer' }}>
                                    <input
                                        type="checkbox"
                                        style={{ marginRight: '8px' }}
                                        checked={taxonomies.some(t => t.termId === term.id)}
                                        onChange={(e) => {
                                            let newTaxonomies = [...taxonomies];
                                            if (e.target.checked) {
                                                newTaxonomies.push({ taxonomy: taxonomy.slug, termId: term.id });
                                            } else {
                                                newTaxonomies = newTaxonomies.filter(t => t.termId !== term.id);
                                            }
                                            setAttributes({ taxonomies: newTaxonomies });
                                        }}
                                    />
                                    {term.name}
                                </label>
                            ))}
                        </div>
                    ))}

                    <RangeControl
                        label={__('Number of Items', 'my-custom-blocks')}
                        value={postsPerPage}
                        onChange={(newValue) => setAttributes({ postsPerPage: newValue })}
                        min={1}
                        max={20}
                    />
                </PanelBody>
            </InspectorControls>

            {postType ? (
                <ServerSideRender
                    block="my-custom-blocks/dynamic-posts"
                    attributes={attributes}
                />
            ) : (
                <Placeholder
                    icon="list-view"
                    label={__('Dynamic Post List', 'my-custom-blocks')}
                    instructions={__('Please select a post type in the sidebar to begin.', 'my-custom-blocks')}
                />
            )}
        </div>
    );
}

