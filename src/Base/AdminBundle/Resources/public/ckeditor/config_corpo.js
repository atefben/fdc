/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    config.stylesSet = [
        // Golden mail link
        {
            name: 'Lien Bouton doré', element: 'span', childRule: function (element) {
            return !element.is('a')
        }, attributes: {'class': 'button'}
        },
        {
            name: 'Lien mail doré', element: 'span', childRule: function (element) {
            return !element.is('a')
        }, attributes: {'class': 'mail'}
        },
        // Links
        {name: 'Lien gras', element: 'a' , attributes: {'class': 'bold'}},
        {name: 'Lien standard', element: 'a'},
        // Titles
        {name: 'Titre h3', element: 'h3' },
        {name: 'Titre doré', element: 'h4' },
        {name: 'Titre h5', element: 'h5'},
        {name: 'Titre bloc', element: 'h5', attributes: {'class': 'container-title'}},
        {name: 'Titre centré', element: 'strong', attributes: {'class': 'title-center'}},
        {name: 'Titre de module', element: 'strong'},
        // Paragraphs
        {name: 'Description titre centré', element: 'p', attributes: {'class': 'descrip-title'}},
        {name: 'Description google map', element: 'span', attributes: {'class': 'googlemap-descrip'}},
        {name: 'Cadre doré', element: 'div', attributes: {'class': 'info'}},
        {name: 'Paragraphe', element: 'p', attributes: {'class': 'paragraph'}}
    ];

    // TOOLBAR
    config.toolbar = [
        {name: 'document', items: ['Source']},
        {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        {name: 'finder', items: ['Find', 'Replace', 'SelectAll']},
        '/',
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        '/',
        {name: 'insert', items: ['Table', 'HorizontalRule', 'Iframe']},
        {name: 'styles', items: ['Styles']},
        {name: 'image', items: ['Image']},
        {name: 'tools', items: ['Maximize', 'ShowBlocks']}
    ];

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
