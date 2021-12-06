import React from 'react';
import ReactDOM from 'react-dom';

/* Main Compnent */
import '@Tailwind_Integration/stylesheet.scss';
import Settings from '@Tailwind_Integration/Settings'

ReactDOM.render(
	<React.StrictMode>
		<Settings />
	</React.StrictMode>,
	document.getElementById( 'tailwind-integration-wp-app' )
);
