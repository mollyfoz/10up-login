// import foo from './components/bar';

import { formatInputFieldsMain, highlightEmptyMain, formatEmailField, highlightEmptyLost } from './components/form';

const init = () => {
	formatInputFieldsMain();
	highlightEmptyMain();
	formatEmailField();
	highlightEmptyLost();
};

init();
