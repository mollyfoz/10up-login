export const enableInputFields = () => {
	const usernameInput = document.getElementById( 'custom_user_login' );
	const passwordInput = document.getElementById( 'custom_user_pass' );
	const submitButton = document.getElementById( 'custom_login_submit' );
	if ( usernameInput.value !== '' && passwordInput.value !== '' ) {
		submitButton.disable = false;
	}
	removeErrorClass( usernameInput, passwordInput );
};

export const highlightEmpty = () => {
	const submitButton = document.getElementById( 'custom_login_submit' );
	const usernameInput = document.getElementById( 'custom_user_login' );
	const passwordInput = document.getElementById( 'custom_user_pass' );
	submitButton.addEventListener( 'click', ( e ) => {
		addErrorClass( usernameInput, passwordInput, e );
	} );
};

const addErrorClass = ( username, password, e ) => {
	if ( username.value === '' ) {
		e.preventDefault();
		username.classList.add( 'error' );
	}
	if ( password.value === '' ) {
		e.preventDefault();
		password.classList.add( 'error' );
	}
};

const removeErrorClass = ( username, password ) => {
	username.addEventListener( 'input' , () => {
		if ( username.value !== '' && username.classList.contains( 'error' ) ) {
			username.classList.remove( 'error' );
		}
	} );
	password.addEventListener( 'input' , () => {
		if ( password.value !== '' && password.classList.contains( 'error' ) ) {
			password.classList.remove( 'error' );
		}
	} );
};
