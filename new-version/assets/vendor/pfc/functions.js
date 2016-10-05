


/**
* Funkce ma jako vstup unicode retezec a jako vystup vyhodi ten samej malejma pismenama
* bez diakritiky, nealfanumericky znaky nahrazeny "_"
* Pokud je mode == 1, pak ponechava i tecky a orizne delku na 31 znaku
* Vystupem by tedy mel byt validni link-name
*
*/
function niceUrl(str) {
        str = trim(str);
    
	// UTF8 "Ä›ĹˇÄŤĹ™ĹľĂ˝ĂˇĂ­Ă©ĹĄĂşĹŻĂłÄŹĹ�ÄľÄş"
	convFromL = String.fromCharCode(283,353,269,345,382,253,225,237,233,357,367,250,243,271,328,318,314);
	// UTF8 "escrzyaietuuodnll"
	convToL = String.fromCharCode(101,115,99,114,122,121,97,105,101,116,117,117,111,100,110,108,108);

	// zmenseni a odstraneni diakritiky
	str = str.toLowerCase();
	str = strtr(str,convFromL,convToL);

	// jakejkoliv nealfanumerickej znak (nepouzit \W ci \w, protoze jinak tam necha treba "ÄŹĹĽËť")
	preg = /[^0-9A-Za-z]{1,}?/g;

	// odstraneni nealfanumerickych znaku (pripaddne je tolerovana tecka)
	str = trim(str.replace(preg, ' '));
	str = str.replace(/[\s]+/g, '-');

	return str;
}

function niceName(str) {
        str = trim(str);
    
	// UTF8 "Ä›ĹˇÄŤĹ™ĹľĂ˝ĂˇĂ­Ă©ĹĄĂşĹŻĂłÄŹĹ�ÄľÄş"
	convFromL = String.fromCharCode(283,353,269,345,382,253,225,237,233,357,367,250,243,271,328,318,314);
	// UTF8 "escrzyaietuuodnll"
	convToL = String.fromCharCode(101,115,99,114,122,121,97,105,101,116,117,117,111,100,110,108,108);

	// zmenseni a odstraneni diakritiky
	str = str.toLowerCase();
	str = strtr(str,convFromL,convToL);

	// jakejkoliv nealfanumerickej znak (nepouzit \W ci \w, protoze jinak tam necha treba "ÄŹĹĽËť")
	preg = /[^0-9A-Za-z]{1,}?/g;

	// odstraneni nealfanumerickych znaku (pripaddne je tolerovana tecka)
	str = trim(str.replace(preg, ' '));
	str = str.replace(/[\s]+/g, '');

	return str;
}




/**
* Funkce strtr odpovida teto funkci z PHP
*/
function strtr(s, from, to) {
	out = new String();
	// slow but simple :^)
	top:
	for(i=0; i < s.length; i++) {
		for(j=0; j < from.length; j++) {
			if(s.charAt(i) == from.charAt(j)) {
				out += to.charAt(j);
				continue top;
			}
		}
		out += s.charAt(i);
	}
	return out;
}

function trim(string) {
	//var re= /^\s|\s$/g;
	var re= /^\s*|\s*$/g;
	return string.replace(re,"");
}

