/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
var domain = window.location.protocol +'//'+ window.location.hostname + ':8000';

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.filebrowserBrowseUrl = domain + '/ckfinder/browser';
    config.filebrowserUploadUrl = domain + '/ckfinder/connector?command=QuickUpload&type=Files';
    config.filebrowserImageBrowseUrl = domain + '/ckfinder/browser?type=Images';
    config.filebrowserImageUploadUrl = domain + '/ckfinder/connector?command=QuickUpload&type=Images';
    
    config.height = 300;
};
