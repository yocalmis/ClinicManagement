$(function(){
	$( 'textarea.texteditor' ).ckeditor({
		toolbar:'Full',
		stylesSet: [

		{ name: 'Thin', element: 'strong', styles: { 'font-weight': '100' } },
		{ name: 'Extra Light', element: 'strong', styles: { 'font-weight': '200' } },
		{ name: 'Light', element: 'strong', styles: { 'font-weight': '300' } },
		{ name: 'Regular', element: 'sstrongpan', styles: { 'font-weight': '400' } },
		{ name: 'Medium', element: 'strong', styles: { 'font-weight': '500' } },
		{ name: 'Semi Bold', element: 'strong', styles: { 'font-weight': '600' } },
		{ name: 'Bold', element: 'strong', styles: { 'font-weight': '700' } },
		{ name: 'Extra Bold', element: 'strong', styles: { 'font-weight': '800' } },
		{ name: 'Black', element: 'strong', styles: { 'font-weight': '900' } }

		]
	});
	$( 'textarea.mini-texteditor' ).ckeditor({toolbar:'Basic',width:700});
});