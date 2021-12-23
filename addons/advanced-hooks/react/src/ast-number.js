
/**
 * Number Component.
 */
const AstNumberControl =  ( props ) => {
    return (
        <div className ="ast-number-field">
            <input type= "number"
             value = { props.value }
             min = '1'
             onChange = { ( e )=>{
                props.onChange( e.target.value );
             }}
             className = 'ast-content-number-field'
	     placeholder={props.placeholder}
            />
        </div>
    );
}
export default AstNumberControl;
