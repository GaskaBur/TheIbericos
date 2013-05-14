// JavaScript Document
var colourPicker1;
window.onload = function() {
	if (document.getElementById('FSPAsubmitUpdate') != null)
	{						
		var boton = document.getElementById('FSPAsubmitUpdate');
		var color = document.getElementById('color').value;
		var colorText = document.getElementById('colorText').value;
		colourPicker1 = new ColourPicker(document.getElementById('colourPicker'),'../modules/factSpa/js/',new RGBColour(hexToRgb(color).r,hexToRgb(color).g,hexToRgb(color).b));
		colourPicker2 = new ColourPicker(document.getElementById('colourPicker01'),'../modules/factSpa/js/',new RGBColour(hexToRgb(colorText).r,hexToRgb(colorText).g,hexToRgb(colorText).b));
		boton.onclick = guardar;	
	}
}

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function guardar()
{
	var color = colourPicker1.getColour();
	var colorText = colourPicker2.getColour();
	document.getElementById('color').value = color.getCSSHexadecimalRGB();
	document.getElementById('colorText').value = colorText.getCSSHexadecimalRGB();
}