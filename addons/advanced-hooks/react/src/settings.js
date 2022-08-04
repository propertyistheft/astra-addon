/**
 * Custom Layout Options.
*/
import { compose } from '@wordpress/compose';
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { select, withSelect, withDispatch } from '@wordpress/data';
import { SelectControl, ToggleControl, PanelBody, Tooltip, Modal, Button, TextControl, __experimentalText as Text, DateTimePicker, Popover, Notice } from '@wordpress/components';
import svgIcons from '../../../../assets/svg/svgs.json';
import SelectorComponent from './ast-select/control'
import AstNumberControl  from './ast-number';
import parse from 'html-react-parser';
import AstDisplayRules from './ast-display-rules';
import AstUserRoles from './ast-user-roles';
import { useState, useEffect } from 'react';
import { __ } from '@wordpress/i18n'
import AstDivider from './ast-divider';
import AstDateTimeField from './ast-date-time-field';
import AstFormatDateLabel from './ast-date-time-format';
import AstUTC from './ast-utc';

const customLayout = props => {

    const icon =  parse( svgIcons['custom-layouts-settings'] );
    const [ modalVisible, setModalVisible ] = useState( true );
    const [ hasBlocks, setHasBlocks ] = useState( false );
    const [ actionHook, setActionHook ] = useState( props.meta['ast-advanced-hook-action'] );
    const [ isOpen, setOpen ] = useState( false );
    const settingsIcon = parse( svgIcons['custom-layouts-edit'] );
    const actionHookDescArr = [];
    const [ isDurationPopupOpen, setDurationPopupOpen ] = useState( false );

    const layoutOptions = Object.entries( astCustomLayout.layouts ).map( ( [ key, name ] ) => {
		return ( { label: name, value: key } );
	} );

    const deviceOptions = Object.entries( astCustomLayout.DeviceOptions ).map( ( [ key, name ] ) => {
		return ( { label: name, value: key } );
	} );

    const contentBlockType = Object.entries( astCustomLayout.ContentBlockType ).map( ( [ key, name ] ) => {
		return ( { label: name, value: key } );
	} );

    const actionHooks = Object.entries( astCustomLayout.actionHooks ).map( ( [ key, values ] ) => {
       let hooks = values.hooks;
		return (
            <optgroup label={ values.title } key={key}>
                {   Object.entries( hooks ).map( ( [ key, options ] ) => {
                    actionHookDescArr[key] = options.description;
                  return( <option value={key} key={key} data-desc={ options.description }> { options.title } </option>)
                })}
            </optgroup>
         );
	} );

	// TimeDate to Timestamp conversion.
	const toTimestamp = (newDate) => {
		return Date.parse(newDate)/1000;
	}
	// StartDate Popover
	const [ startDatePopoverIsVisible, setStartDatePopoverSetIsVisible ] = useState( false );
	// EndDate Popover
	const [ EndDatePopoverIsVisible, setEndDatePopoverSetIsVisible ] = useState( false );
    // DateTimePicker invalid selection Notices.
    const [ dateTimeNotice, setDateTimeNotice ] = useState( false );
    // DateTimePicker Dynamic Labels.
	const startDateLabel = AstFormatDateLabel(
		props.meta['ast-advanced-time-duration']['start-dt'],
		__( 'Click To Select Date', 'astra-addon' )
	);
	const endDateLabel = AstFormatDateLabel(
		props.meta['ast-advanced-time-duration']['end-dt'],
		__( 'Click To Select Date', 'astra-addon' )
	);

    // Initialize header object if it is empty array.
    if( null === props.meta['ast-advanced-hook-header'] || 0 === Object.keys( props.meta['ast-advanced-hook-header'] ).length ) {
        props.meta['ast-advanced-hook-header'] = {};
    }
    // Initialize footer object if it is empty array.
    if( null === props.meta['ast-advanced-hook-footer'] || 0 === Object.keys( props.meta['ast-advanced-hook-footer'] ).length ) {
        props.meta['ast-advanced-hook-footer'] = {};
    }
    // Initialize 404-page object if it is empty array.
    if(  null == props.meta['ast-404-page'] || 0 === Object.keys( props.meta['ast-404-page'] ).length ) {
        props.meta['ast-404-page'] = {};
    }
    // Initialize page/post content object if it is empty array.
    if( null === props.meta['ast-advanced-hook-content'] || 0 === Object.keys( props.meta['ast-advanced-hook-content'] ).length ) {
        props.meta['ast-advanced-hook-content'] = {};
    }
    if( null == props.meta['ast-advanced-hook-padding'] || Object.keys( props.meta['ast-advanced-hook-padding'] ).length === 0 ) {
        props.meta['ast-advanced-hook-padding'] = {};
    }
    if( 0 === props.meta['ast-advanced-hook-location'].length ) {
        props.meta['ast-advanced-hook-location'] = { 'rule':[], 'specific': [] }
    }
    if( 0 === props.meta['ast-advanced-hook-exclusion'].length ) {
        props.meta['ast-advanced-hook-exclusion'] = { 'rule':[], 'specific': [] }
    }

    if( undefined === props.meta['ast-advanced-hook-location'].specificText ){
        props.meta['ast-advanced-hook-location'].specificText = astCustomLayout.specificRule
    }

    if( undefined === props.meta['ast-advanced-hook-exclusion'].specificText ){
        props.meta['ast-advanced-hook-exclusion'].specificText = astCustomLayout.specificExclusionRule
    }

    const clHookTypes = {
		'header': {
			'name': __( 'Header', 'astra-addon' ),
			'icon': parse( svgIcons['cl-header-layout'] ),
			'showSticky': true,
		},
		'footer': {
			'name': __( 'Footer', 'astra-addon' ),
			'icon': parse( svgIcons['cl-footer-layout'] ),
			'showSticky': true,
		},
		'404-page': {
			'name': __( '404 Page', 'astra-addon' ),
			'icon': parse( svgIcons['cl-404-page-layout'] ),
		},
		'hooks': {
			'name': __( 'Hooks', 'astra-addon' ),
			'icon': parse( svgIcons['cl-hooks-layout'] ),
		},
		'content': {
			'name': __( 'Inside Post/Page Content', 'astra-addon' ),
			'icon': parse( svgIcons['cl-inside-post-layout'] ),
		},
	}

	const update404rule = ( value ) => {
		if( value === '404-page' && ! props.meta['ast-advanced-hook-location'].rule.includes( 'special-404' ) ) {
			props.meta['ast-advanced-hook-location'].rule.push( 'special-404' );
			props.setMetaFieldValue( props.meta['ast-advanced-hook-location'], 'ast-advanced-hook-location' );
		} else if( props.meta['ast-advanced-hook-location'].rule.includes( 'special-404' ) ) {
			let index = props.meta['ast-advanced-hook-location'].rule.indexOf( 'special-404' );
			props.meta['ast-advanced-hook-location'].rule.splice( index, 1 );
			props.setMetaFieldValue( props.meta['ast-advanced-hook-location'], 'ast-advanced-hook-location' );
		}
	}

	const changeTemplate = ( templateArr ) => {
        if( 'header' === templateArr[0] || 'footer' === templateArr[0] ) {
            let stickyKey = 'ast-advanced-hook-header';
            props.setMetaFieldValue( { ...props.meta[stickyKey], 'sticky': ( true === templateArr[1] ? 'enabled' : '' ) }, stickyKey );
        }

		update404rule( templateArr[0] );

		props.setMetaFieldValue( templateArr[0], 'ast-advanced-hook-layout' );
	}

	useEffect(() => {
		const getPost = select( 'core/editor' ).getCurrentPost();
		setHasBlocks( getPost.content ? true : false );
	});

    const onHookChange = ( e ) => {
        let value = e.target.value;
        setActionHook( value );
        props.setMetaFieldValue( value, 'ast-advanced-hook-action' )
    }

    const openModal = () => setOpen( true );
    const closeModal = () => setOpen( false );

	const openTimeDurationModal = () => setDurationPopupOpen( true );
	const closeTimeDurationModal = () => setDurationPopupOpen( false );

    // Set responsive device option values.
    const updateResponsiveDevice = ( value, device ) => {

        if( true === value ) {
            props.setMetaFieldValue( [...props.meta['ast-advanced-display-device'], device] , 'ast-advanced-display-device' );
        }else {
            let updated = props.meta['ast-advanced-display-device'];
            updated = updated.filter(function(item) {
                return item !== device
            })

            props.setMetaFieldValue( updated , 'ast-advanced-display-device' );
        }
    }

    return (
		<>
            { '' === props.meta['ast-advanced-hook-layout'] && ! hasBlocks && modalVisible && (
				<Modal
					className="ast-hooks-modal"
					title={ __( 'Choose Custom Layout Type', 'astra-addon' ) }
                    shouldCloseOnClickOutside = { false }
					onRequestClose={ () => setModalVisible(false) }>
					<Text> { __( 'Please select the type of your Custom Layout, you can later modify this.', 'astra-addon' ) }</Text>
					<SelectorComponent
						options={ clHookTypes }
						default={ '' }
						onChange={ arr => {
							changeTemplate( arr );
						} }
					/>
					<div className='ast-create-custom-hook-btn'>
						<Button
							key={'create-custom-hook-btn'}
							onClick={ () => setModalVisible(false) }
							isPrimary={ true }
						>{__('Create Custom Layout', 'astra-addon') }</Button>
					</div>
				</Modal>
			) }

			{/* Meta settings icon */}
			<PluginSidebarMoreMenuItem
				target="ast-custom-layout-panel"
				icon={ icon }
			>
			    { astCustomLayout.title }
			</PluginSidebarMoreMenuItem>

            <PluginSidebar
					isPinnable={ true }
					icon={ icon }
					name="ast-custom-layout-panel"
					title={ astCustomLayout.title }
			>
                <div className="ast-custom-layout-sidebar components-panel__body is-opened">

                    {/* Layout Dropdown */}
                    <div className="ast-custom-layout-meta-wrap components-base-control__field">
						<p className="ast-custom-layout-control-title post-attributes-label-wrapper">
							<strong className="customize-control-title">{ __('Layout', 'astra-addon') }</strong>
                            <Tooltip position="bottom left" text={ __( 'This option will be applicable only for the posts/pages created with the block editor.', 'astra-addon' )}>
                                <i className ="ast-advanced-hook-heading-help dashicons dashicons-editor-help"></i>
                            </Tooltip>
						</p>

						<SelectControl
							value={ ( undefined !== props.meta['ast-advanced-hook-layout'] && ''!== props.meta['ast-advanced-hook-layout'] ? props.meta['ast-advanced-hook-layout'] : '0' ) }
							options={ layoutOptions }
							onChange={ ( value ) => {
								update404rule( value );
								props.setMetaFieldValue( value, 'ast-advanced-hook-layout' );
							} }
						/>

                        {/* Action Hooks Settings */}
                        { 'hooks' === props.meta['ast-advanced-hook-layout'] &&
                        <>
                            <AstDivider/>
                            <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                <strong className="customize-control-title">{ __('Action', 'astra-addon') }</strong>
                            </p>
                            <select
                                className = 'components-select-control__input'
                                value={ actionHook }
                                onChange={ ( e ) => { onHookChange( e ) } }
                            >
                                <option value=""> {__('— Select —', 'astra-addon') }</option>
                                {actionHooks}
                            </select>

                            <p className = "description ast-advanced-hook-action-desc" >
                                { ( undefined !== actionHookDescArr[ props.meta['ast-advanced-hook-action'] ] ) ? actionHookDescArr[ props.meta['ast-advanced-hook-action'] ] : '' }
                            </p>

                            <AstDivider/>
                            <div className="ast-cl-priority">
                                <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                    <strong className="customize-control-title">{ __('Priority', 'astra-addon') }</strong>
                                </p>
                                <AstNumberControl
                                    value = { ( undefined !== props.meta['ast-advanced-hook-priority'] ? props.meta['ast-advanced-hook-priority'] : '' ) }
                                    onChange ={ ( value ) => {
                                        props.setMetaFieldValue( value, 'ast-advanced-hook-priority' )
                                    }}
				    placeholder="Default: 10"
                                />
                            </div>

                            <AstDivider/>
                            <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                <strong className="customize-control-title">{ __('Spacing', 'astra-addon') }</strong>
                                <Tooltip text={ __( 'Spacing can be given any positive number with or without units as "5" or "5px". Default unit is "px"', 'astra-addon' )} position="bottom left">
                                    <i className ="ast-advanced-hook-heading-help dashicons dashicons-editor-help"></i>
                                </Tooltip>
                            </p>
                            <div className="ast-spacing-settings">
                                <TextControl
                                    label = { __( 'Top', 'astra-addon' ) }
                                    value =  { ( undefined !== props.meta['ast-advanced-hook-padding'].top ? props.meta['ast-advanced-hook-padding'].top : 0 ) }
                                    onChange ={ ( value ) => {
                                        props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-padding'], 'top': value } , 'ast-advanced-hook-padding' )
                                    }}
                                />
                                <TextControl
                                    label = { __( 'Bottom', 'astra-addon' ) }
                                    value = { ( undefined !== props.meta['ast-advanced-hook-padding'].bottom && '' !== props.meta['ast-advanced-hook-padding'].bottom )? props.meta['ast-advanced-hook-padding'].bottom : 0 }
                                    onChange = { ( value ) => {
                                        props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-padding'], 'bottom': value }, 'ast-advanced-hook-padding' )
                                    }}
                                />
                            </div>
                        </>}
		    </div>
                </div>

                {/* Header Sticky Settings */}
                { 'header' === props.meta['ast-advanced-hook-layout'] &&
                    <PanelBody
                        title={ __( 'Sticky Settings', 'astra-addon' ) }
                        initialOpen={ false }
                        >
                        {/* Header Stick */}
                        <div className="ast-custom-layout-meta-wrap components-base-control__field ast-sticky-control">

                            <ToggleControl
                                label={ __( 'Stick', 'astra-addon') }
                                checked={  ( undefined === props.meta['ast-advanced-hook-header'].sticky || 'enabled' !== props.meta['ast-advanced-hook-header'].sticky ) ? false : true  }
                                onChange={ ( value )=>{
                                    value = ( true === value ) ? 'enabled' : '';
                                    props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-header'], 'sticky': value }, 'ast-advanced-hook-header' )
                                } }
                            />
                        </div>

                        { 'header' === props.meta['ast-advanced-hook-layout'] && 'enabled' === props.meta['ast-advanced-hook-header'].sticky &&
                            <>
                            <div className="ast-custom-layout-meta-wrap components-base-control__field ast-sticky-control">
                                <ToggleControl
                                    label={ __( 'Shrink', 'astra-addon') }
                                    checked={  ( undefined === props.meta['ast-advanced-hook-header'].shrink || 'enabled' !== props.meta['ast-advanced-hook-header'].shrink ) ? false : true }
                                    onChange={ ( value )=>{
                                        value = ( true === value ) ? 'enabled' : '';
                                        props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-header'], 'shrink': value }, 'ast-advanced-hook-header' )
                                    } }
                                />
                            </div>
                            <div className="ast-custom-layout-meta-wrap components-base-control__field">
                                <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                    <strong className="customize-control-title">{ __('Stick On', 'astra-addon') }</strong>
                                </p>

                                <SelectControl
                                    value={ ( undefined !== props.meta['ast-advanced-hook-header']['sticky-header-on-devices'] && ''!== props.meta['ast-advanced-hook-header']['sticky-header-on-devices'] ? props.meta['ast-advanced-hook-header']['sticky-header-on-devices'] : 'desktop' ) }
                                    options={ deviceOptions }
                                    onChange={ ( value ) => {
                                        props.setMetaFieldValue(  { ...props.meta['ast-advanced-hook-header'], 'sticky-header-on-devices': value }, 'ast-advanced-hook-header' )
                                    } }
                                />
                            </div>
                            </>
                        }
                    </PanelBody>
                }

                {/* Footer layout settings */}
                { 'footer' === props.meta['ast-advanced-hook-layout'] &&
                    <PanelBody
                        title={ __( 'Sticky Settings', 'astra-addon' ) }
                        initialOpen={ false }
                        >
                        {/* Footer Stick */}
                        <div className="ast-custom-layout-meta-wrap components-base-control__field ast-sticky-control">
                            <ToggleControl
                                label={ __( 'Stick', 'astra-addon') }
                                checked={  ( undefined === props.meta['ast-advanced-hook-footer'].sticky || 'enabled' !== props.meta['ast-advanced-hook-footer'].sticky ) ? false : true  }
                                onChange={ ( value )=>{
                                    value = ( true === value ) ? 'enabled' : '';
                                    props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-footer'], 'sticky': value } , 'ast-advanced-hook-footer' )
                                }}
                            />
                        </div>

                        { 'footer' === props.meta['ast-advanced-hook-layout'] && 'enabled' === props.meta['ast-advanced-hook-footer'].sticky &&
                            <div className="ast-custom-layout-meta-wrap components-base-control__field">
                                <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                    <strong className="customize-control-title">{ __('Stick On', 'astra-addon') }</strong>
                                </p>

                                <SelectControl
                                    value={ ( undefined !== props.meta['ast-advanced-hook-footer']['sticky-footer-on-devices'] && ''!== props.meta['ast-advanced-hook-footer']['sticky-footer-on-devices'] ? props.meta['ast-advanced-hook-footer']['sticky-footer-on-devices'] : 'desktop' ) }
                                    options={ deviceOptions }
                                    onChange={ ( value ) => {
                                        props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-footer'], 'sticky-footer-on-devices': value } , 'ast-advanced-hook-footer' )
                                    } }
                                />
                            </div>
                        }
                    </PanelBody>
                }

                {/* 404 Page settings */}
                { '404-page' === props.meta['ast-advanced-hook-layout'] &&
                    <PanelBody
                        title={ __( '404 Page Display Settings', 'astra-addon' ) }
                        initialOpen={ false }
                        >
                        {/* Footer Stick */}
                        <div className="ast-custom-layout-meta-wrap components-base-control__field ast-404-control">
                            <ToggleControl
                                label={ __( 'Disable Primary Header', 'astra-addon') }
                                checked={  ( undefined === props.meta['ast-404-page'].disable_header || 'enabled' !== props.meta['ast-404-page'].disable_header ) ? false : true  }
                                onChange={ ( value )=>{
                                    value = ( true === value ) ? 'enabled' : '';
                                    props.setMetaFieldValue( { ...props.meta['ast-404-page'], 'disable_header': value }, 'ast-404-page' )
                                } }
                            />
                            <ToggleControl
                                label={ __( 'Disable Footer Bar', 'astra-addon') }
                                checked={  ( undefined === props.meta['ast-404-page'].disable_footer || 'enabled' !== props.meta['ast-404-page'].disable_footer ) ? false : true  }
                                onChange={ ( value )=>{
                                    value = ( true === value ) ? 'enabled' : '';
                                    props.setMetaFieldValue( { ...props.meta['ast-404-page'], 'disable_footer': value }, 'ast-404-page' )
                                } }
                            />
                        </div>
                    </PanelBody>
                }

                {/* Inside Post/Page Content settings */}
                { 'content' === props.meta['ast-advanced-hook-layout'] &&
                    <PanelBody
                        title={ __( 'Location Settings', 'astra-addon' ) }
                        initialOpen={ false }
                        >
                        {/* Footer Stick */}
                        <div className="ast-custom-layout-meta-wrap components-base-control__field ast-404-control">
                            <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                <strong className="customize-control-title">{ __('Location on post/page', 'astra-addon') }</strong>
                                <Tooltip text={ __( 'Layout will be inserted at a selected location on page/post in the block editor.', 'astra-addon' )} position="bottom left">
                                    <i className ="ast-advanced-hook-heading-help dashicons dashicons-editor-help"></i>
                                </Tooltip>
                            </p>

                            <SelectControl
                                value={ ( undefined !== props.meta['ast-advanced-hook-content'].location && ''!== props.meta['ast-advanced-hook-content']['location'] ? props.meta['ast-advanced-hook-content'].location : 'after_blocks' ) }
                                options={ contentBlockType }
                                onChange={ ( value ) => {
                                    props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-content'], 'location': value }, 'ast-advanced-hook-content' )
                                } }
                            />

                            { ( 'after_blocks' === props.meta['ast-advanced-hook-content'].location || undefined === props.meta['ast-advanced-hook-content'].location ) &&
                            <>
                                <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                    <strong className="customize-control-title">{ __('Add layout after block(s)', 'astra-addon') }</strong>
                                </p>
                                <AstNumberControl
                                    value = { ( undefined !== props.meta['ast-advanced-hook-content'].after_block_number ? props.meta['ast-advanced-hook-content'].after_block_number : '' ) }
                                    onChange ={ ( value ) => {
                                        props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-content'], 'after_block_number': value }, 'ast-advanced-hook-content' )
                                    }}
                                />
                                </>
                            }
                            { 'before_headings' === props.meta['ast-advanced-hook-content'].location &&
                                <>
                                <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                                    <strong className="customize-control-title">{ __('Add content before Heading Block(s)', 'astra-addon') }</strong>
                                </p>
                                <AstNumberControl
                                    value = { ( undefined !== props.meta['ast-advanced-hook-content'].before_heading_number ? props.meta['ast-advanced-hook-content'].before_heading_number : '' ) }
                                    onChange ={ ( value ) => {
                                        props.setMetaFieldValue( { ...props.meta['ast-advanced-hook-content'], 'before_heading_number': value }, 'ast-advanced-hook-content' )
                                    }}
                                />
                                </>
                            }
                        </div>
                    </PanelBody>
                }

                <div className="ast-custom-layout-panel components-panel__body">
                    <h2 className="components-panel__body-title">
                        <button className="components-button components-panel__body-toggle" onClick = { openModal }>
                            <span className="ast-title-container">
                                <div className="ast-title"> { __( 'Display and User Role Settings', 'astra-addon' ) }</div>
                            </span>
                            {settingsIcon}
                        </button>
                    </h2>
                </div>

                { isOpen &&
                ( <Modal title={ __( 'Display And User Role Settings', 'astra-addon' ) } className = "ast-layout-settings-modal" shouldCloseOnClickOutside = { false } onRequestClose={ closeModal }>
                    <div className="ast-cl-settings-content">
                        <table className="ast-advanced-hook-table widefat">
                            <tbody>
                            { '404-page' !== props.meta['ast-advanced-hook-layout'] && <>
                                <tr className="ast-advanced-hook-row ast-target-rules-display">
                                <td className="ast-advanced-hook-row-heading">
                                    <label> {__( 'Display On', 'astra-addon' ) }</label>
                                </td>

                                <td className="ast-advanced-hook-row-content">
                                    <AstDisplayRules
                                        displayRules = { astCustomLayout.displayRules }
                                        value = { props.meta['ast-advanced-hook-location'] }
                                        specific = { props.meta['ast-advanced-hook-location'].specificText }
                                        isDisplayRule = { true }
                                        onChange = { ( value ) => {
                                            if( -1 === value.rule.indexOf('clflag') ) {
                                                value.rule.push('clflag');
                                            }else if( 0 < value.rule.indexOf('clflag') ){
                                                let index =  value.rule.indexOf('clflag')
                                                value.rule.splice(index, 1);
                                            }

                                            props.meta['ast-advanced-hook-location'] = { 'rule': value.rule, 'specific': value.specific, 'specificText': value.specificText } ;

                                            props.setMetaFieldValue( props.meta['ast-advanced-hook-location'], 'ast-advanced-hook-location' )
                                        } }
                                    />
                                </td></tr>

                                <tr className="ast-advanced-hook-row ast-target-rules-display">
                                <td className="ast-advanced-hook-row-heading">
                                    <label> {__( 'Do Not Display On', 'astra-addon' ) }</label>
                                </td>
                                <td className="ast-advanced-hook-row-content">
                                    <AstDisplayRules
                                        displayRules = { astCustomLayout.displayRules }
                                        value = { props.meta['ast-advanced-hook-exclusion'] }
                                        specific = {  props.meta['ast-advanced-hook-exclusion'].specificText }
                                        onChange = { ( roles ) => {

                                            if( -1 === roles.rule.indexOf('clflag') ) {
                                                roles.rule.push('clflag');
                                            }else if( 0 < roles.rule.indexOf('clflag') ){
                                                let index =  roles.rule.indexOf('clflag')
                                                roles.rule.splice(index, 1);
                                            }

                                            props.meta['ast-advanced-hook-exclusion'] = { 'rule': roles.rule, 'specific': roles.specific, 'specificText': roles.specificText } ;
                                            props.setMetaFieldValue(  props.meta['ast-advanced-hook-exclusion'], 'ast-advanced-hook-exclusion' )
                                        } }
                                    />
                                </td></tr></>}

                                <tr className="ast-advanced-hook-row ast-target-rules-display">
                                <td className="ast-advanced-hook-row-heading">
                                    <label> {__( 'User Roles', 'astra-addon' ) }</label>
                                </td>
                                <td className="ast-advanced-hook-row-content">
                                    <AstUserRoles
                                        value = { ( undefined !== props.meta['ast-advanced-hook-users'] && ''!== props.meta['ast-advanced-hook-users'] ? props.meta['ast-advanced-hook-users'] : [] ) }
                                        onChange = { ( value ) => {
                                            // Values are not updated for changing existing drodpwn values so we need handle this way.
                                            if( value.length === props.meta['ast-advanced-hook-users'].length ) {
                                                props.setMetaFieldValue( value, 'ast-advanced-hook-users' );
                                            }else {
                                                props.setMetaFieldValue( [...value], 'ast-advanced-hook-users' );
                                            }
                                        } }
                                    />
                                </td></tr>

                            </tbody>
                        </table>
                    </div>
                    <div className="ast-cl-footer-container"><hr/>
                        <div className="ast-button-container">
                        <span className="ast-cl-popup-notice">{ __( 'Make sure to save your post for changes to take effect', 'astra-addon' ) } </span> <button className="button button-default" onClick= { closeModal }> { __( 'Return To Post', 'astra-addon' ) }</button>
                        </div>
                    </div>
                </Modal> ) }

                {/* Responsive Visibility Toggle */}
                <PanelBody
                    title={ __( 'Responsive Visibility', 'astra-addon' ) }
                    initialOpen={ false }
                >
                    <div className ="ast-custom-layout-meta-wrap components-base-control__field">
                        <p className="ast-custom-layout-control-title post-attributes-label-wrapper">
                            { __('Select Device for where this Custom Layout should appear', 'astra-addon') }
                        </p>

                        <ToggleControl
                            label="Desktop"
                            checked={ ( props.meta['ast-advanced-display-device'].includes('desktop') ) ? true : false }
                            onChange={ (value)=>{
                                updateResponsiveDevice( value, 'desktop' );
                            } }
                        />
                        <ToggleControl
                            label="Tablet"
                            checked={  ( props.meta['ast-advanced-display-device'].includes('tablet') ) ? true : false }
                            onChange={ (value)=>{
                                updateResponsiveDevice( value, 'tablet' );
                            } }
                        />
                        <ToggleControl
                            label="Mobile"
                            checked={  ( props.meta['ast-advanced-display-device'].includes('mobile') ) ? true : false }
                            onChange={ (value)=>{
                                updateResponsiveDevice( value, 'mobile' );
                            } }
                        />
                    </div>
                </PanelBody>

			{ /* Time Duration */ }
			<div className="ast-custom-layout-panel components-panel__body">
				<h2 className="components-panel__body-title">
					<button className="components-button components-panel__body-toggle" onClick = { openTimeDurationModal }>
						<span className="ast-title-container">
							<div className="ast-title"> { __( 'Time Duration Settings', 'astra-addon' ) }</div>
						</span>
						{settingsIcon}
					</button>
				</h2>
			</div>

			{ isDurationPopupOpen &&
			( <Modal title={ __( 'Time Duration', 'astra-addon' ) } className = "ast-layout-settings-modal" shouldCloseOnClickOutside = { false } onRequestClose={ closeTimeDurationModal }>
				<div className="ast-cl-settings-content">
					<table className="ast-advanced-hook-table widefat">
						<tbody>
							<tr>
								<td className="ast-advanced-hook-row-heading">
									<label> { __( 'Enable', 'astra-addon' ) }</label>
								</td>
								<td className="ast-advanced-hook-row-content">
									<ToggleControl
										checked={undefined === props.meta['ast-advanced-time-duration'].enabled ||
											'enabled' !== props.meta['ast-advanced-time-duration'].enabled ? false : true}
										onChange={(value) => {
											value = true === value ? 'enabled' : '';
											props.setMetaFieldValue({ ...props.meta['ast-advanced-time-duration'], enabled: value }, 'ast-advanced-time-duration');
										}}
									/>
								</td>
							</tr>

							{ 'enabled' === props.meta['ast-advanced-time-duration'].enabled &&
								<>
									<tr className="ast-advanced-hook-row">
										<td className="ast-advanced-hook-row-heading">
											<label> {__( 'Start Date/Time:', 'astra-addon' ) }</label>
										</td>
										<td className="ast-advanced-hook-row-content">
											<AstDateTimeField
												label={startDateLabel}
												onOpenPopover={setStartDatePopoverSetIsVisible}
											/>
											{startDatePopoverIsVisible && (
												<Popover
													position="top left"
													className="ast-popover"
													onClose={setStartDatePopoverSetIsVisible}
												>
													<section className="ast-popover-body">
														<div className="ast-datepicker-wrapper">
															<DateTimePicker
																currentDate={
																	props.meta['ast-advanced-time-duration']['start-dt']
																}
																onChange={(newDate) => {
																	props.setMetaFieldValue(
																		{
																			...props.meta['ast-advanced-time-duration'],
																			'start-dt': newDate,
																		},
																		'ast-advanced-time-duration'
																	);
																}}
																is12Hour={true}
															/>
														</div>
													</section>
												</Popover>
											)}
										</td>
									</tr>
									<tr className="ast-advanced-hook-row">
										<td className="ast-advanced-hook-row-heading">
											<label> {__( 'End Date/Time:', 'astra-addon' ) }</label>
										</td>
										<td className="ast-advanced-hook-row-content">
											<AstDateTimeField
												label={endDateLabel}
												onOpenPopover={setEndDatePopoverSetIsVisible}
											/>
											{EndDatePopoverIsVisible && (
												<Popover
													position="top left"
													className="ast-popover"
													onClose={setEndDatePopoverSetIsVisible}
												>
													<section className="ast-popover-body">
														<div className="ast-datepicker-wrapper">
															<DateTimePicker
																className="ast-datepicker"
																currentDate={props.meta['ast-advanced-time-duration']['end-dt']}
																onChange={(newDate) => {
																	const startDateStamp = toTimestamp(
																		props.meta['ast-advanced-time-duration']['start-dt']
																	);
																	const endDateStamp = toTimestamp(newDate);
																	// save only if end date is greater than start date.
																	if (endDateStamp > startDateStamp) {
																		setDateTimeNotice(false);
																		props.setMetaFieldValue(
																			{
																				...props.meta['ast-advanced-time-duration'],
																				'end-dt': newDate,
																			},
																			'ast-advanced-time-duration'
																		);
																	} else {
																		setDateTimeNotice(true);
																	}
																}}
																is12Hour={true}
															/>
														</div>
													</section>
												</Popover>
											)}
											{dateTimeNotice && (
												<Notice
													className="ast-date-time-notice"
													status="warning"
													isDismissible={false}
												>
													{__(
														'The selected end date occurs before your start date. Choose the end date and time which is later than the start date and time.',
														'astra-addon'
													)}
												</Notice>
											)}
										</td>
									</tr>
									<tr className="ast-advanced-hook-row">
										<td className="ast-advanced-hook-row-heading">
											<label> {__( 'Timezone:', 'astra-addon' ) }</label>
										</td>
										<td className="ast-advanced-hook-row-content">
											<AstUTC />
										</td>
									</tr>
								</>
							}
						</tbody>
					</table>
				</div>
				<div className="ast-cl-footer-container"><hr/>
					<div className="ast-button-container">
					<span className="ast-cl-popup-notice">{ __( 'Make sure to save your post for changes to take effect', 'astra-addon' ) } </span> <button className="button button-default" onClick= { closeTimeDurationModal }> { __( 'Return To Post', 'astra-addon' ) } </button>
					</div>
				</div>
			</Modal> ) }
            </PluginSidebar>
        </>
    )
}

export default compose(
    withSelect( ( select ) => {
        const postMeta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
        const oldPostMeta = select( 'core/editor' ).getCurrentPostAttribute( 'meta' );
        return {
            meta: { ...oldPostMeta, ...postMeta },
            oldMeta: oldPostMeta,
        };
    } ),
    withDispatch( ( dispatch ) => ( {
        setMetaFieldValue: ( value, field ) => dispatch( 'core/editor' ).editPost(
            { meta: { [ field ]: value } }
        ),
    } ) ),
)( customLayout );
