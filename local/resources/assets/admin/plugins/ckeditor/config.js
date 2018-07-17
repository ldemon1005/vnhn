/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = '/backend/kcfinder/browse?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '/backend/kcfinder/browse?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = '/backend/kcfinder/browse?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '/backend/kcfinder/upload?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '/backend/kcfinder/uploadopener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = '/backend/kcfinder/uploadopener=ckeditor&type=flash';
};
