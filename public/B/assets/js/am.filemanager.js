tinymce.PluginManager.add('filemanager', function(editor) {

	editor.settings.file_picker_types = 'file image media';
	editor.settings.file_picker_callback = filemanager;

	function filemanager(callback, value, meta) {

		var width = window.innerWidth;
		var height = window.innerHeight;
		var title="AM Filemanager";

		window.addEventListener('message', function receiveMessage(event) {
	    window.removeEventListener('message', receiveMessage, false);
		    if (event.data.sender === 'amfilemanager') {
		        callback(event.data.url);  // Gọi callback để chèn URL vào editor
		        tinymce.activeEditor.windowManager.close();
		    }

		}, false);
		
		var dialogUrl = editor.settings.external_filemanager_path;

		if (tinymce.majorVersion > 4) {
			tinymce.activeEditor.windowManager.openUrl({
				title: title,
				url: dialogUrl,
				width: width,
				height: height,
				resizable: true,
				maximizable: true,
				inline: 1,
			});
		} else {
			tinymce.activeEditor.windowManager.open({
				title: title,
				file: dialogUrl,
				width: width,
				height: height,
				resizable: true,
				maximizable: true,
				inline: 1,
			});
		}
	}

	return false;
});
