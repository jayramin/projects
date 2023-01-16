
CKEDITOR.editorConfig = function(config) {
    //config.removeButtons = 'Save';
    //config.removeButtons = 'PasteText';
    //config.removeButtons = 'Source';
    config.removeButtons = 'NumberedList,BulletedList,Outdent,Indent,Blockquote,CreateDiv,Link,Unlink,Image,HorizontalRule,SpecialChar,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Source,NewPage,Preview,Save,Smiley,Flash,IFrame,Maximize,Undo,Redo,ImageButton,Button,Form,Select,Textarea,TextField,HiddenField,Checkbox,Radio,SetLanguage,Language,About,ShowBlocks,Anchor,Iframe,PageBreak';
//    config.removeButtons = 'Table';
    //config.removeButtons = 'Smiley';
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.disableNativeSpellChecker = false;
};
