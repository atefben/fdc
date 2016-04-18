/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    // CUSTOM DISPLAY
    CKEDITOR.on('dialogDefinition', function( ev ) {
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;

        // remove upload tab in image button
        if (dialogName == 'image') {
            dialogDefinition.removeContents('Upload');
            dialogDefinition.removeContents('advanced');
        }

        // remove upload tab in link button
        if (dialogName == 'link') {
            dialogDefinition.removeContents('upload');
            dialogDefinition.removeContents('advanced');
        }
    });

};
