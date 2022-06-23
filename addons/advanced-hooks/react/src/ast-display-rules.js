import times from 'lodash/times';
import Select from 'react-select';
import { useState } from "react";
const { __ } = wp.i18n;

const AstDisplayRules = ( props ) => {

    // Saved Specific post/page rules.
    const [specific, setSpecific] = useState( props.specific );
    // To manage the specific post/page search values.
    const [searchOptions, setSearchOptions] = useState([]);
    // Edited and Saved rules and this is use to save in DB.
    const [editRules, setEditeRules] = useState( { 'rule': props.value.rule, 'specific' : props.value.specific } );

    editRules.rule.length = ( 0 === editRules.rule.length ) ? 1 : editRules.rule.length;
    const buttonLabel = ( undefined !== props.isDisplayRule ) ? __( 'Add Display Rule' , 'astra-addon') : __( 'Add Exclusion Rule', 'astra-addon' );

    // Prepare display group rules.
    const displayRules = Object.entries( props.displayRules ).map( ( [ key, values ] ) => {
        let options = values.value;
		return (
            <optgroup label={ values.label } key={key}>
                { Object.entries( options ).map( ( [ key, option ] ) => {
                  return( <option value={key} key={key} > { option } </option>)
                })}
            </optgroup>
        );
	} );

    // Add blank rule on click of add rule button and this is temp data to manage the add more rules.
    const addNewRule = ( ) => {
        const newRule = editRules.rule.concat('');
        setEditeRules( { ...editRules, 'rule': newRule });
    }

    // On Specific Post/Page search field.
    const onSpcificSelect = ( value ) => {
		let polylangBody = '';
		if ('1' === astCustomLayout.checkPolylangActive) {
			let postID   = document.querySelector('.metabox-base-form #post_ID').value;
			polylangBody = '&pll_ajax_backend=1&pll_post_id=' + postID;
		}

		const requestMetadata = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: 'action=astra_get_posts_by_query&q=' + value + '&nonce=' + astCustomLayout.ajax_nonce + polylangBody
        };

        const tempSearchOptions = [];
        if( '' !== value && 1 < value.length ) {
            fetch( ajaxurl, requestMetadata ).then( res => res.json() ).then(
            ( result ) => {

                Object.entries( result ).map( ( [ key, values ] ) => {
                    const childOptions = [];
                    Object.entries( values.children ).map( ( [ k, v ] ) => {
                        childOptions.push( {'value': v.id, 'label': v.text} );
                    });

                    let temp = {
                        'label': values.text,
                        'options': childOptions
                    }

                    tempSearchOptions.push( temp );
                });
                setSearchOptions( tempSearchOptions );
            });
        } else {
            setSearchOptions( tempSearchOptions );
        }
    }

    const removeRule = ( index ) => {
        // Remove index from rules.
        const updatedRules = editRules.rule.filter( ( key, i ) => {
            return ( i !== index );
        });
        editRules.rule = updatedRules;
        prepareToSave(index);
    }

    const onSelectRule = ( e, index ) => {
        let selected = e.target.value;
        editRules.rule[index] = selected;
        prepareToSave(index)
    }

    const prepareToSave = ( index, isSpecific = false ) => {
        if ( 'specifics' === editRules.rule[index] && false === isSpecific ) {
            editRules.specific = [];
            setSpecific( [] );
        }

        let filtered = editRules.rule.filter( (el) => {
            return el != '';
        });

        let specifics = editRules.specific.map( val => val.value);

        let saveValues = {
            'rule': filtered,
            'specific' : specifics,
            'specificText' : editRules.specific
        }
        setEditeRules( { ...editRules });
        // Prepare to save in DB.
        props.onChange( saveValues );
    }

    const onSpecificChange = ( values, index ) => {
        setSpecific( values );
        editRules.specific = values;
        setEditeRules({...editRules });
        prepareToSave( index, true );
    }

    const disabledClass = ( editRules.rule.length == 1 ) ? 'ast-disabled-close ' : '';
    const renderRule = ( index ) => {
        return(
            <div className= "ast-display-rule" key = {'key-' + index}>
                { 'clflag' !== editRules.rule[index] &&  <div className = "ast-select-control">
                    <select
                        className = 'components-select-control__input ast-custom-select'
                        value = { ( undefined !== editRules.rule[index] && null !== editRules.rule[index] ) ? editRules.rule[index] : '' }
                        onChange = { ( e ) => onSelectRule( e, index) }
                    >
                        <option value=""> {__('— Select —', 'astra-addon') }</option>
                        {displayRules}
                    </select>


                    { 'specifics' == editRules.rule[index] &&  <Select
                        value = {specific}
                        options = { searchOptions }
                        onInputChange = { (value) => onSpcificSelect(value )}
                        isMulti = { true }
                        onChange = { ( e ) => onSpecificChange( e, index )}
                        isSearchable = { true }
                        className = "ast-meta-select"
                        classNamePrefix = "ast"
                    /> }

                </div> }

                { 'clflag' !== editRules.rule[index] &&  <span className= {  disabledClass +"ast-cl-close target_rule-condition-delete dashicons dashicons-dismiss" } onClick = { ( e )=> removeRule( index ) } ></span> }
            </div>
        );
    }

    return(
        <div className="ast-custom-layout-meta-wrap components-base-control__field">

            { times( editRules.rule.length, index => renderRule( index ) ) }
            <div className="ast-display-rule-buttons">
                <a href="#" className="ast-add-rule button" data-rule-type="display" onClick = { addNewRule }> { buttonLabel } </a>
            </div>
        </div>
    );
}

export default AstDisplayRules;
