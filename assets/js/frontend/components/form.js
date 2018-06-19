export const formatInputFieldsMain = () => {
	const usernameInput = document.getElementById( 'custom_user_login' );
	const passwordInput = document.getElementById( 'custom_user_pass' );
	if ( usernameInput || passwordInput ) {
		removeErrorClassMain( usernameInput, passwordInput );
	}
};

export const formatEmailField = () => {
	const lostPasswordInput = document.getElementById( 'custom_lost_password' );
	if ( lostPasswordInput ) {
		removeErrorClass( lostPasswordInput );
	}
};

export const highlightEmptyMain = () => {
	const submitButton = document.getElementById( 'custom_login_submit' );
	const usernameInput = document.getElementById( 'custom_user_login' );
	const passwordInput = document.getElementById( 'custom_user_pass' );
	if ( submitButton ) {
		submitButton.addEventListener( 'click', ( e ) => {
			addErrorClassMain( usernameInput, passwordInput, e );
		} );
	}
};

export const highlightEmptyLost = () => {
	const lostPasswordButton = document.getElementById( 'lost_pw_submit' );
	const lostPasswordInput = document.getElementById( 'custom_lost_password' );
	if ( lostPasswordButton ) {
		lostPasswordButton.addEventListener( 'click', ( e ) => {
			addErrorClass( lostPasswordInput, e );
		} );
	}
};

const addErrorClassMain = ( username, password, e ) => {
	if ( username.value === '' ) {
		e.preventDefault();
		username.classList.add( 'error' );
	}
	if ( password.value === '' ) {
		e.preventDefault();
		password.classList.add( 'error' );
	}
};

const addErrorClass = ( email, e ) => {
	if ( email.value === '' ) {
		e.preventDefault();
		email.classList.add( 'error' );
	}
};

const removeErrorClassMain = ( username, password ) => {
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

const removeErrorClass = ( email ) => {
	email.addEventListener( 'input' , () => {
		if ( email.value !== '' && email.classList.contains( 'error' ) ) {
			email.classList.remove( 'error' );
		}
	} );
};
