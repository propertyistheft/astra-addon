/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';
 import { Button } from '@wordpress/components';
 import { calendar } from '@wordpress/icons';

 export default function AstDateTimeField( props ) {
     const { label, title, onOpenPopover } = props;

     return (
         <div className="ast-schedule-date-time">
             <Button
                 icon={ calendar }
                 title={ title }
                 onClick={ () => onOpenPopover( ( _isOpen ) => ! _isOpen ) }
                 isLink
             >
                 <span>{ label }</span>
             </Button>
         </div>
     );
 }
