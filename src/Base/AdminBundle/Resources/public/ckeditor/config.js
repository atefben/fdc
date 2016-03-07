/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    console.log(window.location.pathname);

    if (window.location.pathname.indexOf('press') != -1) {
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
            // Title bloc
            {name: 'Titre bloc', element: 'h5', attributes: {'class': 'container-title'}},
        ];

    } else {
        // STYLES
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
            // Golden border
            {name: 'Bordure dorée', element: 'div', attributes: {'class': 'big-quote'}},
            {name: 'Bordure dorée titre', element: 'strong'},
            {name: 'Bordure dorée paragraphe', element: 'span', attributes: {'class': 'big-quote-paragraph'}},
            // Grey text
            {name: 'Texte sur fond gris', element: 'div', attributes: {'class': 'txt-grey-bkg-container'}},
            {name: 'Texte sur fond gris titre', element: 'strong'},
            {
                name: 'Texte sur fond gris paragraphe',
                element: 'span',
                attributes: {'class': 'txt-grey-bkg-container-paragraph'}
            },
            // Button link
            {name: 'Bouton lien', element: 'div', attributes: {'class': 'button single-button'}},
            // Quote
            {name: 'Citation', element: 'div', attributes: {'class': 'blockquote'}},
            // Titles
            {name: 'Titre', element: 'h2', attributes: {'class': 'title-article'}},
            {name: 'Sous-titre 1', element: 'h2', attributes: {'class': 'sub-title'}},
            {name: 'Sous-titre 2', element: 'h2', attributes: {'class': 'sub-title2'}},
            {name: 'Sous-titre 3', element: 'h3', attributes: {'class': 'sub-title'}},
            // Text size
            {name: 'Texte petit', element: 'div', attributes: {'class': 'little-txt'}},
            {name: 'Texte gros', element: 'div', attributes: {'class': 'big-txt'}},
            // Header text
            {name: 'Chapo', element: 'div', attributes: {'class': 'chapeau'}},
            // Notes
            {name: 'Note de bas de page', element: 'div', attributes: {'class': 'caption-article'}}
        ];
    }

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
        {name: 'insert', items: ['Table', 'HorizontalRule']},
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

        // Set the css class for table
        if (dialogName == 'table') {
            var advancedTab = dialogDefinition.getContents('advanced');
            var cssField = advancedTab.get('advCSSClasses');

            cssField['default'] = 'table-article';
        }
    });

};
