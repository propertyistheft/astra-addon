import times from 'lodash/times';
import { useState } from "react";
import { __ } from '@wordpress/i18n';

const AstUserRoles = ( props ) => {

    // Saved rules.
    const [userRoles, setUserRoles] = useState( props.value );
    // Edited and Saved rules and this is use to save in DB.
    const defaultRole = ( 0 === props.value.length ) ? [''] : props.value;
    const [editRoles, setEditeRoles] = useState( defaultRole );

    editRoles.length = ( 0 === editRoles.length ) ? 1 : editRoles.length ;

    const selectUserRoles = Object.entries( astCustomLayout.userRoles ).map( ( [ key, roles ] ) => {
        return ( 
            <optgroup label={ roles.label } key={key}>
            {   Object.entries( roles.value ).map( ( [ key, label ] ) => {                    
                return( <option value={key} key={key}> { label } </option>)
            })}
            </optgroup>
        );
    } );
    
    // Add blank rule on click of add rule button and this is temp data to manage the add more rules.
    const addNewRule = ( ) => {
        const newRule = editRoles.concat('');
        setEditeRoles( newRule );
    }

    const removeRule = ( selectedIndex ) => {
        // Remove index from rules.
        const updatedRoles = editRoles.filter( ( key, roleIndex ) => {
            return ( roleIndex !== selectedIndex );
        });
        // Remove empty values from rules to prepare to save in DB.
        const filtered = updatedRoles.filter( ( rule ) => {
            return rule != '';
        });
        
        setEditeRoles( updatedRoles );
        setUserRoles( filtered );
        // Prepare to save in DB.
        props.onChange( filtered );
    }

    const onSelectRule = ( e, index ) => {
        let selectedValue = e.target.value;
        editRoles[index] = selectedValue;
        // Remove the empty values.
        const filtered = editRoles.filter( (el) => {
            return el != '';
        });
        setEditeRoles( editRoles );
        setUserRoles( { ...filtered });
        props.onChange( filtered );
    }
    const disabledClass = ( editRoles.length == 1 ) ? 'ast-disabled-close ' : '';

    const renderRoles = ( index ) => {
        return(
            <div className= "ast-select-control ast-display-rule" key = {'key-' + index}>
                <select
                    className = 'components-select-control__input ast-custom-select'
                    value = { ( undefined !== editRoles[index] && null !== editRoles[index] ) ? editRoles[index] : '' }
                    onChange = { ( e ) => onSelectRule( e, index) }
                >
                    <option value=""> {__('— Select —', 'astra-addon') }</option>
                    {selectUserRoles}
                </select>                    
              
                <span className= { disabledClass + "target_rule-condition-delete dashicons dashicons-dismiss"} onClick = { ( e )=> removeRule( index ) } ></span>
            </div>
        );
    }

    return(
        <div className="ast-custom-layout-meta-wrap components-base-control__field">						
            { times( editRoles.length, index => renderRoles( index ) ) }

            <div className="ast-display-rule-buttons">
                <a href="#" className="ast-add-rule button" data-rule-type="display" onClick = { addNewRule }> { __( 'Add User Rule', 'astra-addon' ) } </a>
            </div>
        </div>
    );
    
}

export default AstUserRoles;
