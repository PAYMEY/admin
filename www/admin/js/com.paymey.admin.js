var PAYMEY = PAYMEY || {};
PAYMEY.ADMIN = PAYMEY.ADMIN || {};


PAYMEY.ADMIN.dialogs = (function () {
    'use strict';

    // [ private properties ]
    // end var

    // [ private methods ]
    var bindUIActions = function() {
	    $('.deleteConfirm').on('click', showDeleteDialog);
	    $('.closeDeleteDialog').on('click', closeDeleteDialog);
    };

	var closeDeleteDialog = function () {
		$('#overlay').hide();
		$('#deleteConfirmDialog').hide();
	}

	var showDeleteDialog = function () {
		$('#deleteConfirmDialog').show();
		$('#overlay').show();
		$('#deleteConfirmLink').attr('href', $(this).attr('href'));
		return false;
	}

    // [ public methods ]
    return {
        init: function () {
            bindUIActions();
        }
    };
}());
